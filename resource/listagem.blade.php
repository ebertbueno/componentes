{{-- @extends('administrator::layouts.layout_principal') --}}
{{-- @section('conteudo_geral') --}}

@include('telas.cabecalho')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                @include('telas.includes.breadcrumb', ['data' => $dados['titulo_pagina']])
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    @if (!empty($dados['botoes_topo']))
                        @foreach ($dados['botoes_topo'] as $key => $d)
                            @include('telas.botoes.botao_padrao', ['data' => $d])
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        @if (!empty($dados['formulario']))
            <div id="kt_app_content_container" class="app-container container-fluid">
                @include('telas.formulario_montado')
            </div>
        @endif

        <div id="kt_app_content_container" class="app-container container-fluid">
            @include('telas.datatable')
        </div>
    </div>
</div>

{{-- @endsection --}}
