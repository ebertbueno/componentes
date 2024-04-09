<?php
$tipo = ( !empty($data['tipo']) ? $data['tipo'] : 'LinkGeral' );
$tamanho = ( !empty($data['tamanho']) ? $data['tamanho'] : 10 );
$tamanhoCheio=( !empty($data['tamanhoCheio']) ? $data['tamanhoCheio'] : 1 );
$url = ( !empty($data['url']) ? $data['url'] : '/backend/home' );
$cor = ( !empty($data['cor']) ? 'btn-'.$data['cor'] : 'btn-white' );
$icone = ( !empty($data['icone']) ? verificaImagemouIcone($data['icone'],'','',$cor) : ' <i class="fa fa-plus"> </i> ' );
$titulo = ( !empty($data['titulo']) ? ___($data['titulo']) : '' );
$label = ( !empty($data['label']) ? ___($data['label']) : '' );
$target = ( !empty($data['target']) ? $data['target'] : Null );
$style = ( !empty($data['style']) ? $data['style'] : '' );

$styleHref = ( !empty($data['styleHref']) ? $data['styleHref'] : '' );
$styleSpan = ( !empty($data['styleSpan']) ? $data['styleSpan'] : '' );
$styleLi = ( !empty($data['styleLi']) ? $data['styleLi'] : '' );
$styleDiv = ( !empty($data['styleDiv']) ? $data['styleDiv'] : '' );

$pullright = ( !empty($data['float-right']) ? $data['float-right'] : 'float-right' );
$classHref = ( !empty($data['classHref']) ? $data['classHref'] : Null );
$campoName = ( !empty($data['name']) ? 'name="'.$data['name'].'"' : ' name="botaoEnviar"' );
$campoId = ( !empty($data['id']) ? 'id="'.$data['id'].'"' : ' id="botaoEnviar"' );
// $botaoToaster

//	campos para o modal
$modalNome = ( !empty($data['modalNome']) ? $data['modalNome'] : 'nome'.rand(1,100).'Modal' );
$modalTamanho = ( !empty($data['modalTamanho']) ? $data['modalTamanho'] : 'lg' );
$modalEfeito = ( !empty($data['modalEfeito']) ? $data['modalEfeito'] : 'fadeIn' );
$modalConteudo = ( !empty($data['modalConteudo']) ? $data['modalConteudo'] : 'Sem conteúdo para ser exibido' );

$tamDiv = ( !empty($data['tamDiv']) ? $data['tamDiv'] : 10);
$tamLabel = ( !empty($data['tamLabel']) ? $data['tamLabel'] : 2);


$botao = '';
switch ($tipo) {
    case 'botaoToaster':		include(app_path('Repositories/ComponentesFields/botaoToaster.php'));			break;
    case 'modalGeral':			include(app_path('Repositories/ComponentesFields/modalGeral.php'));				break;
    case 'linkDireto':			include(app_path('Repositories/ComponentesFields/linkDireto.php'));				break;
    case 'LinkGeral':			include(app_path('Repositories/ComponentesFields/LinkGeral.php'));				break;
    case 'BotaoModalSalvar':	include(app_path('Repositories/ComponentesFields/BotaoModalSalvar.php'));		break;
    case 'BotaoRemover':		include(app_path('Repositories/ComponentesFields/BotaoRemover.php'));			break;
    case 'LinkGeralIcone':		include(app_path('Repositories/ComponentesFields/LinkGeralIcone.php'));			break;
    default:					include(app_path('Repositories/ComponentesFields/default.php'));				break;
}
return $botao;