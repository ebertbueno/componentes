<?php
$geraHashdeCadastro = '';
try {
	$data = User::find($users_id);
	$geraHashdeCadastro = $data['pais'] . $data['id'] . $data['nome'] . $data['nascimento'] . $data['numero_documento'] . $data['created_at'];
} catch (Exception $e) {
	$geraHashdeCadastro = $users_id;
}

$geraHashdeCadastro = md5($geraHashdeCadastro);