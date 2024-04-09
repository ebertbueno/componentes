<?php

$urlCompleta = siteBase() . 'clientes/' . $valor_inicial . '/anexar_documentos';

$retorno = '<div class="form-group row" style="width: 100%;">';
$retorno .= '<label class="col-sm-' . $tamLabel . ' col-form-label">' . $required_label . ___($label) . '</label>';
$retorno .= '<div class="col-sm-' . ($tamDiv - 5) . '">';

$retorno .= '<div class="input-group m-b">';
$retorno .= $mostraIconeA;

$retorno .= '<style>.area{box-sizing:border-box;width:300px !important;}.area video{width:100%;height:auto;background-color:#f5f5f5}.area textarea{width:100%;margin-top:10px;height:80px;box-sizing:border-box}.area button{-webkit-appearance:none;width:100%;box-sizing:border-box;padding:10px;text-align:center;background-color:#068c84;color:#fff;text-transform:uppercase;border:1px solid #fff;box-shadow:0 1px 5px #666}.area button:focus{outline:0;background-color:#0989b0}.area img{max-width:100%;height:auto}.area .caminho-imagem{padding:5px 10px;border-radius:3px;background-color:#068c84;text-align:center}.area .caminho-imagem a{color:#fff;text-decoration:none}.area .caminho-imagem a:hover{color:#ff0}</style>';
$retorno .= '<div class="area">';
$retorno .= '<video autoplay="true" id="webCamera' . $nome_no_banco_de_dados . '"></video>';
$retorno .= '<textarea type="text" id="' . $nome_no_banco_de_dados . '" name="' . $nome_no_banco_de_dados . '"></textarea>';
$retorno .= '<button type="button" onclick="takeSnapShot_' . $nome_no_banco_de_dados . '()">' . $label . '</button>';

$retorno .= '<script>';
$retorno .= 'function loadCamera' . $nome_no_banco_de_dados . '(){var e=document.querySelector("#webCamera' . $nome_no_banco_de_dados . '");e.setAttribute("autoplay",""),e.setAttribute("muted",""),e.setAttribute("playsinline",""),navigator.mediaDevices.getUserMedia&&navigator.mediaDevices.getUserMedia({audio:!1,video:{facingMode:"user"}}).then(function(t){e.srcObject=t}).catch(function(e){';

$retorno .= "toastr.warning('Câmera não encontrada', 'Atenção', {timeOut: 2000,showEasing: 'linear',showMethod: 'slideDown',closeMethod: 'fadeOut',closeDuration: 300,closeEasing: 'swing',closeButton: false,progressBar: true});";

$retorno .= '})}';
$retorno .= 'function takeSnapShot_' . $nome_no_banco_de_dados . '(){var e=document.querySelector("#webCamera' . $nome_no_banco_de_dados . '"),t=document.createElement("canvas");t.width=e.videoWidth,t.height=e.videoHeight,t.getContext("2d").drawImage(e,0,0,t.width,t.height);var a=t.toDataURL("image/png");document.querySelector("#' . $nome_no_banco_de_dados . '").value=a,sendSnapShot(a)}function sendSnapShot(e){}loadCamera' . $nome_no_banco_de_dados . '();';

$retorno .= '</script>';
$retorno .= '</div>';

$retorno .= $campoAvulso;
$retorno .= $mostraIconeD;

$retorno .= '</div>';
$retorno .= $msg_base;
$retorno .= '</div>';
$retorno .= '<div class="col-sm-5">';
$retorno .= '<img src="http://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=' . $urlCompleta . '">';
$retorno .= '<br>';
$retorno .= '<a target="_blank" href="' . $urlCompleta . '">' . $urlCompleta . '</a>';
$retorno .= '<br>';
$retorno .= ___('Aponte o celular para o QRCode para anexar fotos dos documentos ou clique no link para acessar.');
$retorno .= '</div>';
$retorno .= '</div>';
