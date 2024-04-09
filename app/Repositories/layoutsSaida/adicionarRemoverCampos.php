<?php

$tamanhoDivExterna = (!empty($data['formulario']) ? $data['formulario'] : 2);

$camposMontados = '';
foreach ($data['campos'] as $key => $campos) {
    $camposMontados .= $campos;
}
$camposMontados = str_replace('"', '\"', $camposMontados);

$novoCamposMontados = '';

$grupo = (!empty($data['grupo']) ? $data['grupo'] : 'grupo_' . rand(1, 1000));

if (!empty($data['valor_inicial'])) {
    foreach ($data['campos_nome'] as $key => $camposNomes) {

        foreach ($data['valor_inicial'][$key] as $key => $rootFilho) {
            $percorreCampos = explode('name=\"', $camposMontados);
            $novoCamposMontados .= '<div class="row" style="padding:0px;">';
            $novoCamposMontados .= '<div id="'.$grupo.'" style="width: 100% !important;">';
            $novoCamposMontados .= '<div id="'.$grupo.'' . $key . '">';
            $novoCamposMontados .= '<div class="row">';

            foreach ($camposNomes as $key => $campos) {
                $novoCamposMontados .= '<div class="col-md-' . $campos['tamanho'] . '">';
                $novoCamposMontados .= '<label class="col-md-12 col-form-label" style="line-height:1 !important; font-weight: bold !important"><small>(*) </small>' . $campos['label'] . ' - ' . $campos['nome_no_banco_de_dados'] . '</label>';
                $novoCamposMontados .= '<input autocomplete="off" required="required" value="' . $rootFilho[$campos['nome_no_banco_de_dados']] . '" name="' . $campos['nome_no_banco_de_dados'] . '[]" id="' . $campos['nome_no_banco_de_dados'] . '[]" class=" form-control form-control" style="">';
                $novoCamposMontados .= '</div>';
            }

            $novoCamposMontados .= '<div class="col-md-1" style="padding-top: 30px; margin-left: -14px; ">';
            $novoCamposMontados .= '<a onclick="removerCampo'.$grupo.'(' . $key . ')"><li class="btn btn-block btn-danger"><i class="fa fa-trash"></i></li></a>';
            $novoCamposMontados .= '</div>';
            $novoCamposMontados .= '</div>';
            $novoCamposMontados .= '</div>';
            $novoCamposMontados .= '</div>';
        }
    }
}

$retorno = '
<div class="row">
<div class="col-md-' . $tamanhoDivExterna . '">
' . ___($data['label']) . '
</div>
<div class="col-md-' . (12 - $tamanhoDivExterna) . '">
' . (!empty($data['valor_inicial']) ? $novoCamposMontados : Null) . '
<div class="row" style="padding:0px;">
<div id="' . $grupo . '" style="width: 100% !important;"></div>
<div class="col-md-11">&nbsp;</div>
<div class="col-md-1" style="padding-top: 30px;">
<a onclick="addCampos'.$grupo.'()" style="cursor: pointer"><li class="btn btn-primary btn-block"><i class="fa fa-plus"></i></li></a>
</div>
</div>
</div>
</div>
<div class="col-md-12">&nbsp;</div>


<script type="text/javascript">
var qtdeCampos = ' . (!empty($data['valor_inicial']) ? (count($data['valor_inicial']['rootFilho'])) : 0) . ';
function addCampos'.$grupo.'() {
	var objPai = document.getElementById("' . $grupo . '");
	var objFilho = document.createElement("div");
	objFilho.setAttribute("id","' . $grupo . '"+qtdeCampos);
	objPai.appendChild(objFilho);
	var	campos = "<div class=\"row\">' . $camposMontados . '";
	campos += "<div class=\"col-md-1\" style=\"padding-top: 30px; margin-left: -14px; padding-top: 0px; margin-left: 0px; \"><a onClick=\"removerCampo'.$grupo.'("+qtdeCampos+")\"><li class=\"btn btn-block btn-danger\"><i class=\"fa fa-trash\"></i></li></a></div>"
	campos += "</div><hr>";
	document.getElementById("' . $grupo . '"+qtdeCampos).innerHTML = campos;
	qtdeCampos++;
}
function removerCampo'.$grupo.'(id) {
	var objPai = document.getElementById("' . $grupo . '");
	var objFilho = document.getElementById("' . $grupo . '"+id);
	var removido = objPai.removeChild(objFilho);
}
</script>
';

return $retorno;



























/*
exemplo de uso



        $formulario[] = FormularioRepositorie::adicionarRemoverCampos([
            'label' => 'Competências',
            'grupo' => 'grupo01',
            'valor_inicial' => ( !empty($id) ? $data : [] ),
            'campos_nome' => [
                'rootFilho' => [
                    ['tamanho' => 3,'nome_no_banco_de_dados' => 'ordem', 'label' => 'Pontos'],
                    ['tamanho' => 8,'nome_no_banco_de_dados' => 'titulo', 'label' => 'Frase do ponto']
                ]
            ],
            'campos' => [
                FormularioRepositorie::formulario([
                    'formulario' => 3,
                    'label' => 'Pontos',
                    'nome_no_banco_de_dados' => 'ordem[]',
                    'modoSaidaFormulario' => 'camposLadoALado',
                    'tipo' => 'number',
                    'required'=>1,
                    'valor_inicial' => '',
                ]),
                FormularioRepositorie::formulario([
                    'formulario' => 8,
                    'label' => 'Frase do ponto',
                    'nome_no_banco_de_dados' => 'titulo[]',
                    'modoSaidaFormulario' => 'camposLadoALado',
                    'required'=>1,
                    'valor_inicial' => '',
                ]),
            ],
        ]);

*/



/*

modelo de uso

        $formulario[] = FormularioRepositorie::adicionarRemoverCampos([  // função estática dentro do repositorie
            'label' => 'Competências',
            'grupo' => 'grupo01', // caso se use mais de um repetidor
            'campos' => [
                FormularioRepositorie::formulario([
                    'formulario' => 3,
                    'label' => 'Pontos',
                    'nome_no_banco_de_dados' => 'pontos[]',
                    'modoSaidaFormulario' => 'camposLadoALado', // modo de saida utilizado
                    'tipo' => 'number',
                    'required'=>1,
                    'valor_inicial' => ( !empty($data['pontos']) ? $data['pontos'] : ''),
                ]),
                FormularioRepositorie::formulario([
                    'formulario' => 8,
                    'label' => 'Frase do ponto',
                    'nome_no_banco_de_dados' => 'criterio[]',
                    'modoSaidaFormulario' => 'camposLadoALado',
                    'required'=>1,
                    'valor_inicial' => ( !empty($data['pontos']) ? $data['pontos'] : ''),
                ]),
            ],
        ]);








########################################################################################
origem natual

<input type="button" value="Adicionar campos" onclick="addCampos()">
<br><br>
<div id="campoPaiteste"></div>


<script type="text/javascript">
	var qtdeCampos = 0;
	function addCampos() {
		var objPai = document.getElementById("campoPaiteste");
		var objFilho = document.createElement("div");
		objFilho.setAttribute("id","filho"+qtdeCampos);
		objPai.appendChild(objFilho);
		var campos = "<div class=\"col-md-3\"><input type=\"text\" id=\"campo"+qtdeCampos+"\" name=\"campo[]\" value=\"Campo com id: "+qtdeCampos+"\"></div>";
			campos += "<div class=\"col-md-1\" style=\"padding-top: 30px; margin-left: -14px;\"><a onClick=\"removerCampo("+qtdeCampos+")\"><li class=\"btn btn-block btn-danger\"><i class=\"fa fa-trash\">Remover</i></li></a></div>";
		document.getElementById("filho"+qtdeCampos).innerHTML = campos;
		qtdeCampos++;
	}
	function removerCampo(id) {
		var objPai = document.getElementById("campoPaiteste");
		var objFilho = document.getElementById("filho"+id);
		var removido = objPai.removeChild(objFilho);
	}
</script>
*/