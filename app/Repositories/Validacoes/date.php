<?php

$data = $data[$validado['nome_no_banco_de_dados']];
$d = DateTime::createFromFormat('Y-m-d', $data);
if ($d && $d->format('Y-m-d') != $data) {
    $statusValidacao++;
    $msgRetorno[] = [
        'tipo' => 'botaoToaster',
        'cor' => 'warning',
        'titulo' => ___('Atenção') . ' - ' . $validado['label'],
        'mensagem' => mensagensPadrao('date')
    ];
}
