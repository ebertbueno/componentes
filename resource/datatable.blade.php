<div class="card mb-5 mb-xl-8">
    <div class="card-body py-3">
        <div class="table-responsive">
            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                <thead>
                    <tr class="fw-bold text-muted">
                        @foreach ($dados['datatable'] as $key => $d)
                            <th style="width: {!! $d['largura'] ?? 5 !!}% !important">{!! $d['label'] ?? Null !!}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados['data'] as $key => $data)
                        <tr id="linha_tabela_{!! $data['hash_id'] !!}">
                            @forelse ($dados['datatable'] as $key => $d)
                                @switch($d['nome_banco_de_dados'] ?? 'vazio')
                                    @case('acoes')
                                        <td style="float: right !important">
                                            @if (!empty($data['acoes']))
                                                @foreach ($data['acoes'] as $key => $acoes)
                                                    @include('telas.botoes.botao_acoes', [
                                                        'data' => $acoes,
                                                    ])
                                                @endforeach
                                            @endif
                                        </td>
                                    @break

                                    @default
                                        <td>
                                            {!! $data[$d['nome_banco_de_dados'] ?? Null] ?? Null !!}
                                        </td>
                                @endswitch
                                @empty
                                @endforelse
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
