<?php

namespace App\Repositories;

use App\Repositories\Tratamentos;
/*
	armazena todas as consultas que serão executadas
	'tabela_relacional'=>[
		'model'=>'Textos',
		'select'=>['texto as value', 'titulo as label_1'],
		'where'=>['campo'=>'condicao'],
		'order' => [array de where],
	],
*/

class ConsultasRepositore
{
	static function ConsultasRepositore($data)
	{
		/*
			$data = [
				'model' => nomedamodel,
				'select' => [array de select],
				'where' => [array de where],
				'order' => [array de where],
			]
		*/
		if (!empty($data['model'])) {
			$qualModel = $data['model'];
			$conexao = 'App\Models\\' . $qualModel;
			$objeto = new $conexao();
			$order = (!empty($data['order']) ? $data['order'] : 'id');
			if (!empty($data['where'])) {
				$retorno = $objeto::select($data['select'])->where($data['where'])->orderby($order)->get();
			} else {
				$retorno = $objeto::select($data['select'])->orderby($order)->get();
			}
		} else {
			if (is_array($data)) {
				$tipo = $data['tabela'];
			} else {
				$tipo = (!empty($data['tipo']) ? $data['tipo'] : $data);
			}

			switch ($tipo) {
					// aqui deve se passar a condição da tabela textos, definido no campo local_uso
				case 'Consulta_Sim_Nao':
					$retorno = [
						['value' => 's', 'label_1' => ___('Sim'),],
						['value' => 'n', 'label_1' => ___('Não'),],
					];
					break;

				case 'Consulta_1_0':
					$retorno = [
						['value' => '1', 'label_1' => ___('Sim'),],
						['value' => '0', 'label_1' => ___('Não'),],
					];
					break;

				case 'Estados_Brasileiros':
					$retorno = [
						['label_1' => 'Acre', 'value' => 'AC'],
						['label_1' => 'Alagoas', 'value' => 'AL'],
						['label_1' => 'Amapá', 'value' => 'AP'],
						['label_1' => 'Amazonas', 'value' => 'AM'],
						['label_1' => 'Bahia', 'value' => 'BA'],
						['label_1' => 'Ceará', 'value' => 'CE'],
						['label_1' => 'Distrito Federal', 'value' => 'DF'],
						['label_1' => 'Espírito Santo', 'value' => 'ES'],
						['label_1' => 'Goiás', 'value' => 'GO'],
						['label_1' => 'Maranhão', 'value' => 'MA'],
						['label_1' => 'Mato Grosso', 'value' => 'MT'],
						['label_1' => 'Mato Grosso do Sul', 'value' => 'MS'],
						['label_1' => 'Minas Gerais', 'value' => 'MG'],
						['label_1' => 'Pará', 'value' => 'PA'],
						['label_1' => 'Paraíba', 'value' => 'PB'],
						['label_1' => 'Paraná', 'value' => 'PR'],
						['label_1' => 'Pernambuco', 'value' => 'PE'],
						['label_1' => 'Piauí', 'value' => 'PI'],
						['label_1' => 'Rio de Janeiro', 'value' => 'RJ'],
						['label_1' => 'Rio Grande do Norte', 'value' => 'RN'],
						['label_1' => 'Rio Grande do Sul', 'value' => 'RS'],
						['label_1' => 'Rondônia', 'value' => 'RO'],
						['label_1' => 'Roraima', 'value' => 'RR'],
						['label_1' => 'Santa Catarina', 'value' => 'SC'],
						['label_1' => 'São Paulo', 'value' => 'SP'],
						['label_1' => 'Sergipe', 'value' => 'SE'],
						['label_1' => 'Tocantins', 'value' => 'TO'],
					];
					break;

				case 'Entrada_Saida':
					$retorno = [
						['label_1' => 'Entrada', 'value' => 'e'],
						['label_1' => 'Saída', 'value' => 's'],
					];
					break;

				case 'Status_Cadastro_Usuarios':
					$retorno = Model('Textos')::query();
					$retorno->where('local_uso', 'Status_Cadastro_Usuarios');
					$retorno->select(['id as value', 'titulo as label_1']);
					$retorno->orderby('titulo');
					$retorno = $retorno->get();
					break;

				case 'Sexo':
					$retorno = Model('Textos')::query();
					$retorno->where('local_uso', 'sexo');
					$retorno->select(['id as value', 'titulo as label_1']);
					$retorno->orderby('titulo');
					$retorno = $retorno->get();
					break;

				case 'Idioma':
					$retorno = Model('Textos')::query();
					$retorno->where('local_uso', 'idiomas');
					$retorno->select(['link as value', 'titulo as label_1']);
					$retorno->orderby('titulo');
					$retorno = $retorno->get();
					break;

				case 'Tipo_Telefone':
					$retorno = Model('Textos')::query();
					$retorno->where('local_uso', 'tipo_telefone');
					$retorno->select(['id as value', 'titulo as label_1']);
					$retorno->orderby('titulo');
					$retorno = $retorno->get();
					break;

				case 'Usuarios':
					$retorno = Model('Users')::query();
					$retorno->where('nivel', 'Usuario');
					$retorno->select(['id as value', 'name as label_1']);
					$retorno->orderby('name');
					$retorno = $retorno->get();
					break;

				case 'locais_de_aplicacao_template':
					$retorno = Model('Textos')::query();
					$retorno->where('local_uso', 'locais_de_aplicacao_template');
					$retorno->select(['id as value', 'titulo as label_1']);
					$retorno->orderby('titulo');
					$retorno = $retorno->get();
					break;

				case 'Clientes':
					$retorno = Model('Users')::query();
					$retorno->where('nivel', 'Client');
					$retorno->select(['id as value', 'name as label_1']);
					$retorno->orderby('name');
					$retorno = $retorno->get();
					break;

				case 'FormasPgto':
					$data = Model('Textos')::query();
					$data->where('local_uso', 'formas_pgto');
					$data->orderby('titulo');
					$data = $data->get();

					$retorno = [];
					foreach ($data as $key => $d) {
						$retorno[] = [
							'value' => $d['id'],
							'label_1' => $d['registroFilho']['name'] ?? $d['titulo'],
						];
					}
					break;

				case 'Contratos':
					$retorno = Model('Templates')::query();
					$retorno->where('local_uso', 'contratos');
					$retorno->select(['id as value', 'titulo as label_1']);
					$retorno->orderby('titulo');
					$retorno = $retorno->get();
					break;

				case 'Produtos':
					$retorno = Model('Products')::query();
					$retorno->select(['id as value', 'code as label_1', 'name as label_2', 'price as label_3']);
					$retorno->orderby('code');
					$retorno->orderby('name');
					$retorno = $retorno->get();
					break;

				case 'StatusPgto':
					$retorno = Model('Textos')::query();
					$retorno->where('local_uso', 'status_pgto');
					$retorno->select(['id as value', 'titulo as label_1']);
					$retorno->orderby('titulo');
					$retorno = $retorno->get();
					break;

				case 'CoresBotoes':
					$retorno = [
						['value' => 'light', 'label_1' => 'light'],
						['value' => 'primary', 'label_1' => 'primary'],
						['value' => 'secondary', 'label_1' => 'secondary'],
						['value' => 'success', 'label_1' => 'success'],
						['value' => 'info', 'label_1' => 'info'],
						['value' => 'warning', 'label_1' => 'warning'],
						['value' => 'danger', 'label_1' => 'danger'],
						['value' => 'dark', 'label_1' => 'dark'],
					];
					break;

				case 'Consulta_Perfil_de_Acesso':
					$retorno = Model('Textos')::query();
					$retorno->where('local_uso', 'perfis_de_acesso');
					$retorno->select(['id as value', 'titulo as label_1']);
					$retorno->orderby('titulo');
					$retorno = $retorno->get();
					break;

				default:
					$retorno = [];
					break;
			}
		}

		// foreach ($retorno as $key => $data) {
		// 	$data['label_1'] = ___($data['label_1']);
		// 	if (isset($data['label_2'])) {
		// 		$data['label_2'] = ___($data['label_2']);
		// 	}
		// }

		return $retorno;
	}


	static function WidgetConsultasRepositore($qualConsulta = '')
	{
		switch ($qualConsulta) {
			case 'select_ultimos_usuarios':
				$consulta = User::where('root', Auth()->user()->id)->select('name as label_1', 'created_at as label_2', 'foto as imagem')->orderby('id', 'desc')->whereBetween('created_at', primeiroUltimodia())->get();
				break;
			default:
				$consulta = [];
				break;
		}
		return $consulta;
	}
};
