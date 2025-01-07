@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tarefas</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tarefa</th>
                                    <th scope="col">Data limite</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $key => $task)
                                    <tr>
                                        <th scope="row">{{ $task['id'] }}</th>
                                        <td>{{ $task['task'] }}</td>
                                        <td>{{ date('d/m/Y', strtotime($task['deadline'])) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $tasks->previousPageUrl() }}">Voltar</a>
                                </li>
                                @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                                    <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}"><a
                                            class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a></li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $tasks->nextPageUrl() }}">Avançar</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
