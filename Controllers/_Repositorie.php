<?php

namespace App\Controllers;

use App\Http\Controllers\GlobalController;
use App\Repositories\FormularioValidacoes;
use App\Repositories\Tratamentos;
use Illuminate\Http\Request;

class Clientes_Repositorie
{
    const url = 'cadastros/clientes';
    const tabela = 'Users';
    const nivel = 'Client';

    static function index($local = 'lista')
    {
        $data = Model(self::tabela)::query();
        $data->where('nivel', self::nivel);
        $data->orderby('name');
        $data = $data->get();

        if ($local === 'api') {
            return response()->json($data);
        }

        foreach ($data as $key => $d) {
            $d['contador'] = ($key + 1);

            $last_login = $d['usersLogsSystem']['created_at'] ?? 'vazio';
            $d['last_login'] = ($last_login != 'vazio' ? formataData($last_login) : ' - ');
            $d['logotipo'] = verificaImagemSistem($d['UsersData']['avatar'] ?? Null, 'div');
            $d['acoes'] = botoesInternos(self::url, 'interno_datatable', ($d['hash_id'] ?? Null));
        }
        $dados['data'] = $data;
        $dados['botoes_topo'] = botoesInternos(self::url, 'interno_topo');

        $dados['datatable'][] = ['largura' => 5, 'label' => '#', 'nome_banco_de_dados' => 'contador'];
        $dados['datatable'][] = ['largura' => 10, 'label' => ___('Avatar'), 'nome_banco_de_dados' => 'logotipo'];
        $dados['datatable'][] = ['largura' => 25, 'label' => ___('Nome'), 'nome_banco_de_dados' => 'name'];
        $dados['datatable'][] = ['largura' => 35, 'label' => ___('Email'), 'nome_banco_de_dados' => 'email'];
        $dados['datatable'][] = ['largura' => 15, 'label' => ___('Último login'), 'nome_banco_de_dados' => 'last_login'];
        $dados['datatable'][] = ['largura' => 10, 'label' => ___('Ações'), 'nome_banco_de_dados' => 'acoes'];

        $dados['titulo_pagina'][] = ___('Cadastros');
        $dados['titulo_pagina'][] = ___('Clientes');
        $dados['url'] = montaURLAcesso(self::url);
        return $dados;
    }

    static function createEdit($hash_id = '')
    {
        $dados = self::index('create');
        unset($dados['botoes_topo']);

        $dados['data'] = [];
        if (!empty($hash_id)) {
            $dados['data'] = Model(self::tabela)::where('hash_id', $hash_id)->first();
            $dados['formulario'][] = [
                'nome_no_banco_de_dados' => 'hash_id',
                'tipo' => 'hidden',
                'valor_inicial' => $dados['data']['hash_id'],
            ];
        }

        $dados['titulo_pagina'][] = ___('Novo cliente');
        $dados['url'] = montaURLAcesso(self::url);

        $dados['botoes_topo'][] = ['label' => ___('Listar clientes'), 'cor' => 'info', 'url' => montaURLAcesso(self::url), 'icone' => 'abstract-14'];
        $dados['formulario'][] = [
            'formulario' => 12,
            'valor_inicial' => verificaImagemSistem(($dados['data']['UsersData']['avatar'] ?? Null), 'div') . ___('Dados gerais'),
            'tipo' => 'titulo',
        ];
        $dados['formulario'][] = [
            'formulario' => 5,
            'label' => ___('Nome'),
            'nome_no_banco_de_dados' => 'name',
            'required' => 1,
            'valor_inicial' => ($dados['data']['name'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 4,
            'label' => ___('Email'),
            'nome_no_banco_de_dados' => 'email',
            'required' => 1,
            'valor_inicial' => ($dados['data']['email'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'email'],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 3,
            'label' => ___('Avatar'),
            'nome_no_banco_de_dados' => 'avatar',
            'required' => 1,
            'tipo' => 'file',
            'valor_inicial' => ($dados['data']['avatar'] ?? ''),
            'validacoes' => [],
        ];
        // ==================================================
        $dados['formulario'][] = [
            'formulario' => 12,
            'valor_inicial' => ___('Dados pessoais'),
            'tipo' => 'titulo',
        ];
        $dados['formulario'][] = [
            'formulario' => 3,
            'label' => ___('CPF'),
            'nome_no_banco_de_dados' => 'documento_primeiro',
            'required' => 1,
            // 'mascara' => '000_000_000_00',
            'valor_inicial' => ($dados['data']['UsersData']['documento_primeiro'] ?? ''),
            'validacoes' => [],
        ];
        $dados['formulario'][] = [
            'formulario' => 2,
            'label' => ___('RG'),
            'nome_no_banco_de_dados' => 'documento_segundo',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersData']['documento_segundo'] ?? ''),
            'validacoes' => [],
        ];
        $dados['formulario'][] = [
            'formulario' => 2,
            'label' => ___('Nascimento'),
            'nome_no_banco_de_dados' => 'nascimento_fundacao',
            'required' => 1,
            'tipo' => 'date',
            'valor_inicial' => ($dados['data']['UsersData']['nascimento_fundacao'] ?? ''),
            'validacoes' => [],
        ];
        $dados['formulario'][] = [
            'formulario' => 2,
            'label' => ___('Sexo'),
            'nome_no_banco_de_dados' => 'sexo',
            'tipo' => 'select',
            'tabela_relacional' => 'Sexo',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersData']['sexo'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 3,
            'label' => ___('Idioma'),
            'nome_no_banco_de_dados' => 'idioma',
            'tipo' => 'select',
            'tabela_relacional' => 'Idioma',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersData']['idioma'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        // ==================================================
        $dados['formulario'][] = [
            'formulario' => 12,
            'valor_inicial' => ___('Endereço'),
            'tipo' => 'titulo',
        ];
        $dados['formulario'][] = [
            'formulario' => 3,
            'label' => ___('CEP'),
            'nome_no_banco_de_dados' => 'cep',
            'campo_id' => 'busca_cep',
            // 'mascara' => '00_000_000',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersAddress']['cep'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 7,
            'label' => ___('Endereço'),
            'nome_no_banco_de_dados' => 'endereco',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersAddress']['endereco'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 2,
            'label' => ___('Número'),
            'nome_no_banco_de_dados' => 'numero',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersAddress']['numero'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        // ==================================================
        $dados['formulario'][] = [
            'formulario' => 2,
            'label' => ___('Complemento'),
            'nome_no_banco_de_dados' => 'complemento',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersAddress']['complemento'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 4,
            'label' => ___('Bairro'),
            'nome_no_banco_de_dados' => 'bairro',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersAddress']['bairro'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 4,
            'label' => ___('Cidade'),
            'nome_no_banco_de_dados' => 'cidade',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersAddress']['cidade'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 2,
            'label' => ___('Estado'),
            'nome_no_banco_de_dados' => 'estado',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersAddress']['estado'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        // ==================================================
        $dados['formulario'][] = [
            'formulario' => 12,
            'valor_inicial' => ___('Telefone(s)'),
            'tipo' => 'titulo',
        ];
        $dados['formulario'][] = [
            'formulario' => 3,
            'label' => ___('Telefone'),
            // 'mascara' => '00_0_0000_0000',
            'nome_no_banco_de_dados' => 'fone_1',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersPhone']['fone_1'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 3,
            'label' => ___('Telefone'),
            // 'mascara' => '00_0_0000_0000',
            'nome_no_banco_de_dados' => 'fone_2',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersPhone']['fone_2'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 3,
            'label' => ___('Telefone'),
            // 'mascara' => '00_0_0000_0000',
            'nome_no_banco_de_dados' => 'fone_3',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersPhone']['fone_3'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        $dados['formulario'][] = [
            'formulario' => 3,
            'label' => ___('Telefone'),
            // 'mascara' => '00_0_0000_0000',
            'nome_no_banco_de_dados' => 'fone_4',
            'required' => 1,
            'valor_inicial' => ($dados['data']['UsersPhone']['fone_4'] ?? ''),
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        // ==================================================
        $dados['formulario'][] = [
            'formulario' => 12,
            'valor_inicial' => ___('Chave de acesso'),
            'tipo' => 'titulo',
        ];
        $dados['formulario'][] = [
            'formulario' => 12,
            'label' => ___('Chave de acesso'),
            'nome_no_banco_de_dados' => 'chave_de_acesso',
            'readonly' => 'readonly',
            'valor_inicial' => ($dados['data']['UsersAccessKey']['chave_de_acesso'] ?? ''),
            'msg_base' => '<a onclick="gerarNovaChavedeAcesso(\'chave_de_acesso\')"> <i class="ki-outline ki-arrows-circle"></i> ' . ___('Gerar nova chave de acesso') . '</a>',
            'validacoes' => [
                ['tipo' => 'required'],
                ['tipo' => 'min', 'valor' => 5],
            ],
        ];
        // ==================================================
        $dados['formulario'][] = [
            'formulario' => 9,
            'tipo' => 'vazio',
        ];
        $dados['formulario'][] = [
            'formulario' => 3,
            'tipo' => 'submit',
            'icone' => 'save-2',
            'label' => (empty($hash_id) ? ___('Salvar') : ___('Atualizar')),
            'cor' => (empty($hash_id) ? 'success' : 'warning'),
        ];

        return $dados;
    }

    static function store($data)
    {
        $validacoes = self::createEdit()['formulario'];
        $data = FormularioValidacoes::FormularioValidacoes($data, $validacoes);

        validaSeEmailJaExiste($data);

        $data['nivel'] = self::nivel;
        $data['emp_id'] = GlobalController::atualizaEmpresaCadastro();

        $ultimo = Model(self::tabela)::updateOrCreate(['hash_id' => ($data['hash_id'] ?? Null)], $data);
        $data['users_id'] = $ultimo['id'];

        if (!empty($data['avatar'])) {
            $data['avatar'] = Tratamentos::trataUpload([
                'pasta' => '/empresa/' . $ultimo['id'] . '/',
                'arquivo' => $data['avatar'],
            ]);
        } else {
            unset($data['avatar']);
        }

        Model('UsersData')::updateOrCreate(['users_id' => $data['users_id']], $data);
        Model('UsersAddress')::updateOrCreate(['users_id' => $data['users_id']], $data);
        Model('UsersPhone')::updateOrCreate(['users_id' => $data['users_id'],], $data);
        if (!empty($data['chave_de_acesso'])) {
            Model('UsersAccessKey')::updateOrCreate(['users_id' => $ultimo['id']], $data);
        }

        return direcionaAposConcluir(self::index()['url']);
    }

    static function destroy($hash_id)
    {
        $consulta = Model(self::tabela)::withTrashed()->where('hash_id', $hash_id)->first();

        if (!empty($consulta['deleted_at'])) {
            $consulta->restore();
        } else {
            $consulta->delete();
        }

        return $consulta;
    }
}
