@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Adicionar tarefa</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('task.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="task" class="form-label">Tarefa</label>
                                <input type="text" class="form-control {{ $errors->has('task') ? 'is-invalid' : '' }}"
                                    id="task" name="task" value="{{ old('task') }}">
                                @if ($errors->has('task'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('task') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Data limite conclusão</label>
                                <input type="date"
                                    class="form-control {{ $errors->has('deadline') ? 'is-invalid' : '' }}" id="deadline"
                                    name="deadline" value="{{ old('deadline') }}">
                                @if ($errors->has('deadline'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('deadline') }}
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
