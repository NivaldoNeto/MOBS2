<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
class FornecedoresController extends Controller
{
    public function index(){
        return view('app.fornecedor.index');
    } 

    public function listar(Request $request){

        $fornecedores = Fornecedor::where('nome','like', '%'.$request->input('nome').'%')
        ->where('site','like', '%'.$request->input('site').'%')
        ->where('uf','like', '%'.$request->input('uf').'%')
        ->where('email','like', '%'.$request->input('email').'%')
        ->paginate();


        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores]);
    } 

    public function adicionar(Request $request) {

        $msg = '';
      //  dd($request->all());
        if($request->input('_token') != '' && $request->input('id') == '') {
            //Validacao
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',
                'uf.min' => 'O campo uf deve ter no minimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no maximo 2 caracteres',
                'email.email' => 'O campo e-mail não foi preeenchido corretamente'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());
            
            //redirect

            //dados view
            $msg = 'Cadastro realizado com sucesso';
        }

        //edição
        if($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update) {
                $msg = 'Atualização realizada com sucesso!';
            } else {
                $msg = 'Atualização apresentou problema!';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);

        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }
    public function editar($id, $msg = '') {
       
        $fornecedor = Fornecedor::find($id);

        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }
}

