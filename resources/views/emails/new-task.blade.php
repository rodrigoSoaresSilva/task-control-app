<x-mail::message>
    # {{ $task }}

    Data limite de conclusão: {{ $deadline }}

    <x-mail::button :url="'{{ $url }}'">
        Clique aqui para ver a tarefa
    </x-mail::button>

    Att,<br>
    {{ config('app.name') }}
</x-mail::message>
