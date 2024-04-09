<?php
if (!empty($data[$key0])) {
    $statusValidacao .= (!filter_var($data[$key0], FILTER_VALIDATE_EMAIL) ? 1 : 0);
    if ((int)$statusValidacao === 1) {
        $msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'mensagem' => ___($v)]);
    }
}
