<?php
$botao = '';

if (empty($data['filhos'])) {
    $botao .= '<a ';
    if ($target) {
        $botao .= 'href="' . $url . '" ';
    } else {
        $botao .= "onclick=\"montaTela('{$url}')\" ";
    }
    $botao .= 'id="' . deixaApenasTexto($titulo . $label) . '" ';
    $botao .= 'title="' . $titulo . '" ';
    if (isset($data['modulo']) && $data['modulo'] === 'botoes_acoes') {
        $botao .= 'style="float: right !important" ';
    }    
    $botao .= 'class="btn btn-' . $cor . ' btn-sm">';
    $botao .= $icone;
    $botao .= $label;
    $botao .= '</a>';
} else {
    dd('app\Repositories\ComponentesFields\LinkGeralIcone.php - linha de array');
    $botao .= '<a ' . mostraToolTip($titulo) . ' class="dropdown-toggle btn- ' . $cor . ' ' . ($cor != 'btn-white' ? 'text-white' : Null) . ' float-right ' . $classHref . '" data-toggle="dropdown" href="#" style="with: 100% !important; margin: 0px 2px 0px 2px !important; ' . $styleHref . '">';
    $botao .= $icone;
    $botao .= $label;
    $botao .= '</a>';
    $botao .= '<ul class="dropdown-menu dropdown-user">';

    foreach ($data['filhos'] as $key => $filhos) {
        $botao .= '<li style="with: 100% !important; margin: 0px 2px 0px 2px !important; ' . $styleLi . '"><a ' . mostraToolTip($titulo) . ' onclick="' . trataUrlparaFuncao($filhos['url']) . '" class="dropdown-item"> <i class="' . $filhos['icone'] . '"> </i> ' . $filhos['label'] . '</a></li>';
    }
    $botao .= '</ul>';
}

// $botao = '<a href="#" class="btn btn-icon btn-primary me-2 mb-2">';
// $botao .= '<i class="bi bi-chat-square-text-fill fs-4"></i>';
// $botao .= '</a>';