<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
    //
    public function contato(Request $request) {

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (Teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request) {
       

        $regras = [
                'name' => 'required|min:3|max:40|unique:site_contatos',
                'telefone' => 'required',
                'email' => 'email',
                'motivo_contatos_id' => 'required',
                'mensagem' => 'required|max:2000'
        ];
        $feedback = [
                'name.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
                'name.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'name.unique' => 'O nome informado ja está em uso',
                'email.email' => ' O email informado não é valido',
                'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',
                'required' => 'O campo :attribute precisa ser preenchido'
        ];
        //Realizar validação dos dados recebidos na request
        $request->validate($regras, $feedback);
        
        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
