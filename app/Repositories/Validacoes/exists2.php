<?php
$campoAcao = explode(',', $campoAcao[1]);
$consulta = DB::table($campoAcao[0])->where($campoAcao[1], $data[$key0])->where($campoAcao[2], Auth()->user()->id)->get();

if ($consulta === 0) {
    $statusValidacao++;
    $msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'mensagem' => ___($v)]);
}