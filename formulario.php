<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Tarefas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            margin: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 1em;
        }

        nav a {
            margin: 0 1em;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            padding: 2em;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 2em;
        }

        form label {
            margin: 0.5em 0 0.2em;
        }

        form input, form textarea, form select {
            margin-bottom: 1em;
            padding: 0.5em;
            width: 300px;
            max-width: 100%;
        }

        form input[type="submit"] {
            width: auto;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 0.5em 1em;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #4CAF50;
            color: white;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Formulário de Tarefas</h1>
    </header>
    <main>
        <section>
            <h2>Cadastro de Tarefas</h2>
            <form action="processa_formulario.php" method="POST">
                <div>
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>
                <div>
                    <label for="descricao">Descrição:</label>
                    <textarea id="descricao" name="descricao" rows="4" required></textarea>
                </div>
                <div>
                    <label for="prioridade">Prioridade:</label>
                    <select id="prioridade" name="prioridade" required>
                        <option value="alta">Alta</option>
                        <option value="media">Média</option>
                        <option value="baixa">Baixa</option>
                    </select>
                </div>
                <div>
                    <label for="data">Data:</label>
                    <input type="date" id="data" name="data" required>
                </div>
                <div>
                    <label for="responsavel">Responsável:</label>
                    <input type="text" id="responsavel" name="responsavel" required>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Formulário de Tarefas. Todos os direitos reservados.</p>
        <nav>
            <a href="index.php">Voltar</a> <!-- Voltar para a página inicial -->
            <a href="visualizar_tarefas.php">Visualizar Tarefas</a> <!-- Ir para a página de visualização -->
        </nav>
    </footer>
</body>
</html>