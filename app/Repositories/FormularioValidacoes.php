<?php

namespace App\Repositories;

use App\Repositories\Componentes;
use DB;

class FormularioValidacoes
{

	static function FormularioValidacoes($data, $validacao)
	{
		destravaBotaoFormulario();

		unset($data['_token']);
        unset($data['_method']);

		$msgRetorno = [];
		$statusValidacao = 0;

		foreach ($validacao as $key0 => $validado) {
			if (!empty($validado['validacoes'])) {
				foreach ($validado['validacoes'] as $key1 => $v) {
					$tipo = $v['tipo'] ?? 'required';

					switch ($tipo) {
						case 'password':
							require_once(app_path('Repositories/Validacoes/password.php'));
							break;
						case 'max':
							require_once(app_path('Repositories/Validacoes/max.php'));
							break;
						case 'min':
							require_once(app_path('Repositories/Validacoes/min.php'));
							break;
						case 'required':
							require_once(app_path('Repositories/Validacoes/required.php'));
							break;
						case 'equal':
							require_once(app_path('Repositories/Validacoes/equal.php'));
							break;
						case 'unique':
							require_once(app_path('Repositories/Validacoes/unique.php'));
							break;
						case 'size':
							require_once(app_path('Repositories/Validacoes/size.php'));
							break;
						case 'exists':
							require_once(app_path('Repositories/Validacoes/exists.php'));
							break;
						case 'email':
							require_once(app_path('Repositories/Validacoes/email.php'));
							break;
						case 'exists2':
							require_once(app_path('Repositories/Validacoes/exists2.php'));
							break;
						case 'positivo':
							require_once(app_path('Repositories/Validacoes/positivo.php'));
							break;
						case 'positivoOuZero':
							require_once(app_path('Repositories/Validacoes/positivoOuZero.php'));
							break;
						case 'valorMaiorIgualque':
							require_once(app_path('Repositories/Validacoes/valorMaiorIgualque.php'));
							break;
						case 'dataMaiorQue':
							require_once(app_path('Repositories/Validacoes/dataMaiorQue.php'));
							break;
						case 'dataMenorQue':
							require_once(app_path('Repositories/Validacoes/dataMenorQue.php'));
							break;
						case 'diferente':
							require_once(app_path('Repositories/Validacoes/diferente.php'));
							break;
						case 'date':
							require_once(app_path('Repositories/Validacoes/date.php'));
							break;
						case 'tipo_upload':
							require_once(app_path('Repositories/Validacoes/tipo_upload.php'));
							break;
						case 'tamanho':
							require_once(app_path('Repositories/Validacoes/tamanho.php'));
							break;
						default:
							require_once(app_path('Repositories/Validacoes/default.php'));
							break;
					}
				}
			}
		}

		if (count($msgRetorno) > 0) {
			destravaBotaoFormulario();
			foreach ($msgRetorno as $key => $m) {
				echo exibeToastrAlerta($m);
			}
			exit;
		}

		return $data;
	}

	static function mensagensPadrao($mensagem = Null, $parametro = Null)
	{
		switch ($mensagem) {
			case 'max':
				$retorno = ___('Campo deve ter no máximo |max| caracteres!');
				if (!empty($parametro)) {
					$retorno = str_replace('|max|', $parametro, $retorno);
				}
				break;
			case 'min':
				$retorno = ___('Campo deve ter no mínimo |min| caracteres!');
				if (!empty($parametro)) {
					$retorno = str_replace('|min|', $parametro, $retorno);
				}
				break;
			case 'email':
				$retorno = ___('Informe um email válido!');
				break;
			case 'required':
				$retorno = ___('Esse campo é obrigatório!');
				break;
			case 'date':
				$retorno = ___('Informe uma data válida!');
				break;
			case 'tipo_upload':
				$retorno = ___('O(s) arquivo(s) não puderam ser enviados!');
				break;
			case 'tamanho':
				$retorno = ___('Arquivo acima do tamanho máximo permitido!');
				break;
			case 'password':
				$retorno = ___('Senha e confirmação são diferentes!');
				break;
			default:
				$retorno = ___('Verifique os campos obrigatórios do formulário!');
				break;
		}
		return $retorno;
	}
};

/*

modelo de chamada

			'nomedocampo' => [
				'int' => ___('Selecione um valor disponível'),
				'exists2:carteiras,id,users_id' => ___('Precisará ser uma carteira de sua propriedade'),
				'checaSaldo:financeiro_saldo,carteira_id' => ___('Você não tem saldo suficiente nessa carteira'),
			],
			'total' => [
				'maiorquezero:financeiro_saldo,carteira_id' => ___('Você não tem saldo suficiente nessa carteira'),
			],

*/