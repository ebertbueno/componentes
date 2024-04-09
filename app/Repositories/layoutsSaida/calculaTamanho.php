<?php

$qdadeCampos = count(pegaDadosContrato('loja_veiculos_usados'));

$larguraCampo = (int)($tamanho / $qdadeCampos);
if ($larguraCampo * $qdadeCampos > $tamanho) {
    $tamanho = $tamanho - 1;
    calculaTamanho($qdadeCampos, $tamanho);
}
return $larguraCampo;
