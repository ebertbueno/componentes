<?php
$retorno = ___($label);
$retorno .= $label_botao_direita;
$retorno .= '<input ' . $campoLivre . ' ' . $required . ' value="' . $valor_inicial . '" name="' . $nome_no_banco_de_dados . '" id="' . $nome_no_banco_de_dados . '" type="file" class="' . $cssAdicionalInput . '">' . $msg_complementar;
$retorno .= '<img src="' . url("sem_imagem.png") . '" style="margin-top: 65px; max-height: 250px;">';
$retorno .= '<script type="text/javascript" src="//code.jquery.com/jquery-2.1.0.js"></script>';
$retorno .= '<script type="text/javascript" src="/js/previa_imagem_upload.js"></script>';
