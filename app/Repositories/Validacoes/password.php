<?php

$nome_no_banco_de_dados = $data[$validado['nome_no_banco_de_dados']];
$re_nome_no_banco_de_dados = $data['re-' . $validado['nome_no_banco_de_dados']];

if (!empty($nome_no_banco_de_dados) && !empty($re_nome_no_banco_de_dados)) {
    if ($nome_no_banco_de_dados != $re_nome_no_banco_de_dados) {
        $statusValidacao++;
        $msgRetorno[] = [
            'tipo' => 'botaoToaster',
            'cor' => 'warning',
            'titulo' => ___('Atenção') . ' - ' . $validado['label'],
            'mensagem' => self::mensagensPadrao('password')
        ];
    // } else {
        // $data[$validado['nome_no_banco_de_dados']] = bcrypt($data[$validado['nome_no_banco_de_dados']]);
        // unset($data['re-' . $validado['nome_no_banco_de_dados']]);
    }
}
