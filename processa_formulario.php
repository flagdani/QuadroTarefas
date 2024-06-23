<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $prioridade = $_POST['prioridade'];
    $data = $_POST['data'];
    $responsavel = $_POST['responsavel'];
    $num_participantes = $_POST['num_participantes']; // Novo campo

    // Formatando os dados para salvar no arquivo
    $linha = "$titulo | $descricao | $prioridade | $data | $responsavel | $num_participantes\n";
    $arquivo = 'tarefas.txt';

    // Salvando os dados no arquivo
    if (file_put_contents($arquivo, $linha, FILE_APPEND | LOCK_EX) !== false) {
        echo '<script>alert("Tarefa cadastrada com sucesso!");</script>';
    } else {
        echo '<script>alert("Erro ao cadastrar a tarefa.");</script>';
    }

    // Redirecionar de volta para o formulário
    header("Location: formulario.html");
    exit();
}
?>