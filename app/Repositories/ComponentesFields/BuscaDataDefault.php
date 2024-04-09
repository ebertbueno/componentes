<?php
$BuscaData = '';
$BuscaData .= '<div class="col-sm-5">';
$BuscaData .= '<input type="date" name="data_i" id="data_i" value="'.$data['data_i'].'" class="form_control" style="width:100%">';
$BuscaData .= '</div>';
$BuscaData .= '<div class="col-sm-5">';
$BuscaData .= '<input type="date" name="data_f" id="data_f" value="'.$data['data_f'].'" class="form_control" style="width:100%">';
$BuscaData .= '</div>';
$BuscaData .= '<div class="col-sm-2">';
$BuscaData .= '<button id="botaoEnviar" class="btn btn-sm btn-primary btn-block '.$pullright.'"> <i class="fa fa-search"> </i> </button>';
$BuscaData .= '</div>';