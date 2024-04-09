<?php

namespace App\Repositories;

use App\Repositories\Componentes;
use App\Repositories\FormularioRepositorie;
use App\Repositories\backend\email\SendRepositorie;

use DB;
use Hash;
use Mail;
use ZipArchive;

class Tratamentos
{

	static function trataTabela($dados, $id = '')
	{
		$data = [];
		foreach ($dados as $key => $dado) {
			if (strtolower($dado['aplicacao']) === 'dados') {
				// se for botão, monta os botões no formato de saída
				if (strtolower($dado['nome']) === 'botoes') {
					$data[$dado['aplicacao']]['botoes'] = '';
					foreach (explode('|', $dado['valor']) as $botoes) {
						$data[$dado['aplicacao']]['botoes'] .= Componentes::MontaBotao(['tipo' => $botoes]);
					}
					// percorre o restante dos campos de dados e monta eles conforme se apresentam
				} else {
					$data[$dado['aplicacao']][$dado['nome']] = $dado['valor'];
				}
			}

			if (strtolower($dado['aplicacao']) === 'campos') {
				$data[$dado['aplicacao']][] = [
					'tabela' => $dado['tabela'],
					'formulario' => $dado['formulario'],
					'label' => $dado['label'],
					'nome_no_banco_de_dados' => $dado['nome_no_banco_de_dados'],
					'tipo_campo_form' => $dado['tipo_campo_form'],
					'valor_inicial' => $dado['valor_inicial'],
					'tabela_relacional' => (!empty($dado['tabela_relacional']) ? $dado['tabela_relacional'] : Null),
					'formulario_montado' => FormularioRepositorie::formulario([
						'tabela_relacional' => $dado['tabela_relacional'],
						'required' => $dado['required'],
						'readonly' => $dado['readonly'],
						'minlength' => $dado['minlength'],
						'mascara' => $dado['mascara'],
						'maxlength' => $dado['maxlength'],
						'tabela' => $dado['tabela'],
						'valorinicial' => $dado['valorinicial'],
						'formulario' => $dado['formulario'],
						'label' => $dado['label'],
						'nome_no_banco_de_dados' => $dado['nome_no_banco_de_dados'],
						'tipo_campo_form' => $dado['tipo_campo_form'],
						'valor_inicial' => $dado['valor_inicial'],
						'tooltip' => $dado['tooltip'],
						'botao_adicional' => $dado['botao_adicional'],
					]),
				];
			}
		}
		return $data;
	}



	static function trataFormulario($dados)
	{
		$novoFormulario = [];
		foreach ($dados as $key => $dado) {
			$novoFormulario[] = FormularioRepositorie::formulario($dado);
		}
		return $novoFormulario;
	}



	static function trataDadosFormulario($data)
	{

		foreach ($data as $total => $datas) {
			$datas['tipo_campo_form'] = json_decode($datas['tipo_campo_form'], true);

			if (is_array($datas['tipo_campo_form'])) {
				$datas['tipo_campo_form'] = Componentes::MontaBotao($datas['tipo_campo_form']);
			} else {
				$datas = $datas;
			}
		}

		return $data;
	}



	static function trataUpload($data)
	{
		$pasta = (!empty($data['pasta']) ? $data['pasta'] : '/');
		$arquivo = $data['arquivo'];
		$validacoes = (!empty($data['validacoes']) ? $data['validacoes'] : ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'svg', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'odt', 'ods', 'odp', 'zip', '7z', 'log', 'rar']);
		$textoBotao = (!empty($data['textoBotao']) ? $data['textoBotao'] : 'continuar');

		if (empty($arquivo)) {
			echo destravaBotaoFormulario($textoBotao);
			return Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'texto' => ___('Uma imagem é obrigatória'), 'titulo' => ___('Erro'),]);
			dd();
		}

		$imagensDescartadas = '';
		$tamanho = 2048000;

		if (!empty(filesize($arquivo))) {
			$size = filesize($arquivo);
		} elseif (!empty($arquivo['size'])) {
			$size = $arquivo['size'];
		} else {
			$size = 10;
		}

		if ($size < $tamanho) {
			$usersid = (Auth()->check() ? Auth()->user()->id : site_id()['id']);

			$nomes = '';
			foreach ($validacoes as $key => $validacao) {
				$nomes .= strtolower($validacao);
				if ($key <= (count($validacoes) - 2)) {
					$nomes .= ', ';
				}
			}


			// $extensaoAtual = ( !empty($arquivo['type']) ? explode('/',$arquivo['type'])[1] : $arquivo->getClientOriginalExtension() );
			$extensaoAtual = strtolower($arquivo->getClientOriginalExtension());

			if (!in_array($extensaoAtual, $validacoes)) {
				echo destravaBotaoFormulario($textoBotao);
				echo Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Erro'), 'texto' => ___('Tipo de arquivo não permitido') . '<br>' . ___('as extensões permitidas são') . ' ' . $nomes]);
				dd();
			}

			$fileName = $usersid . date('Ymd_hmsms') . '.' . rand() . '.' . $extensaoAtual;

			$arquivo->move(public_path() . '/' . $pasta, $fileName);

			return $pasta . $fileName;
		} else {
			echo destravaBotaoFormulario($textoBotao);

			echo Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Erro'), 'texto' => ___('Imagem acima do tamanho máximo permtido') . '<br>' . ___('Máximo permitido são') . ' ' . ($tamanho / 1024) / 1000 . ' MB']);
			dd();
		}
	}



	static function trataDadosWebsite($data)
	{
		$dados = [];
		foreach ($data as $key => $datas) {

			switch ($datas['label']) {
				case 'topo':
					foreach ($datas['filhos'] as $filhos) {
						$dados['topo'][$filhos['label']] = $filhos['conteudo'];
						if (!empty($filhos['url'])) {
							$dados['topo'][$filhos['label'] . '_url'] = $filhos['url'];
						}
					}
					break;

				case 'banner':
					foreach ($datas['filhos'] as $key1 => $filhos) {
						$dados['banner'][$key1]['conteudo'] = $filhos['conteudo'];
						$dados['banner'][$key1]['url'] = $filhos['url'];
					}
					break;

				case 'quem_somos':
					foreach ($datas['filhos'] as $key1 => $filhos) {
						$dados['quem_somos'][$filhos['label']] = $filhos['conteudo'];
					}
					break;

				case 'numeros':
					foreach ($datas['filhos'] as $key1 => $filhos) {
						$dados['numeros'][$key1]['conteudo'] = $filhos['conteudo'];
						$dados['numeros'][$key1]['url'] = $filhos['url'];
					}
					break;

				case 'quadro_isca_clientes_titulo':
					foreach ($datas['filhos'] as $key1 => $data1) {
						$dados['quadro_isca_clientes_titulo'][$data1['label']] = $data1['conteudo'];
						foreach ($data1['filhos'] as $key2 => $data2) {
							$dados['quadro_isca_clientes_titulo']['filhos'][$key2][$data2['label']] = $data2['conteudo'];
							foreach ($data2['filhos'] as $key3 => $data3) {
								$dados['quadro_isca_clientes_titulo']['filhos'][$key2]['filhos'][$data3['label']] = $data3['conteudo'];
								foreach ($data3['filhos'] as $key4 => $data4) {
									$dados['quadro_isca_clientes_titulo']['filhos'][$key2]['filhos']['filhos'][]['texto'] = $data4['conteudo'];
								}
							}
						}
					}
					break;

				case 'depoimentos':
					foreach ($datas['filhos'] as $key1 => $data1) {
						$dados['depoimentos'][$data1['label']] = $data1['conteudo'];
						foreach ($data1['filhos'] as $key2 => $data2) {
							foreach ($data2['filhos'] as $key3 => $data3) {
								$dados['depoimentos']['filhos'][$key2][$data3['label']] = $data3['conteudo'];
							}
						}
					}
					break;

				case 'nossos_clientes':
					foreach ($datas['filhos'] as $key1 => $data1) {
						$dados['nossos_clientes'][$data1['label']] = $data1['conteudo'];
						foreach ($data1['filhos'] as $key2 => $data2) {
							$dados['nossos_clientes']['filhos'][$key2][$data2['label']] = $data2['conteudo'];
						}
					}
					break;

				case 'expansao_conteudo':
					foreach ($datas['filhos'] as $key1 => $data1) {
						$dados['expansao_conteudo'][$data1['label']] = $data1['conteudo'];
					}
					break;

				default:
					$dados[$datas['label']] = $datas['conteudo'];
					break;
			}
		}

		return $dados;
	}



	static function trataDadosWebsiteBD($data)
	{
		$dados = [];
		foreach ($data as $key0 => $data0) {
			$dados[$data0['grupo']][$data0['label']] = (empty($data0['conteudo']) ? [] : $data0['conteudo']);

			foreach ($data0['filhos'] as $key1 => $data1) {
				$dados[$data0['grupo']][$data0['label']][$data1['grupo']][$data1['label']] = (empty($data1['conteudo']) ? [] : $data1['conteudo']);

				foreach ($data1['filhos'] as $key2 => $data2) {
					$dados[$data0['grupo']][$data0['label']][$data1['grupo']][$data1['label']][$data2['grupo']][$data2['label']] = (empty($data2['conteudo']) ? [] : $data2['conteudo']);

					foreach ($data2['filhos'] as $key3 => $data3) {
						$dados[$data0['grupo']][$data0['label']][$data1['grupo']][$data1['label']][$data2['grupo']][$data2['label']][$data3['grupo']][$data3['label']] = (empty($data3['conteudo']) ? [] : $data3['conteudo']);
					}
				}
			}
		}

		return $dados;
	}



	static function geraSenha($tamanho, $maiusculas = '', $minusculas = '', $numeros = '', $simbolos = '')
	{
		$camposMa = 'ABCDEFGHIJKLMNOPQRSTUVYXWZ';
		$camposMi = 'abcdefghijklmnopqrstuvyxwz';
		$camposNu = '0123456789';
		$camposSi = '!@#$%&*()_+=';

		$senha = ($maiusculas ? str_shuffle($camposMa) : '');
		$senha .= ($minusculas ? str_shuffle($camposMi) : '');
		$senha .= ($numeros ? str_shuffle($camposNu) : '');
		$senha .= ($simbolos ? str_shuffle($camposSi) : '');

		return substr(str_shuffle($senha), 0, $tamanho);
	}



	static function blockchain($data, $sha = false)
	{

		if (is_int($data)) {
			$data = Model('UserSemRelacionamentos')::find($data);
			$variavel = $data['id'] . $data['nome'] . $data['email'] . $data['cpf'] . $data['nascimento'] . $data['mae'] . $data['matricula'] . $data['idioma'];
		} else {
			// $variavel = ( is_array($data) ? json_encode($data, true) : $data );
			$variavel = json_encode($data, true);
		}

		$qualMoeda = (!empty($data['QualCarteiraDestino']['moeda_id']) ? $data['QualCarteiraDestino']['moeda_id'] : 'BRL');

		if (is_null($qualMoeda)) {
			$qualMoeda = $data['carteiradeDestino']['moeda_id'];
		}

		$hashMontado = hash_hmac((!empty($sha) ? $sha : 'sha256'), md5($variavel), (Auth()->check() ? Auth()->user()->id : site_id()['id']));
		// $hashMontado = substr(configuracoesPlataforma()['moeda_padrao'],1).$qualMoeda.$hashMontado;
		return $hashMontado;
	}



	static function enviaEmail($data)
	{
		$titulo = (!empty($data['titulo']) ? $data['titulo'] : ___('titulo_padrao_para_envio_de_email'));
		$template = 'backend.' . qualTemplate() . '.' . (!empty($data['template']) ? $data['template'] : '.emails.layout_padrao');
		try {
			if (!empty($data['email']) && !empty($data['mensagem'])) {
				Mail::send($template, ['data' => $data], function ($m) use ($data) {
					$m->from('contato@apiscrowd.fund', 'Indicação - Apis Crowdfunding');
					$m->to($data['email'])->subject($data['titulo']);
				});
				return ['status' => 1];
			}
		} catch (Exception $e) {
			return ['status' => 0];
		}
	}



	static function camadaFlutuanteAlinhadoDireita($valor)
	{
		return '<div style="float:right">' . $valor . '</div>';
	}



	static function consultaCarteiraIdouHash($carteira)
	{
		return (is_int($carteira) ? $carteira : Model('Carteiras')::where('users_id', Auth()->user()->id)->where('hash', $carteira)->first());
	}


	static function pedePin($data)
	{
		$_SESSION['dados'] = $data;

		// pega qual a url que está sendo chamada, determinada como ação
		$qualAcao = explode('/', urlCompleta());

		// grava um financeiro, com o tipo da transação e um diferencial no tipo, pra não misturar caso a transação seja abandonada

		if (!is_int($data['carteira_id'])) {
			$data['carteira_id'] = Model('Carteiras')::where('id', $data['carteira_id'])->where('users_id', Auth()->user()->id)->first()['id'];
		}

		$data['total'] = format_vlr($data['total']);
		$data['tipo'] = $qualAcao[count($qualAcao) - 1] . '|PIN';
		$data['users_id_origem'] = Auth()->user()->id;
		$data['pin'] = Componentes::geraNumeroCarteira(6);

		$ultimo = (!empty($_SESSION['financeiro']) ? Model('Financeiro')::find($_SESSION['financeiro']['id']) : Model('Financeiro')::create($data));

		// salva o create em uma sessão pra poder ser tratado
		unset($_SESSION['financeiro']);
		$_SESSION['financeiro'] = $ultimo;

		// envia o email para o usuário logado, com a chave PIN criada pra ser conferida
		if (empty($ata['pin'])) {
			SendRepositorie::index('enviodePINparaemail', $qualAcao[count($qualAcao) - 1]);
		}

		// monta o cabeçalho do formulário que vai pedir a confirmação
		$dados = [
			'titulo_pagina' => '',
			'rota_geral' => '/backend' . urlCompleta(),
			'tamanho_tela' => 4,
			'css' => '
			padding-top:5px;
			padding-bottom:20px;
			border:0.6px solid #95a5a6;
			height:auto;
			border-radius:15px;
			border-left-color:#92a8d1;
			border-left-style:solid;
			top: -190px !important;
			left: 0px !important;
			background-color: #fff;
			width: 100% !important;
			'
		];

		// monta o cabeçalho do formulário que vai pedir a confirmação
		if (Auth()->check()) {
			$formulario[] = FormularioRepositorie::formulario(['formulario' => 12, 'tipo' => 'vazio', 'label' => '<br>PIN necessário. <br> Para finalizar esta transação, informe o código que foi enviado para o e-mail ' . Auth()->user()->email]);
			$formulario[] = FormularioRepositorie::formulario(['formulario' => 12, 'label' => ___('PIN'), 'nome_no_banco_de_dados' => 'pin', 'required' => 1, 'valor_inicial' => '']);
			$formulario[] = Componentes::MontaBotao(['tipo' => 'BotaoModalSalvar', 'size' => 8, 'cor' => 'success', 'icone' => 'fa fa-save', 'titulo' => ___('Confirmar PIN')]);
		}

		$formRequest = [];

		return [
			'data' => $data,
			'dados' => $dados,
			'formulario' => $formulario,
			'formRequest' => $formRequest,
		];
	}


	static function conferePin($data)
	{

		$consulta = Model('Financeiro')::where('id', $_SESSION['financeiro']['id'])->where('pin', $data)->first();
		if (!empty($consulta)) {
			return ['status' => 1];
		} else {
			Model('Financeiro')::find($_SESSION['financeiro']['id'])->increment('pin_tentativas', 1);

			if ($consulta['pin_tentativas'] >= 3) {
				return redirect('/backend/sair');
			}

			return Componentes::MontaBotao([
				'tipo' => 'botaoToaster',
				'cor' => 'warning',
				'texto' => ___('Código PIN informado não confere'),
				'titulo' => ___('Erro'),
			]);
		}
	}


	static function descompactaArquivos($data)
	{

		$arquivo = $data['imagem'];
		$destino = $data['pastaDestino'];

		$zip = new ZipArchive;
		$zip->open($arquivo);
		if ($zip->extractTo($destino) == TRUE) {
			return Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'success', 'texto' => ___('Sucesso'), 'titulo' => ___('Arquivo descompactado com sucesso'),]);
		} else {
			return Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'texto' => ___('Erro'), 'titulo' => ___('Erro ao descompactar o arquivo'),]);
		}
		$zip->close();
	}
};
