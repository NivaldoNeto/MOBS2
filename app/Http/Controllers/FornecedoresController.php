<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    public function index(){
        $fornecedores = [
            0 => ['nome' => 'Fornecedor 1', 
            'status' => 'N', 
            'cnpj' => '0',
            'ddd' => '11', //SP (SP)
            'tefelone' => '6543-5643'
            ],
            1 => [
                'nome' => 'Fornecedor 2',
                'status' => 'S',
                'ddd' => '85', //FORTALEZA (CE)
                'tefelone' => '6543-5643'
            ],
            2 => [
                'nome' => 'Fornecedor 3',
                'status' => 'S',
                'ddd' => '81', //RECIFE (PE)
                'tefelone' => '6543-5643'
            ]  
        ];

        echo isset($fornecedores[1]['cnpj']) ? 'CNPJ informado' : 'CNPJ não informado';

        return view('app.fornecedores.index', compact('fornecedores'));
    }
}

