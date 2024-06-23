<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Tarefas</title>
    <style>
        /* Estilos para o corpo da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            margin: 0;
            padding-top: 20px;
            /* Gradiente de fundo animado */
            background: linear-gradient(113deg, #52ff00, #ffaa00, #a001ff);
            background-size: 600% 600%;

            /* Animação do gradiente */
            -webkit-animation: AnimationName 30s ease infinite;
            -moz-animation: AnimationName 30s ease infinite;
            animation: AnimationName 30s ease infinite;
        }

        /* Definição da animação do gradiente */
        @-webkit-keyframes AnimationName {
            0% { background-position: 0% 23% }
            50% { background-position: 100% 78% }
            100% { background-position: 0% 23% }
        }
        @-moz-keyframes AnimationName {
            0% { background-position: 0% 23% }
            50% { background-position: 100% 78% }
            100% { background-position: 0% 23% }
        }
        @keyframes AnimationName {
            0% { background-position: 0% 23% }
            50% { background-position: 100% 78% }
            100% { background-position: 0% 23% }
        }

        /* Estilos para o contêiner principal */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 10px; /* Adicionando um padding lateral para telas menores */
        }

        /* Estilos para o post-it */
        .post-it {
            background-color: #ffd700;
            padding: 10px;
            margin: 10px;
            border: 2px solid #000;
            width: 80%;
            max-width: 600px;
            display: inline-block;
            text-align: left;
            box-shadow: 3px 3px 5px #888888;
        }

        /* Estilos adicionais para diferentes prioridades */
        .post-it.green {
            background-color: #90ee90;
        }

        .post-it.blue {
            background-color: #add8e6;
        }

        .post-it.red {
            background-color: #ffb6c1;
        }

        /* Estilos para o conteúdo do post-it */
        .post-it-content {
            font-size: 16px;
        }

        /* Media Queries para ajustes responsivos */
        @media (max-width: 768px) {
            .post-it {
                width: 100%; /* Ajusta a largura para ocupar 100% em telas menores */
            }

            .container {
                padding: 0 20px; /* Aumenta o padding lateral para telas menores */
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 10px; /* Reduz ainda mais o padding lateral para telas muito pequenas */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Visualizar Tarefas Importadas</h1>
        
        <!-- Formulário para importação de arquivo TXT -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="formImportacao">
            <input type="file" name="fileToImport" id="fileToImport" accept=".txt">
            <button type="submit">Importar Arquivo TXT</button>
        </form>

        <!-- Container para exibir os post-its -->
        <div class="post-it-container">
            <?php
            // Verifica se o arquivo foi importado com sucesso
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fileToImport"])) {
                $file = $_FILES["fileToImport"];
                $file_name = $file["name"];
                $file_tmp = $file["tmp_name"];
                $file_type = $file["type"];

                if ($file_type === "text/plain") {
                    move_uploaded_file($file_tmp, "tarefas_importadas.txt");
                    echo '<p>Arquivo importado com sucesso!</p>';
                } else {
                    echo '<p>Somente arquivos TXT são permitidos.</p>';
                }
            }

            // Exibe as tarefas importadas do arquivo tarefas_importadas.txt
            $file = 'tarefas_importadas.txt';
            if (file_exists($file)) {
                $lines = file($file, FILE_IGNORE_NEW_LINES);
                foreach ($lines as $line) {
                    $data = explode(' | ', $line);
                    if (count($data) >= 5) { // Verifica se há dados suficientes para evitar erros de índice
                        $titulo = htmlspecialchars($data[0]);
                        $descricao = htmlspecialchars($data[1]);
                        $prioridade = htmlspecialchars($data[2]);
                        $data_tarefa = htmlspecialchars($data[3]);
                        $responsavel = htmlspecialchars($data[4]);

                        // Escolha da cor do post it baseado na prioridade
                        $color_class = '';
                        switch ($prioridade) {
                            case 'alta':
                                $color_class = 'red';
                                break;
                            case 'media':
                                $color_class = 'green';
                                break;
                            case 'baixa':
                                $color_class = 'blue';
                                break;
                            default:
                                $color_class = 'yellow';
                                break;
                        }

                        // Output do post it
                        echo '<div class="post-it ' . $color_class . '">';
                        echo '<div class="post-it-content">';
                        echo '<h3>' . $titulo . '</h3>';
                        echo '<p><strong>Descrição:</strong> ' . $descricao . '</p>';
                        echo '<p><strong>Prioridade:</strong> ' . ucfirst($prioridade) . '</p>';
                        echo '<p><strong>Data:</strong> ' . $data_tarefa . '</p>';
                        echo '<p><strong>Responsável:</strong> ' . $responsavel . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            } else {
                echo '<p>Não há tarefas importadas.</p>';
            }
            ?>
        </div>
        
        <!-- Link para voltar ao formulário de cadastro -->
        <p><a href="formulario.html">Voltar</a> para o formulário de cadastro de tarefas.</p>
    </div>

    <!-- Script para confirmar envio de arquivo -->
    <script>
        function confirmarEnvioArquivo() {
            var fileInput = document.getElementById('fileToImport');
            if (fileInput.files.length > 0) {
                var fileName = fileInput.files[0].name;
                return confirm("Enviar o Arquivo: '" + fileName + "'?");
            }
            return true; // Prosseguir com o envio se nenhum arquivo foi selecionado
        }

        // Vincular a função ao evento de envio do formulário
        document.getElementById('formImportacao').onsubmit = confirmarEnvioArquivo;
    </script>

    <!-- Script para exibir a data de atualização -->
    <script>
        function exibirDataAtualizacao() {
            var currentDate = new Date();
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
            var formattedDate = currentDate.toLocaleDateString('pt-BR', options);
            document.write('<p>Última atualização: ' + formattedDate + '</p>');
        }

        exibirDataAtualizacao();
    </script>
</body>
</html>