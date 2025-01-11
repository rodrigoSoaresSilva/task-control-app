<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        .page-break {
            page-break-after: always;
        }

        .title {
            border: 1px;
            background-color: #C2C2C2;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
        }

        table th {
            text-align: left;
        }
    </style>
</head>

<body>

    <h2 class="title">Lista de tarefas</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tarefa</th>
                <th>Data limite conclusão</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->task }}</td>
                    <td>{{ date('d/m/Y', strtotime($task->deadline)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
