<?php

$statusValidacao = $statusValidacao ?? 0;

$nome_no_banco_de_dados = $data[$validado['nome_no_banco_de_dados']];
if (strlen($nome_no_banco_de_dados) < $v['valor']) {
    $statusValidacao++;

    $msgRetorno[] = [
        'tipo' => 'botaoToaster',
        'cor' => 'warning',
        'titulo' => ___('Atenção') . ' - ' . $validado['label'],
        'mensagem' => self::mensagensPadrao('min', $v['valor']),
    ];
}
