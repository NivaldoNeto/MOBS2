<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Unidade;
use App\Models\Item;
use App\Models\ProdutoDetalhe;
use Illuminate\Http\Request;
use App\Models\Fornecedor;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produtos = Item::with('itemDetalhe')->simplePaginate(10);

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id'
        ];

        $feedback =[
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no minimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',
            'descricao.min' => 'O campo descrição deve ter no minimo 3 caracteres',
            'descricao.max' => 'O campo descrição deve ter no maximo 2000 caracteres',
            'peso.integer' => 'O campo pese deve ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'o fornecedor informado não existe'
        ];
        
        $request->validate($regras,$feedback);
        
        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = fornecedor::all();
        //return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades]);
        return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $produto)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',

        ];

        $feedback =[
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no minimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',
            'descricao.min' => 'O campo descrição deve ter no minimo 3 caracteres',
            'descricao.max' => 'O campo descrição deve ter no maximo 2000 caracteres',
            'peso.integer' => 'O campo pese deve ser um número inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'o fornecedor informado não existe'
        ];
        
        $request->validate($regras,$feedback);


        $produto->update($request->all()); //instancia do objeto no estado anterior
        return redirect()->route('produto.show', ['produto' => $produto->id ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');

    }
}
