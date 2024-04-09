<?php
$valorDeReferencia = formataMoedaCompleta($campoAcao[1]);
$valorDeEntrada = formataMoedaCompleta($data[$key0]);

if ($valorDeReferencia > $valorDeEntrada) {
    $statusValidacao++;
    $msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'mensagem' => str_replace('|min|', $campoAcao[1], ___('' . $v))]);
}
