<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\EscreveArquivoTraducaoLaravel;
use App\Repositories\Componentes;
use App\Repositories\SendRepositorie;
use App\Models\Users;
use App\Models\UsersDados;
use App\Models\PinSolicitados;

//	para site de categorias
class WebsiteRepositorie{

	static function register_grava($data){

	}

	static function check_register(){

	}

	static function check_register_grava($data){

	}

	static function dadosWebsite(){
		return usarJsonSite('/clientes/1/site/json.php');
	}
};