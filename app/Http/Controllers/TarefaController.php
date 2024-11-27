<?php

namespace App\Http\Controllers;

// Importa o modelo 'Tarefa', que será utilizado para interagir com a tabela de tarefas no banco de dados
use App\Models\Tarefa;
// Importa a classe 'Request', que representa uma requisição HTTP (usada para lidar com os dados enviados pelo usuário)
use Illuminate\Http\Request;

// Define o controlador 'TarefaController', que gerenciará as ações relacionadas às tarefas
class TarefaController extends Controller
{
    // Método que exibe todas as tarefas
    public function index()
    {
        // Obtém todas as tarefas do banco de dados utilizando o modelo Tarefa
        $tarefas = Tarefa::all();

        // Retorna a view 'tarefas.index' e passa as tarefas para a view, para serem exibidas
        // A função 'compact' cria um array associativo com a variável $tarefas
        return view('tarefas.index', compact('tarefas'));
    }

    // Método que cria uma nova tarefa
    public function store(Request $request)
    {
        // Valida os dados recebidos da requisição
        // A validação garante que o campo 'titulo' seja obrigatório e tenha pelo menos 3 caracteres
        $request->validate([
            'titulo' => 'required|min:3',
        ]);

        // Cria uma nova tarefa no banco de dados com os dados fornecidos na requisição
        // A função 'create' é chamada no modelo Tarefa para inserir os dados
        // O método 'all' pega todos os dados enviados na requisição
        Tarefa::create($request->all());

        // Após criar a tarefa, redireciona o usuário de volta para a lista de tarefas (rota 'tarefas.index')
        return redirect()->route('tarefas.index');
    }

    // Método para atualizar o status de uma tarefa existente
    public function update(Request $request, Tarefa $tarefa)
    {
        // Atualiza o campo 'status' da tarefa com o valor enviado pela requisição
        // O campo 'status' pode ser, por exemplo, para marcar a tarefa como concluída (true) ou pendente (false)
        $tarefa->update(['status' => $request->status]);

        // Após atualizar a tarefa, redireciona o usuário de volta para a lista de tarefas
        return redirect()->route('tarefas.index');
    }

    // Método para excluir uma tarefa
    public function destroy(Tarefa $tarefa)
    {
        // Exclui a tarefa do banco de dados
        $tarefa->delete();

        // Após excluir a tarefa, redireciona o usuário de volta para a lista de tarefas
        return redirect()->route('tarefas.index');
    }
}
