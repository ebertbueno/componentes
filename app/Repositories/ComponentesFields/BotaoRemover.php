<?php
$retornoBotao = '';
$alertBotaoRemover = (!empty($data['alertBotaoRemover']) ? $data['alertBotaoRemover'] : '');
switch ($alertBotaoRemover) {
    case 'desativar':
        $retornoBotao .= 'title:' . ___('Atenção') . '|';
        $retornoBotao .= 'text:' . ___('Deseja desativar esse registro') . '|';
        $retornoBotao .= 'type:' . 'warning' . '|';
        $retornoBotao .= 'confirmButtonColor:' . '#DD6B55' . '|';
        $retornoBotao .= 'confirmButtonText:' . ___('Sim') . '|';
        $retornoBotao .= 'cancelButtonText:' . ___('Não') . '|';
        break;

    case 'reativar':
        $retornoBotao .= 'title:' . ___('Atenção') . '|';
        $retornoBotao .= 'text:' . ___('Deseja reativar esse registro') . '|';
        $retornoBotao .= 'type:' . 'warning' . '|';
        $retornoBotao .= 'confirmButtonColor:' . '#DD6B55' . '|';
        $retornoBotao .= 'confirmButtonText:' . ___('Sim') . '|';
        $retornoBotao .= 'cancelButtonText:' . ___('Não') . '|';
        break;

    default:
        $retornoBotao .= 'title:' . ___('Atenção') . '|';
        $retornoBotao .= 'text:' . ___('Confirma ação') . '|';
        $retornoBotao .= 'type:' . 'warning' . '|';
        $retornoBotao .= 'confirmButtonColor:' . '#DD6B55' . '|';
        $retornoBotao .= 'confirmButtonText:' . ___('Sim') . '|';
        $retornoBotao .= 'cancelButtonText:' . ___('Não') . '|';
        break;
}

if (is_array($alertBotaoRemover)) {
    $retornoBotao = '';
    foreach ($alertBotaoRemover as $key => $botaoMontado) {
        $retornoBotao .= '' . $key . ':' . $botaoMontado . '|';
    }
}

$botao = '<a id="' . deixaApenasTexto($titulo . $label) . '" ' . mostraToolTip($titulo) . ' data-url="' . $url . '" data-alert="' . $retornoBotao . '" data-token=' . csrf_token() . ' title="' . $label . '" class="btn-apagar btn ' . $cor . ' ' . ($cor != 'btn-white' ? 'text-white' : Null) . ' float-right" data-toggle="tooltip" data-placement="top" style="margin: 0px 2px 0px 2px !important;">';
$botao .= $icone;
$botao .= $label;
$botao .= '</a>';