<?php

$nome_no_banco_de_dados = $data[$validado['nome_no_banco_de_dados']];
if (!empty($nome_no_banco_de_dados)) {
    $arquivo = $_FILES;
    foreach ($arquivo as $key2 => $a2) {
        if ($a2['size'] > $v['valor']) {
            $msgRetorno[] = [
                'tipo' => 'botaoToaster',
                'cor' => 'warning',
                'titulo' => ___('Atenção') . ' - ' . $validado['label'],
                'mensagem' => self::mensagensPadrao('tamanho')
            ];
        }
    }
}
