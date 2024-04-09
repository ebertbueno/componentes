<?php
$label = (!empty($data['label']) ? ___($data['label']) : Null);
$icone = (!empty($data['icone']) ? '<i class="'.$data['icone'].'"></i>' : Null);
$corBotao = (!empty($data['cor_botao']) ? '<i class="'.$data['cor_botao'].'"></i>' : 'link');
$corLinks = (!empty($data['cor_links']) ? '<i class="'.$data['cor_links'].'"></i>' : 'link');

$botao = '';
$botao .= '<div class="btn btn-default btn-block">';
$botao .= '<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">'.$icone.' &nbsp;  &nbsp; '.$label.'</a>';
$botao .= '<ul class="dropdown-menu dropdown-user btn-'.$corLinks.'" x-placement="bottom-start" style="position: absolute; top: 18px; left: -68px; will-change: top, left;">';

foreach( $data['botoes'] as $botoes ){
    $botao .= '<li>';
    $botao .= $botoes;
    $botao .= '</li>';
}

// $botao .= '<li><a href="#" class="dropdown-item">Config option 1</a></li>';
// $botao .= '<li><a href="#" class="dropdown-item">Config option 2</a></li>';
$botao .= '</ul>';
$botao .= '</div>';

return $botao;




/*

$d['acoes'] .= Componentes::GrupoBotao([
    'label'=>'Ações',
    'icone'=>'fa fa-cogs',
    'botoes' => [
        Componentes::MontaBotao(['cor'=>'primary btn-block','url'=>self::url.'/'.$d['id'].'/manutencoes','tipo'=>'LinkGeralIcone','icone'=>'fa fa-wrench','label'=>'Manutenções']),
        Componentes::MontaBotao(['cor'=>'success btn-block','url'=>self::url.'/'.$d['id'].'/abastecimento','tipo'=>'LinkGeralIcone','icone'=>'fa fa-bus','label'=>'Abastecimento']),
        Componentes::MontaBotao(['cor'=>'info btn-block','url'=>self::url.'/'.$d['id'].'/fotos','tipo'=>'LinkGeralIcone','icone'=>'fa fa-file-picture-o','label'=>'Fotos']),
        Componentes::MontaBotao(['cor'=>'warning btn-block','url'=>self::url.'/'.$d['id'].'/edit','tipo'=>'LinkGeralIcone','icone'=>'fa fa-pencil','label'=>'Editar']),
        Componentes::MontaBotao(['cor'=>'danger btn-block','url'=>self::url.'/'.$d['id'].'','tipo'=>'BotaoRemover','icone'=>'fa fa-trash','label'=>'Remover','classHref'=>'botaoRemover']),
    ],
]);

*/