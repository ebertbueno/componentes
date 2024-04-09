<?php
if (strlen($data[$key0]) <= $campoAcao[1]) {
    $statusValidacao++;
    $msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'mensagem' => ___($v)]);
}
