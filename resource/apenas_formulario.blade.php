<?php
if (!empty($formulario['nome_no_banco_de_dados'])) {
    if (!empty($dados['data'][$formulario['nome_no_banco_de_dados']])) {
        $formulario['valor_inicial'] = $dados['data'][$formulario['nome_no_banco_de_dados']];
    }
}
$tipo = $formulario['tipo'] ?? 'text';

$css_adicional = 'padding: auto 50px !important';
if ($tipo === 'titulo') {
    $css_adicional = 'padding: 0px !important';
}
?>

@if (!empty($formulario['formulario']))
    <div class="mb-6 col-md-{!! $formulario['formulario'] ?? 12 !!}" style="{!! $css_adicional !!}">
@endif

@switch($tipo)
    @case('textarea')
        @include('telas.formulario.textarea', ['data' => $formulario])
    @break

    @case('password')
        @include('telas.formulario.password', ['data' => $formulario])
    @break

    @case('select')
        @include('telas.formulario.select', ['data' => $formulario])
    @break

    {{-- @case('select2')
        @include('telas.formulario.select2', ['data' => $formulario])
    @break --}}

    @case('repeater')
        @include('telas.formulario.repeater', ['data' => $formulario])
    @break

    @case('vazio')
        @include('telas.formulario.vazio', ['data' => $formulario])
    @break

    @case('arvore_acessos')
        @include('telas.formulario.arvore_acessos', ['data' => $formulario])
    @break

    @case('switch')
        @include('telas.formulario.switch', ['data' => $formulario])
    @break

    @case('switch_label')
        @include('telas.formulario.switch_label', ['data' => $formulario])
    @break

    @case('titulo')
        @include('telas.formulario.titulo', ['data' => $formulario])
    @break

    @case('optgroup')
        @include('telas.formulario.optgroup', ['data' => $formulario])
    @break

    @case('campos_para_documentos')
        @include('telas.formulario.campos_para_documentos', ['data' => $formulario])
    @break

    @case('submit')
    @case('reset')
        @include('telas.formulario.botao_formulario', ['data' => $formulario])
    @break

    @default
        @include('telas.formulario.default', ['data' => $formulario])
@endswitch

@if (!empty($formulario['msg_base']))
    <small>{!! $formulario['msg_base'] !!}</small>
@endif

@if (!empty($formulario['formulario']))
    </div>
@endif
