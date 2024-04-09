<?php
$campoAcao = explode('|', $campoAcao[1]);

if (!empty($data['id'])) {
    $consulta1 = Model($campoAcao[0], $campoAcao[1])::where($campoAcao[2], $data[$campoAcao[2]])->where('emp_id', Auth()->user()->emp_id)->where('id', '<>', $data['id'])->withTrashed()->count();
    $consulta2 = Model($campoAcao[0], $campoAcao[1])::where($campoAcao[2], $data[$campoAcao[2]])->where('emp_id', 0)->where('id', '<>', $data['id'])->withTrashed()->count();
    $consulta = $consulta1 + $consulta2;
} else {
    $consulta1 = Model($campoAcao[0], $campoAcao[1])::where($campoAcao[2], $data[$campoAcao[2]])->where('emp_id', Auth()->user()->emp_id)->withTrashed()->count();
    $consulta2 = Model($campoAcao[0], $campoAcao[1])::where($campoAcao[2], $data[$campoAcao[2]])->where('emp_id', 0)->withTrashed()->count();
    $consulta = $consulta1 + $consulta2;
}

if ($consulta != 0) {
    $statusValidacao++;
    $msgRetorno .= Componentes::MontaBotao(['tipo' => 'botaoToaster', 'cor' => 'warning', 'titulo' => ___('Atenção') . ' - ' . $placeholder, 'mensagem' => ___($v)]);
}
