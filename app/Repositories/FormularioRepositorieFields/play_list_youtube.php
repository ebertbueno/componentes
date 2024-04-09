<?php
// video_1, playlist_1, video_2, playlist_2, video_3, playlist_3

$video = $nome_no_banco_de_dados;
$playlist = str_replace('video_', 'playlist_', $video);
$atual = str_replace('video_', '', $video);

$video_valor_inicial = ( !empty($valor_inicial['video']) ? $valor_inicial['video'] : Null );
$playlist_valor_inicial = ( !empty($valor_inicial['playlist']) ? $valor_inicial['playlist'] : Null );
$playlist_layout = ( !empty($valor_inicial['layout']) ? $valor_inicial['layout'] : Null );

$retorno = '<div class="form-group row" style="width: 100%;">';
$retorno .= '<label class="col-sm-' . $tamLabel . ' col-form-label">' . $required_label . ___($label) . '</label>';


// $retorno .= '<div class="col-sm-5">';
// $retorno .= '<input ' . $tabindex . ' placeholder="' . $placeholder . '" ' . $autofocus . ' ' . $campoLivre . ' autocomplete="off" ' . $required . ' ' . $readonly . ' value="' . $video_valor_inicial . '" ' . $minlength . ' ' . $maxlength . ' ' . $multiple . '  name="' . $video . '' . (!empty($multiple) ? '[]' : Null) . '" id="' . $video . '" type="' . $tipo . '" class="' . $mascara . ' ' . $cssAdicionalInput . ' form-control" ' . $min . ' ' . $max . ' style="' . $style . '" />';
// $retorno .= '<div class="text-danger">https://youtube.com/embed?v=</div>';
// $retorno .= '</div>';


$retorno .= '<div class="col-sm-10">';
$retorno .= '<input ' . $tabindex . ' placeholder="' . $placeholder . '" ' . $autofocus . ' ' . $campoLivre . ' autocomplete="off" ' . $required . ' ' . $readonly . ' value="' . $playlist_valor_inicial . '" ' . $minlength . ' ' . $maxlength . ' ' . $multiple . '  name="' . $playlist . '' . (!empty($multiple) ? '[]' : Null) . '" id="' . $playlist . '" type="' . $tipo . '" class="' . $mascara . ' ' . $cssAdicionalInput . ' form-control" ' . $min . ' ' . $max . ' style="' . $style . '" />';
$retorno .= '<div class="text-danger">https://youtube.com/embed?list=</div>';
$retorno .= '</div>';


if ((int)$atual === 1) {
    $retorno .= '<div class="col-sm-12">&nbsp;</div>';
    $retorno .= '<div class="col-sm-2">' . ___('Layout de exibição') . '</div>';
    $retorno .= '<div class="col-sm-10">';
    $retorno .= '<div class="row">';
    $retorno .= '<div class="col-sm-2 text-center"><label name="layout_01" id="layout_01"><img style="width: 100% !important" src="/totens/layout_01.png"><input '.( $playlist_layout === 1 ? 'checked' : Null ).' type="radio" name="layout" id="layout" value="1"></label></div>';
    $retorno .= '<div class="col-sm-2 text-center"><label name="layout_02" id="layout_02"><img style="width: 100% !important" src="/totens/layout_02.png"><input '.( $playlist_layout === 2 ? 'checked' : Null ).' type="radio" name="layout" id="layout" value="2"></label></div>';
    $retorno .= '<div class="col-sm-2 text-center"><label name="layout_03" id="layout_03"><img style="width: 100% !important" src="/totens/layout_03.png"><input '.( $playlist_layout === 3 ? 'checked' : Null ).' type="radio" name="layout" id="layout" value="3"></label></div>';
    $retorno .= '<div class="col-sm-2 text-center"><label name="layout_04" id="layout_04"><img style="width: 100% !important" src="/totens/layout_04.png"><input '.( $playlist_layout === 4 ? 'checked' : Null ).' type="radio" name="layout" id="layout" value="4"></label></div>';
    $retorno .= '<div class="col-sm-2 text-center"><label name="layout_05" id="layout_05"><img style="width: 100% !important" src="/totens/layout_05.png"><input '.( $playlist_layout === 5 ? 'checked' : Null ).' type="radio" name="layout" id="layout" value="5"></label></div>';
    $retorno .= '<div class="col-sm-2 text-center"><label name="layout_06" id="layout_06"><img style="width: 100% !important" src="/totens/layout_06.png"><input '.( $playlist_layout === 6 ? 'checked' : Null ).' type="radio" name="layout" id="layout" value="6"></label></div>';
    $retorno .= '</div>';
    $retorno .= '</div>';
}


$retorno .= '</div>';



/*
https://youtube.com/embed?v=WfooWublzPk&list=PLtN5-guTBT2Fbd5MQ-b3bVrzEys6oi6jE&index=1&autoplay=1&loop=1


<iframe width="100%" height="600" src="https://youtube.com/embed?v=WfooWublzPk&list=PLtN5-guTBT2Fbd5MQ-b3bVrzEys6oi6jE&index=1&autoplay=1&loop=1" frameborder="0"></iframe>

<iframe width="100%" height="600" src="https://youtube.com/embed?v=89iwDLpVInI&list=PLtN5-guTBT2Grd0RTZmmeUaPo1tYZFD1S&index=1&autoplay=1&loop=1" frameborder="0"></iframe>

https://www.youtube.com/watch?v=qHNpsELY9xM&list=PLtN5-guTBT2HzIonBP-mSRW64HuaIWHbR
*/