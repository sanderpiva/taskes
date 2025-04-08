<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>Task Manager SaaS</title>
</head>

<body>
    <header class="header">
        <h1 class="header__title">Task Manager - SaaS</h1>
    </header>

    <main>
        <section class="section">
            <header class="section__header">
                <h2 class="section__header__title">
                    Olá,
                    <span id="username">
                        <?php
                            if (isset($_POST['username'])) {
                                echo htmlspecialchars($_POST['username']);
                            } else {
                                echo "Usuário"; // Ou alguma outra mensagem padrão
                            }
                        ?>
                    </span>
                </h2>
                <p class="section__header__subtitle">
                    Bem vindo ao seu gerenciador de tarefas online!
                </p>
            </header>

            <div class="task-container">
                <div class="task-container__task-item completed">
                    <h3 class="task-container__task-item__title">Tarefas Concluídas</h3>
                    <p class="task-container__task-item__numberOfTasks">
                        <?php include 'crud/consultar_tarefas_feitas.php'; ?>
                    </p>
                </div>
                <div class="task-container__task-item pending">
                    <h3 class="task-container__task-item__title">Tarefas Pendentes</h3>
                    <p class="task-container__task-item__numberOfTasks">
                        <?php include 'crud/consultar_tarefas_pendentes.php'; ?>
                    </p>
                </div>
                <div class="task-container__task-item total">
                    <h3 class="task-container__task-item__title">Total de Tarefas</h3>
                    <p class="task-container__task-item__numberOfTasks">
                        <?php include 'crud/consultar_total_tarefas.php'; ?>
                    </p>
                </div>
            </div>

            <div class="task-list">
                <header class="section__header">
                    <h2 class="section__header__title">
                        Acompanhe sua lista de tarefas!
                    </h2>
                    <table class="task-table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'crud/conexao.php';

                                $sql="select * from tabelatasks";
                                $res=mysqli_query($conn, $sql);
                                $lin=mysqli_affected_rows($conn);

                                echo "Registros identificados: $lin";
                                echo "<br><br>";

                                while($reg=mysqli_fetch_row($res)){

                                    $codigo=$reg[0];
                                    $titulo=$reg[1];
                                    $descricao=$reg[2];
                                    $realizada=$reg[3];

                                    if($realizada==1){
                                        $realizada="Concluída";
                                    }else{
                                        $realizada="Pendente";
                                    }

                                    echo "<tr>";
                                    echo "<td>$codigo</td><td>$titulo</td>";
                                    echo "<td>$descricao</td><td>$realizada</td>";
                                    echo "<td><button onclick='atualizarRegistro($codigo)'>Atualizar</button></td>";
                                    echo "<td><button onclick='enviarParaApagar($codigo)'>Excluir</button></td>";
                                    echo "</tr>";
                                }

                                mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>

                    <script>
                        function atualizarRegistro(codigo) {
                            alert("Atualizar registro do codigo: " + codigo);
                            // Aqui pode redirecionar para uma pagina de atualizacao ou abrir um modal.
                        }

                        function enviarParaApagar(codigo) {
                            const confirmar = confirm("Tem certeza que deseja excluir o registro de codigo: " + codigo + "?");
                            if (confirmar) {
                                // Redireciona para o script de exclusão via GET, passando o código como parâmetro na URL
                                window.location.href = 'crud/apagar.php?codigo=' + codigo;
                            }
                        }
                    </script>

                </header>
            </div>
        </section>
    </main>

    <a href="inserir.html">Cadastrar</a><br><br>

    <footer class="footer">
        <p>© 2025 JSS Developments. Todos os direitos reservados.</p>
    </footer>
</body>
</html>