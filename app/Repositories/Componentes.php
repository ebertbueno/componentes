<?php

namespace App\Repositories;

use App\Models\Users;
use App\Models\PinSolicitados;
use App\Models\CamposDoSistema;
use App\Models\Carteiras;
use App\Repositories\Tratamentos;
use App\Repositories\ConsultasRepositore;
use App\Repositories\FormularioRepositorie;
use Hash;
use App\Models\ApagarModelLocal;
use App\Models\MoedasConversoes;
use App\Models\CriptoMoedasConversoes;

class Componentes
{
	static function pegaBotoes($root, $modulo = 'menu_lateral', $id_base = [])
	{
		$query = Model('MenuSistema')::query();
		$busca_monta = $query->join('users_acesso', 'users_acesso.menu_id', '=', 'menu.id');
		$busca_monta->where('menu.root', $root);
		$busca_monta->where('menu.modulo', $modulo);
		if (in_array($modulo, ['botoes_acoes'])) {
			$busca_monta->orderby('ordem');
		}
		$consulta = $query->get();

		$saida = '<div class="row">';
		foreach ($consulta as $key => $b) {
			$data['tamanho'] = ($b['tamanho'] ?? 12);
			$data['tipo'] = ($b['tipo'] ?? 'LinkGeralIcone');
			$data['cor'] = ($b['cor'] ?? 'default');
			$data['url'] = urlBase($b['link']);

			if (!empty($id_base)) {
				foreach ($id_base as $key => $idBase) {
					$data['url'] = str_replace('|||' . $key . '|||', $idBase, $data['url']);
				}
			}

			$data['label'] = $b['menu'];
			$data['titulo'] = $b['titulo'];
			$data['icone'] = $b['icone'];
			$data['modulo'] = $modulo;

			$saida .= self::MontaBotao($data);
		}
		$saida .= '</div>';
		return $saida;
	}

	static function MontaBotao($data)
	{
		$tipo = (!empty($data['tipo']) ? $data['tipo'] : 'nenhum');
		$tamanho = (!empty($data['tamanho']) ? $data['tamanho'] : 12);
		$url = (!empty($data['url']) ? $data['url'] : '/backend/home');
		$cor = (!empty($data['cor']) ? $data['cor'] : 'white');
		$icone = (!empty($data['icone']) ? verificaImagemouIcone($data['icone'], '', '', $cor) : ' <i class="ki-outline ki-plus-square fs-2"></i> ');
		$titulo = (!empty($data['titulo']) ? ___($data['titulo']) : Null);
		$label = (!empty($data['label']) ? ___($data['label']) : Null);
		$target = (!empty($data['target']) ? $data['target'] : Null);
		$style = (!empty($data['style']) ? $data['style'] : '');

		$styleHref = (!empty($data['styleHref']) ? $data['styleHref'] : '');
		$styleHref = ($cor === 'btn-warning' || $cor === 'btn-success' ? $styleHref .= 'color: #fff !important' : $styleHref);
		$styleHref = ($cor === 'btn-link'  ? $styleHref .= 'color: #000 !important' : $styleHref);

		$styleSpan = (!empty($data['styleSpan']) ? $data['styleSpan'] : '');
		$styleLi = (!empty($data['styleLi']) ? $data['styleLi'] : '');
		$styleDiv = (!empty($data['styleDiv']) ? $data['styleDiv'] : '');

		$pullright = (!empty($data['float-right']) ? $data['float-right'] : 'float-right');
		$classHref = (!empty($data['classHref']) ? $data['classHref'] : Null);
		$campoName = (!empty($data['name']) ? 'name="' . $data['name'] . '"' : ' name="botaoEnviar"');
		$campoId = (!empty($data['id']) ? 'id="' . $data['id'] . '"' : ' id="botaoEnviar"');

		$modalNome = (!empty($data['modalNome']) ? $data['modalNome'] : 'nome' . rand(1, 100) . 'Modal');
		$modalTamanho = (!empty($data['modalTamanho']) ? $data['modalTamanho'] : 'lg');
		$modalEfeito = (!empty($data['modalEfeito']) ? $data['modalEfeito'] : 'fadeIn');
		$modalConteudo = (!empty($data['modalConteudo']) ? $data['modalConteudo'] : 'Sem conteúdo para ser exibido');

		$tamDiv = (!empty($data['tamDiv']) ? $data['tamDiv'] : 10);
		$tamLabel = (!empty($data['tamLabel']) ? $data['tamLabel'] : 2);
		$botao = '';

		switch ($tipo) {
			case 'botaoToaster':
				include(app_path('Repositories/ComponentesFields/botaoToaster.php'));
				break;
			case 'modalGeral':
				include(app_path('Repositories/ComponentesFields/modalGeral.php'));
				break;
			case 'linkDireto':
				include(app_path('Repositories/ComponentesFields/linkDireto.php'));
				break;
			case 'LinkGeral':
				include(app_path('Repositories/ComponentesFields/LinkGeral.php'));
				break;
			case 'BotaoModalSalvar':
				include(app_path('Repositories/ComponentesFields/BotaoModalSalvar.php'));
				break;
			case 'BotaoRemover':
				include(app_path('Repositories/ComponentesFields/BotaoRemover.php'));
				break;
			case 'vazio':
				include(app_path('Repositories/ComponentesFields/default.php'));
				break;
			default:
				include(app_path('Repositories/ComponentesFields/LinkGeralIcone.php'));
				break;
		}

		$saida = '<div class="col-md-' . $tamanho . '">';
		$saida .= $botao;
		$saida .= '</div>';

		return $saida;
	}


	static function GrupoBotao($data = '')
	{
		$componente = '';
		$componente .= '<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">';
		$componente .= 'teste ';
		$componente .= '</a>';
		$componente .= '<ul class="dropdown-menu dropdown-user" x-placement="bottom-start" style="position: absolute; top: 18px; left: -68px; will-change: top, left;">';
		$componente .= '<li><a href="#" class="dropdown-item">Config option 1</a>';
		$componente .= '</li>';
		$componente .= '<li><a href="#" class="dropdown-item">Config option 2</a>';
		$componente .= '</li>';
		$componente .= '</ul>';

		return $componente;
	}


	static function geraHashdeCadastro($users_id)
	{
		try {
			$data = User::find($users_id);
			$novoCadastro = $data['pais'] . $data['id'] . $data['nome'] . $data['nascimento'] . $data['numero_documento'] . $data['created_at'];
			return md5($novoCadastro);
		} catch (Exception $e) {
			return md5($users_id);
		}
	}

	static function geraNumeroMatricula()
	{
		$matCli = rand(1, 999999999999);
		if (strlen($matCli) == 12 && $matCli != 9999) {
			$listMat = Users::where('matricula', $matCli)->count();

			if ($listMat > 0) {
				return Componentes::geraNumeroMatricula();
			} else {
				return 'M' . $matCli;
			}
		} else {
			return Componentes::geraNumeroMatricula();
		}
		exit;
	}

	static function geraChavePin($idUsuarioSolicitante = '', $tamanho = 6)
	{
		$matCli = rand(1, 999999);
		if (strlen($matCli) == $tamanho) {
			$listMat = PinSolicitados::where('pin', $matCli)->count();

			if ($listMat > 0) {
				return Componentes::geraChavePin();
			} else {
				return $matCli;
			}
		} else {
			return Componentes::geraChavePin();
		}
		exit;
	}

	static function geraImagem($formato = '', $largura = '', $altura = '', $cor = '', $conteudo = '')
	{

		$formato = (!empty($formato) ? $formato : 'png');
		$largura = (!empty($largura) ? $largura : 600);
		$altura = (!empty($altura) ? $altura : 1200);
		$conteudo = (!empty($conteudo) ? $conteudo : 'Texto de teste');

		// Set the content-type
		header('Content-Type: image/png');

		// Create the image
		$im = imagecreatetruecolor($largura, $altura);

		// Create some colors
		$amarelo = imagecolorallocate($im, 244, 244, 182);
		$black = imagecolorallocate($im, 0, 0, 0);
		imagefilledrectangle($im, 0, 0, $largura, $altura, $amarelo);

		// The text to draw
		$text = ___('Comprovante de transferência');
		// Replace path by your own font path
		$font = '' . resource_path() . ('\arial.ttf') . '';

		// Add some shadow to the text
		imagettftext($im, 20, 0, 11, 21, $amarelo, $font, $text);

		// Add the text
		imagettftext($im, 20, 0, 10, 20, $black, $font, $text);

		// Using imagepng() results in clearer text compared with imagejpeg()
		imagepng($im);
		imagedestroy($im);
		exit;

		// http://html2canvas.hertzen.com/
	}

	static function copiarTexto($botao = '', $campoCopiar = '', $mensagem = '')
	{
		$botao = (!empty($botao) ? $botao : 'copiar');
		$campoCopiar = (!empty($botao) ? $botao : 'origem');
		$mensagem = (!empty($mensagem) ? $mensagem : ___('Copiado para área de transferência'));
		return "
		<script>
		$('#" . $botao . "').click(function(){
			$('#" . $campoCopiar . "').select();
			try {
			var ok = document.execCommand('copy');
				if (ok) { alert('" . $mensagem . "'); }
			} catch (e) {
				alert(e)
			}
		});
		</script>";
	}
};
