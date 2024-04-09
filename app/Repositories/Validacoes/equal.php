<?php
$campoAcao = explode(',', $campoAcao[1]);
if ($data[$campoAcao[0]] != $data[$campoAcao[1]]) {
    $statusValidacao++;
    $msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'mensagem' => ___($v)]);
}