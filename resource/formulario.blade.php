{{-- @extends('administrator::layouts.layout_principal') --}}
{{-- @section('conteudo_geral') --}}

@include('telas.cabecalho')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                @include('telas.includes.breadcrumb', ['data' => $dados['titulo_pagina']])
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    @foreach ($dados['botoes_topo'] as $key => $d)
                        @include('telas.botoes.botao_padrao', ['data' => $d])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            @if (!empty($dados['formulario']))
                <div class="card mb-5 mb-xl-8">
                    <div class="card-body py-3">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded">
                                @include('telas.formulario_montado')
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- @endsection --}}
