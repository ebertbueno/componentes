<?php
use App\Repositories\Componentes;

$botaoModalPersonalizado = '';

if( !empty($id) ){
	$texto = ( !empty($texto) ? $texto : ___('Confirma ação') );
	$botaoModalPersonalizado .= "function reativaVeiculo(".$id.") {";
	$botaoModalPersonalizado .= "swal({";
	$botaoModalPersonalizado .= "title: ".___('Aviso').",";
	$botaoModalPersonalizado .= "text: ".___($texto).",";
	$botaoModalPersonalizado .= "type: 'warning',";
	$botaoModalPersonalizado .= "confirmButtonText: '".___('Sim')."',";
	$botaoModalPersonalizado .= "showCancelButton: true,";
	$botaoModalPersonalizado .= "cancelButtonText: '".___('Não')."',";
	$botaoModalPersonalizado .= "confirmButtonColor: '#3085d6',";
	$botaoModalPersonalizado .= "cancelButtonColor: '#d33',";
	$botaoModalPersonalizado .= "}).then((result) => {";
	$botaoModalPersonalizado .= "if( result.value ){";
	$botaoModalPersonalizado .= "uptDados(".$id.");";
	$botaoModalPersonalizado .= "}";
	$botaoModalPersonalizado .= "});";
	$botaoModalPersonalizado .= "}";
}