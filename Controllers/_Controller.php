<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use namespace App\Controllers\Clientes_Repositorie as RepositoriePadrao;
use Illuminate\Support\Facades\Auth;

class Clientes_Controller extends Controller
{
    public function index($local = '')
    {
        $local = (verificaTipoRequisicao() === 'api' ? 'api' : 'lista');
        $dados = RepositoriePadrao::index($local);
        if (verificaTipoRequisicao() === 'api') {
            return $dados;
        }
        return view('telas.listagem', compact('dados'));
    }

    public function create()
    {
        $dados = RepositoriePadrao::createEdit();
        return view('telas.formulario', compact('dados'));
    }

    public function store(Request $request)
    {
        $url_retorno = RepositoriePadrao::index()['url'];

        $data = $request->all();
        if (!empty($data['method'])) {
            if ($data['method'] === 'DELETE') {
                self::destroy($data['chave']);
                if (verificaTipoRequisicao() === 'api') {
                    return self::index(verificaTipoRequisicao());
                }
                return redirect($url_retorno)->with('mensagem', ['cor' => 'info', 'titulo' => 'titulo', 'mensagem' => 'mensagem']);
            }
        } else {
            return RepositoriePadrao::store($data);
        }

        if (verificaTipoRequisicao() === 'api') {
            return self::index();
        }

        return direcionaAposConcluir($url_retorno);
    }

    public function edit($hash_id)
    {
        $dados = RepositoriePadrao::createEdit($hash_id);
        return view('telas.formulario', compact('dados'));
    }

    public function update(Request $request, $hash_id)
    {
        $dados = RepositoriePadrao::update($request, $hash_id);

        return $this->index();
    }

    public function destroy($hash_id)
    {
        return RepositoriePadrao::destroy($hash_id);
    }

    public function impersonate($hash_id)
    {
        if (Auth()->user()->nivel === 'Administrator') {
            $data = Model('Users')::where('hash_id', $hash_id)->first();
            if (!empty($data)) {
                $atual = Model('Users')::find($data['id']);
                $atual->update(['impersonate' => Auth()->user()->id]);

                Model('Impersonate')::create(['users_id_origem' => Auth()->user()->id, 'users_id_destino' => $data['id']]);

                Auth::loginUsingId($data['id']);

                $destino = '/' . strtolower(Auth()->user()->nivel);
                return redirect($destino);
            }
        }
        return redirect('/sair');
    }
}
