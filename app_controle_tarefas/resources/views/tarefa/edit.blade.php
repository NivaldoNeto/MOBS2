@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Atualizar Tarefa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tarefa.update'), ['tarefa' => $tarefa->id ]}}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Task</label>
                            <input type="text" name="tarefa" value="{{ $tarefa->tarefa }}">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="date" class="form-control" name="data_limite_conclusao" value="{{ $tarefa->data_limite_conclusao}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
