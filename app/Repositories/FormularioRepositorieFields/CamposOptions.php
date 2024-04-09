<?php
namespace App\Repositories\FormularioRepositorieFields;

use App\Repositories\ConsultasRepositore;

class CamposOptions{

	static function optionsMontado($data){
		$option = '';
		$dados = ConsultasRepositore::ConsultasRepositore($data['tabela_relacional']);
		// dd($dados);

		foreach( $dados as $dado ){
			if( empty($data['tabela_relacional_campos']) ){
				if( is_array($data['valor_inicial']) ){
					$selecionado = ( in_array((int)$dado['value'],$data['valor_inicial']) ? 'selected="selected"' : Null );
				} else {
					$selecionado = ( $data['valor_inicial'] === $dado['value'] ? 'selected="selected"' : Null );
				}


				$option .= '<option '.$selecionado.' value="'.$dado['value'].'">';
				$option .= $dado['label_1'];
				$option .= ( isset($dado['label_2']) ? ' - ' . $dado['label_2'] : Null );
				$option .= ( isset($dado['label_3']) ? ' - ' . $dado['label_3'] : Null );
				$option .= '</option>';
			} else {
				if( is_array($data['valor_inicial']) ){
					$selecionado = ( in_array((int)$dado['value'],$data['valor_inicial']) ? 'selected="selected"' : Null );
				} else {
					$selecionado = ( $data['valor_inicial'] === $dado['value'] ? 'selected="selected"' : Null );
				}
				$option .= '<option '.$selecionado.' value="'.$dado[$data['tabela_relacional_campos']['value']].'">';
				foreach( $data['tabela_relacional_campos']['label'] as $key => $campos ){
					if( !empty($dado[$campos]) ){
						$option .= $dado[$campos];
						if( ($key+1) < count($data['tabela_relacional_campos']['label']) ){
							$option .= ' - ';
						}
					}
				}
				$option .= '</option>';
			}
		}

		return $option;
	}
}




/*
<script>
	var windowWidth = window.innerWidth;
	var windowHeight = window.innerHeight;

	var screenWidth = screen.width;
	var screenHeight = screen.height;

	var tamanhodatela = Math.round(windowWidth * 75.5 / 100);

	document.getElementById("mostraTamanhodaTela").innerHTML = tamanhodatela;
</script>




passar dentro do formulário para formatar os campos
'tabela_relacional_campos' => [
     'value' => 'id',
     'label' => [
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'estado',
        'pais',
     ],
],
*/