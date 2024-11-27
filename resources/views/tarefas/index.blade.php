<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
</head>
<body>
    <h1>Lista de Tarefas</h1>

    <!-- Formulário para adicionar uma nova tarefa -->
    <form action="{{ route('tarefas.store') }}" method="POST">
        @csrf
        <input type="text" name="titulo" placeholder="Nova Tarefa" required>
        <button type="submit">Adicionar</button>
    </form>

    <ul>
        <!-- Exibe todas as tarefas -->
        @foreach($tarefas as $tarefa)
            <li>
                {{ $tarefa->titulo }} - Status: {{ $tarefa->status ? 'Concluída' : 'Pendente' }}
                <!-- Ações para editar ou excluir a tarefa -->
                <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>