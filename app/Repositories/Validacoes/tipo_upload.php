<?php

$nome_no_banco_de_dados = $data[$validado['nome_no_banco_de_dados']];
if (!empty($nome_no_banco_de_dados)) {
    $arquivo = $_FILES;
    foreach ($arquivo as $key2 => $a2) {
        $nomeArquivo = explode('.', $a2['name']);
        $nomeArquivo = strtolower($nomeArquivo[count($nomeArquivo) - 1]);
        if (!in_array($nomeArquivo, $v['valor'])) {
            $msgRetorno[] = [
                'tipo' => 'botaoToaster',
                'cor' => 'warning',
                'titulo' => ___('Atenção') . ' - ' . $validado['label'],
                'mensagem' => self::mensagensPadrao('tipo_upload')
            ];
        }
    }
}