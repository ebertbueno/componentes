<?php
namespace App\Repositories;

use App\Models\Planos;

class CronsAgendadosRepositorie{
	static function CronsAgendadosRepositorie(){
		Planos::create([
			'emp_id'=>'2',
			'nome'=>'nome',
			'valor'=>rand(),
			'descricao'=>'descricao',
			'mostra_site'=>1,
		]);
	}
}