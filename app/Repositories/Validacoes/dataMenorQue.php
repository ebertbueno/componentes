<?php
$dataDigitada = (int)formataData($data[$key0], 'ymd');
$dataReferencia = (int)formataData($campoAcao[1], 'ymd');

if ($dataDigitada > $dataReferencia) {
    $statusValidacao++;
    $msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'mensagem' => str_replace('|data|', formataData($campoAcao[1], 'd/m/Y'), ___('' . $v))]);
}
