<?php
namespace App\Repositories;
use App\Models\Users;
use App\Models\CamposDoSistema;
use App\Models\Carteiras;
use App\Repositories\Componentes;
use App\Repositories\Tratamentos;
use App\Repositories\ConsultasRepositore;
use App\Repositories\FormularioRepositorie;
use Hash;
use App\Models\Financeiro;

class BlockchainGeral{
	static function BlockchainGeral($data=''){
		$data['valor'] = formataMoedaCompleta(( is_numeric($data['valor']) ? number_format($data['valor'],8) : $data['valor'] ),casasDecimaisPadrao());
		$data['valorTransacao'] = formataMoedaCompleta(( is_numeric($data['valorTransacao']) ? number_format($data['valorTransacao'],8) : $data['valorTransacao'] ),casasDecimaisPadrao());

		if( empty($data['tipoTransacao']) ){
			dd('sem transacao');
		} 

		/*
		calculaTaxaporTransacao
		currencyToSystemDefaultBD
		Tratamentos::blockchain
		validaTransacaocomSaldo
		*/

		$valorCalculoTaxas = calculaTaxaporTransacao($data['valorTransacao'],$data['tipoTransacao']);

		$data['valorTaxa'] = $valorCalculoTaxas['valorTaxa'];
		$data['users_id_origem'] = Auth()->user()->id;

		$dados['root'] = ( !empty($id) ? $id : 0 );
		$dados['emp_id'] = site_id()['id'];
		$dados['tipo'] = ( !empty($data['tipoTransacao']) ? $data['tipoTransacao'] : 'transacaoInvalida' );
		$dados['users_id'] = Auth()->user()->id;
		$dados['valor'] = formataMoedaCompleta(( !empty($data['valorTransacao']) ? $data['valorTransacao'] : 0 ),casasDecimaisPadrao());
		$dados['acrescimo'] = $valorCalculoTaxas['valorCalculado'];
		
		switch ($data['tipoTransacao']) {
			case 'offer_book':
				$dados['total'] = formataMoedaCompleta($dados['valor'],casasDecimaisPadrao());
				break;

			default:
				$dados['total'] = formataMoedaCompleta($dados['valor'],casasDecimaisPadrao()) + formataMoedaCompleta($dados['acrescimo'],casasDecimaisPadrao());
		}
		
		$dados['obs'] = ( !empty($data['obs']) ? $data['obs'] : 'Processo de transação realizado em ' . date('Y-m-d h:m:s') . ' pelo email logado ' . Auth()->user()->email);
		$dados['status_transacao'] = ( !empty($data['status_transacao']) ? $data['status_transacao'] : 0 );
		$dados['cotacao'] = formataMoedaCompleta(( !empty($data['cotacao']) ? $data['cotacao'] : 0 ),casasDecimaisPadrao());
		$dados['users_id_origem'] = Auth()->user()->id;
		$dados['carteira_origem'] = $data['carteira_origem'];
		$dados['users_id_destino'] = $data['users_id_destino'];
		$dados['json_transacao'] = json_encode($data);
		$dados['pin'] = ( !empty($data['senha_financeira']['senhaFinanceira']) ? $data['senha_financeira']['senhaFinanceira'] : $data['senha_financeira'] );
		$dados['confirmacoes_blockchain'] = ( !empty($data['confirmacoes_blockchain']) ? $data['confirmacoes_blockchain'] : 0 );
		$dados['carteira_id_origem'] = $data['carteira_id_origem'];
		$dados['carteira_id_destino'] = $data['carteira_id_destino'];
		$dados['recebimentos_pagamentos_hash'] = ( !empty($data['recebimentos_pagamentos_hash']) ? $data['recebimentos_pagamentos_hash'] : Null );
		$dados['codigo_transacao'] = Tratamentos::blockchain($data);
		
		/*
		$calculaTaxas = [
			'porcentagem_plataforma' => 0,
			'valor_plataforma' => 0,
			'porcentagem_apis' => 0,
			'valor_apis' => 0,
		];
		*/

		if( $data['tipoTransacao'] != 'deposits' && $data['tipoTransacao'] != 'robot' && $data['tipoTransacao'] != 'referral_network' ){
			$calculaTaxas = validaTransacaocomSaldo($data['carteira_id_origem'],$data['tipoTransacao'],$data['valor']);
		}

		$dados['porcentagem_plataforma'] = ( !empty($calculaTaxas['porcentagem_plataforma']) ? $calculaTaxas['porcentagem_plataforma'] : 0 );
		$dados['valor_plataforma'] = ( !empty($calculaTaxas['valor_plataforma']) ? $calculaTaxas['valor_plataforma'] : 0 );
		$dados['porcentagem_apis'] = ( !empty($calculaTaxas['porcentagem_apis']) ? $calculaTaxas['porcentagem_apis'] : 0 );
		$dados['valor_apis'] = ( !empty($calculaTaxas['valor_apis']) ? $calculaTaxas['valor_apis'] : 0 );

		if( $dados['carteira_id_origem'] === 0 ){
		$escolheCarteiras = Carteiras::get();
			foreach($escolheCarteiras as $qualCarteira){
				if( $qualCarteira['SaldoConta']['saldo_disp'] > $dados['total'] ){
					$dados['carteira_id_origem'] = $qualCarteira['id'];
					break;
				}
			}
		}

		$dados['users_id'] = ( !empty($data['users_id']) ? $data['users_id'] : Auth()->user()->id );
		$dados['users_id_origem'] = ( !empty($data['users_id_origem']) ? $data['users_id_origem'] : Auth()->user()->id );

		switch ($data['tipoTransacao']) {

			/*
				1 - credito no saldo
				2 - débito no saldo
			*/

			case 'deposits':
			case 'referral_network':
				$data['credito_debito'] = 1;
				break;
			
			default:
				$data['credito_debito'] = 2;
				break;
		}

		$ultimo = Financeiro::create($dados);

		switch (strtolower($dados['tipo'])) {
			case 'monthly_payment':
			case 'referral_network':
				break;

			case 'deposits':
				incrementSaldo($dados['carteira_id_destino'],($dados['valor']-$data['valor_plataforma']),$ultimo['id']);
				break;

			case 'offer_book':
				decrementSaldo($dados['carteira_id_origem'],$dados['valor'],$ultimo['id']);
				decrementSaldo($dados['carteira_id_destino'],formataMoedaCompleta(($dados['valor']-$dados['acrescimo']),casasDecimaisPadrao()),$ultimo['id'],'a');
				break;

			case 'transferwallet':
				decrementSaldo($dados['carteira_id_origem'],$dados['total'],$ultimo['id']);
				decrementSaldo($dados['carteira_id_destino'],$dados['valor'],$ultimo['id'],'a');
				break;

			case 'payments':
				decrementSaldo($dados['carteira_id_origem'],$dados['total'],$ultimo['id']);
				incrementSaldo($dados['carteira_id_destino'],($dados['valor']-$data['valor_plataforma']),$ultimo['id']);
				break;
			
			default:
				decrementSaldo($dados['carteira_id_origem'],$dados['total'],$ultimo['id']);
				decrementSaldo($dados['carteira_id_destino'],$dados['valor'],$ultimo['id'],'a');
				break;
		}
		$ultimo['status'] = 1;
		return $ultimo;
	}
}