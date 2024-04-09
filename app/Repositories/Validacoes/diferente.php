<?php
if (($data[$key0] * 1) === ($data[$campoAcao[1]] * 1)) {
    $statusValidacao++;
    $msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'mensagem' => ___($v)]);
}
