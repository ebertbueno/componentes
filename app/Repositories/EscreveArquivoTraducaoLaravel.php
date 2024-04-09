<?php

namespace App\Repositories;

use fopen;

class EscreveArquivoTraducaoLaravel
{

    static function EscreveArquivoTraducaoLaravel($palavra = '', $acao = 'direto')
    {
        if ($acao === 'traducao') {
            $qualIdioma = pegaIdiomasDisponiveis();

            $arquivoSolicitado = str_replace('\\', '/', base_path());
            $arquivoSolicitado .= '/app/Helpers/___.php';

            $arquivo = fopen($arquivoSolicitado, 'w');
            $conteudo = '<?php ';
            $conteudo .= "\n" . 'function ___($palavra)';
            $conteudo .= "\n" . '{';
            $conteudo .= "\n    " . '$chave = deixaApenasTexto($palavra);';

            foreach ($qualIdioma as $key => $i) {
                $idioma = strtolower($i['sigla']);

                $conteudo .=  "\n    " . '$data["' . $idioma . '"] = [';
                if (!empty($palavra)) {
                    $chave = deixaApenasTexto($palavra, 250);
                    $consultaSeExiste = Model('Traducoes')::where('chave', $chave)->first();
                    if (!empty($consultaSeExiste)) {
                        $consultaSeExiste->update([
                            'chave' => $chave,
                            $idioma => $palavra,
                        ]);
                    } else {
                        $verificaSeInsere = strpos($chave, 0, 2);

                        if ($verificaSeInsere != '||') {
                            $novoTexto = [
                                'chave' => $chave,
                                $idioma => $palavra,
                            ];
                            $consultaSeExiste = Model('Traducoes')::create($novoTexto);
                        }
                    }
                }

                $data = Model('Traducoes')::where('chave', '<>', Null)->select('chave', $idioma)->get();
                foreach ($data as $datas) {
                    $conteudo .= "\n        '" . $datas['chave'] . "' => '" . str_replace("'", "\'", $datas[$idioma]) . "',";
                }
                $conteudo .= "\n    " . '];';
            }

            $conteudo .= "\n";
            $conteudo .= "\n    " . 'if (!empty($data[idiomaPadrao()][$chave])) {';
            $conteudo .= "\n        " . 'return $data[idiomaPadrao()][$chave];';
            $conteudo .= "\n    " . '}';
            $conteudo .= "\n";
            $conteudo .= "\n    " . '$verificaSeExiste = Model(\'Gerenciamento\', \'Traducoes\')::where(\'chave\',$chave)->count();';
            $conteudo .= "\n";
            $conteudo .= "\n    " . 'if( $verificaSeExiste === 0 ){';
            $conteudo .= "\n        " . 'Model(\'Gerenciamento\', \'Traducoes\')::create([\'chave\' => $chave,\'pt-br\' => $palavra]);';
            $conteudo .= "\n    " . '}';
            $conteudo .= "\n";
            $conteudo .= "\n    " . 'return $palavra;';
            $conteudo .= "\n" . '};';

            fwrite($arquivo, $conteudo);
            fclose($arquivo);
        }
    }
};
