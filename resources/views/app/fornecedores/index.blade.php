<h3>fornecedor</h3>

{{-- comentario que sera discartado --}}


@php

@endphp

@isset($fornecedores)

    @forelse ($fornecedores as $index => $fornecedor)
        Iteração atual: {{ $loop->iteration }}
        <br>
        Fornecedor: {{ $fornecedor['nome'] }}
        <br>
        Status: {{ $fornecedor['status'] }}
        <br>
        CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado não foi preenchido' }}
        <!-- $variavel testada n estiver definida(isset) ou $varriavel testada possuir valor null -->      
        <br>
        Telefone: ({{ $fornecedor['ddd'] ?? ''}})  {{ $fornecedor['telefone'] ?? '' }}
        <hr>
    @empty
        Não existem fornecedores cadastrados!    
    @endforelse

@endisset

