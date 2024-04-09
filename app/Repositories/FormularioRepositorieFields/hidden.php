<?php
$retorno = '<input ' . $campoLivre . ' type="hidden" value="' . (!is_array($valor_inicial) ? $valor_inicial : Null) . '" name="' . $nome_no_banco_de_dados . '">';