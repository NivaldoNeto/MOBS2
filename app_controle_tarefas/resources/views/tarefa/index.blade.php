@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                    Tarefas
                    <a href="{{route('tarefa.create')}}" class="float-right">Novo</a>
                    <a href="{{route('tarefa.exportacao'), ['extensao' => XLSX]}} ">XLSX</a>
                    <a href="{{route('tarefa.exportacao'), ['extensao' => CSV]}} ">CSV</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Task</th>
                                <th scope="col">Conclusion Time</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $key =>$t)
                                <tr>
                                <th scope="row">{{ $t['id'] }}</th>
                                <td>{{ $t['tarefa'] }}</td>
                                <td>{{ date('d/m/Y', strtotime($t['data_limite_conclusao'])) }}</td>
                                <td><a href="{{ routoe('tarefa.edit', $t['id'] )}}">Edit</a></td> 
                                <td>
                                    <form id="form_{{$t['id']}}" method="POST" action="{{ route('tarefa.destroy', ['tarefa' => $t['id']]) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="#" onclick="document.getElementsById('form_{{$t['id']}}').submit()">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $tareafas->previousPageUrl()}}">Previous</a></li>
                                @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                                <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : }} active">
                                    <a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
                                </li>    
                                @endfor
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="{{ $tareafas->nextPageUrl()}}">Next</a></li>
                            </ul>
                      </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
