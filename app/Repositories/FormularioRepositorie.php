<?php

namespace App\Repositories;

use App\Models\CamposDoSistema;
use App\Models\contract;
use App\Repositories\Componentes;
use App\Repositories\Tratamentos;
use App\Repositories\ConsultasRepositore;
use DB;

class FormularioRepositorie
{
	static function pegaFormulario($url, $modulo = 'botoes_acoes')
	{
		$saida = '';
		$validacoes = [];
		$consulta = Model('Formularios')::where('link', $url)->get();
		foreach ($consulta as $key => $b) {
			foreach ($b['menuBotoes']->where('modulo', $modulo) as $key2 => $b2) {
				$saida .= FormularioRepositorie::formulario([
					'formulario' => 9,
					'label' => 'Nome da loja',
					'nome_no_banco_de_dados' => 'name',
					'required' => 1,
					'icone' => ['tipo' => 'icone', 'arquivo' => 'fa fa-user'],
					'valor_inicial' => (!empty($data['name']) ? $data['name'] : '')
				]);
			}
		}
		return $saida;
	}

	static function formulario($data)
	{
		$label = 					(!empty($data['label']) ? ___($data['label']) : '');
		$label_botao_direita = 		(!empty($data['label_botao_direita']) ? $data['label_botao_direita'] : '');
		$tamanho = 					(!empty($data['tamanho']) ? $data['tamanho'] : 4);
		$tipo = 					(!empty($data['tipo']) ? $data['tipo'] : 'text');
		$cor_fundo = 				(!empty($data['cor_fundo']) ? $data['cor_fundo'] : '#00B259');

		$required = 				(!empty($data['required']) ? 'required="required"' : '');
		$required_label = 			(!empty($data['required']) ? 's' : 'n');

		$valor_inicial = 			(!empty($data['valor_inicial']) ? $data['valor_inicial'] : Null);
		$url_relacional = 			(!empty($data['url_relacional']) ? $data['url_relacional'] : '/');
		$readonly = 				(!empty($data['readonly']) ? 'readonly="readonly"' : '');
		$disabled = 				(!empty($data['disabled']) ? ' disabled="disabled"' : '');
		$placeholder = 				(!empty($data['placeholder']) ? ___($data['placeholder']) : '');
		$minlength = 				(!empty($data['minlength']) ? 'minlength="' . $data['minlength'] . '"' : '');
		$maxlength = 				(!empty($data['maxlength']) ? 'maxlength="' . $data['maxlength'] . '"' : '');
		$rowsTextarea = 			(!empty($data['rows']) ? $data['rows'] : '5');
		$min = 						(!empty($data['min']) ? ' min="' . $data['min'] . '"' : Null);
		$max = 						(!empty($data['max']) ? ' max="' . $data['max'] . '"' : Null);
		$tabela_relacional = 		(!empty($data['tabela_relacional']) ? $data['tabela_relacional'] : '');
		$chave_tabela_relacional = 	(!empty($data['chave_tabela_relacional']) ? $data['chave_tabela_relacional'] : 'filhos');
		$nome_no_banco_de_dados = 	(!empty($data['nome_no_banco_de_dados']) ? $data['nome_no_banco_de_dados'] : 'id');
		$mascara = 					(!empty($data['mascara']) ? $data['mascara'] : '');
		$multiple = 				(!empty($data['multiple']) ? 'multiple="multiple"' : '');
		$dados_aux = 				(!empty($data['dados_aux']) ? $data['dados_aux'] : '');
		$style = 					(!empty($data['style']) ? $data['style'] : '');
		$style_label = 				(!empty($data['style_label']) ? $data['style_label'] : '');
		$cssAdicionalInput = 		(!empty($data['cssAdicionalInput']) ? $data['cssAdicionalInput'] : 'form-control');
		$campoLivre = 				(!empty($data['campoLivre']) ? $data['campoLivre'] : Null);
		$checked = 					(!empty($data['checked']) ? ' checked="checked"' : Null);

		$editor = 					(!empty($data['editor']) ? 'ckeditor' : Null);

		$autofocus = 				(!empty($data['autofocus']) ? 'autofocus' : Null);
		$tamanhoCheio =				(!empty($data['tamanhoCheio']) ? 1 : 0);
		$confirmacao =				(!empty($data['confirmacao']) ? $data['confirmacao'] : 0);
		$msg_complementar =			(!empty($data['msg_complementar']) ? ___($data['msg_complementar']) : Null);

		$tamDiv   = 				(!empty($data['tamDiv']) ? $data['tamDiv'] : 10);			// usado no checkbox, muda o tamanho do conteúdo do checkbox
		$tamLabel = 				(!empty($data['tamLabel']) ? $data['tamLabel'] : 2);		// usado no checkbox, muda o tamanho do conteúdo de texto
		$tamDivGeral = 				(!empty($data['tamDivGeral']) ? $data['tamDivGeral'] : 3);	// usado no checkbox, para dar tamanho de cada box com o texto
		$campoAvulso = 				(!empty($data['campoAvulso']) ? $data['campoAvulso'] : Null);
		$QRCode = 					(!empty($data['QRCode']) ? $data['QRCode'] : Null);
		$height = 					(!empty($data['height']) ? $data['height'] : '100px');
		$tabindex = 				' tabindex="' . (!empty($data['tabindex']) ? $data['tabindex'] : 0) . '"';
		$javascript = 				(!empty($data['javascript']) ? $data['javascript'] : Null);
		$class_label = 				(!empty($data['class_label']) ? $data['class_label'] : 6);
		$retorno = '';

		switch ($tipo) {
			case 'select_multiple':
				include(app_path('Repositories/FormularioRepositorieFields/select_select_multiple.php'));
				break;

			case 'camera':
				include(app_path('Repositories/FormularioRepositorieFields/camera.php'));
				break;

			case 'select_dependente':
				include(app_path('Repositories/FormularioRepositorieFields/select_dependente.php'));
				break;

			case 'select':
			case 'select2':
				include(app_path('Repositories/FormularioRepositorieFields/select.php'));
				break;

			case 'select_acesso_rapido':
				include(app_path('Repositories/FormularioRepositorieFields/select_acesso_rapido.php'));
				break;

			case 'radio_image':
				include(app_path('Repositories/FormularioRepositorieFields/radio_image.php'));
				break;

			case 'optgroup':
				include(app_path('Repositories/FormularioRepositorieFields/optgroup.php'));
				break;

			case 'textarea':
				include(app_path('Repositories/FormularioRepositorieFields/textarea.php'));
				break;

			case 'campos_em_linha':
				include(app_path('Repositories/FormularioRepositorieFields/campos_em_linha.php'));
				break;

			case 'search':
				include(app_path('Repositories/FormularioRepositorieFields/search.php'));
				break;

			case 'password':
				include(app_path('Repositories/FormularioRepositorieFields/password.php'));
				break;

			case 'checkbox':
				include(app_path('Repositories/FormularioRepositorieFields/checkbox.php'));
				break;

			case 'exibeImagem':
				include(app_path('Repositories/FormularioRepositorieFields/exibeImagem.php'));
				break;

			case 'quadro_imagem_radio':
				include(app_path('Repositories/FormularioRepositorieFields/quadro_imagem_radio.php'));
				break;

			case 'hidden':
				include(app_path('Repositories/FormularioRepositorieFields/hidden.php'));
				break;

			case 'vazio':
				include(app_path('Repositories/FormularioRepositorieFields/vazio.php'));
				break;

			case 'labelComTexto':
				include(app_path('Repositories/FormularioRepositorieFields/labelComTexto.php'));
				break;

			case 'label':
				include(app_path('Repositories/FormularioRepositorieFields/label.php'));
				break;

			case 'upload_com_previa':
				include(app_path('Repositories/FormularioRepositorieFields/upload_com_previa.php'));
				break;

			case 'switch':
				include(app_path('/Repositories/FormularioRepositorieFields/switch.php'));
				break;

			case 'switch_lado_lado':
				include(app_path('/Repositories/FormularioRepositorieFields/switch_lado_lado.php'));
				break;

			case 'numberAdicionaRemove':
				include(app_path('/Repositories/FormularioRepositorieFields/numberAdicionaRemove.php'));
				break;

			case 'apenas_campo_formulario':
				include(app_path('/Repositories/FormularioRepositorieFields/apenas_campo_formulario.php'));
				break;

			case 'play_list_youtube':
				include(app_path('Repositories/FormularioRepositorieFields/play_list_youtube.php'));
				break;

			default:
				include(app_path('Repositories/FormularioRepositorieFields/default.php'));
				break;
		}

		$saida = '';
		if (!in_array($tipo, ['hidden'])) {
			$saida .= '<div class="col-md-' . $tamanho . '" style="line-height:1 !important; margin-bottom: 20px !important;">';
			$saida .= '<label class="d-flex align-items-center fs-' . $class_label . ' fw-semibold mb-2" style="' . $style_label . '">';
			if ($required_label === 's') {
				$saida .= '<span class="' . (!empty($required_label) || !empty($required) ? 'required' : Null) . '">';
			} else {
				$saida .= '<span>';
			}
			$saida .= ___($label);
			$saida .= '</span>';

			if (!empty($msg_complementar)) {
				$saida .= '<span class="ms-1" data-bs-toggle="tooltip" title="' . $msg_complementar . '">';
				$saida .= '<i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>';
				$saida .= '</span>';
			}
			$saida .= '</label>';
			$saida .= $retorno;
			$saida .= '</div>';
		} else {
			$saida .= $retorno;
		}

		return $saida;
	}

	static function abasSeparadoras($data)
	{
		return include(app_path('Repositories/layoutsSaida/abasSeparadoras.php'));
	}

	static function calculaTamanho($tamanho = 100)
	{
		return include(app_path('Repositories/layoutsSaida/calculaTamanho.php'));
	}

	static function camposParaContrato($tipo)
	{
		return include(app_path('Repositories/layoutsSaida/camposParaContrato.php'));
	}

	static function adicionarRemoverCampos($data)
	{
		return include(app_path('Repositories/layoutsSaida/adicionarRemoverCampos.php'));
	}

	static function formularioAgrupado($data)
	{
		return include(app_path('Repositories/layoutsSaida/formularioAgrupado.php'));
	}
};
