@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Tarefa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tarefa.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Task</label>
                            <input type="text" name="tarefa">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="date" class="form-control" name="data_limite_conclusao">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
