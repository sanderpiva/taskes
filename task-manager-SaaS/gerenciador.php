<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <span id="username"><?php
                                        if (isset($_POST['username'])) {
                                            echo htmlspecialchars($_POST['username']);
                                        } else {
                                            echo "Usuário";
                                        }
                                        ?></span>
                </h2>
                <p class="section__header__subtitle">
                    Bem vindo ao seu gerenciador de tarefas online!
                </p>
            </header>

            <div class="task-container">
                <div class="task-container__task-item completed">
                    <h3 class="task-container__task-item__title">Tarefas Concluídas</h3>
                    <p class="task-container__task-item__numberOfTasks"><?php include 'crud/consultar_tarefas_feitas.php'; ?></p>
                </div>
                <div class="task-container__task-item pending">
                    <h3 class="task-container__task-item__title">Tarefas Pendentes</h3>
                    <p class="task-container__task-item__numberOfTasks"><?php include 'crud/consultar_tarefas_pendentes.php'; ?></p>
                </div>
                <div class="task-container__task-item total">
                    <h3 class="task-container__task-item__title">Total de Tarefas</h3>
                    <p class="task-container__task-item__numberOfTasks"><?php include 'crud/consultar_total_tarefas.php'; ?></p>
                </div>
            </div>

            <canvas id="myPieChart" width="300" height="300" style="display:block; margin: 3rem auto;"></canvas>

            <script>
                const ctx = document.getElementById('myPieChart').getContext('2d');

                const pending = <?php include 'crud/consultar_tarefas_pendentes.php'; ?>;
                const completed = <?php include 'crud/consultar_tarefas_feitas.php'; ?>;

                const myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Pending', 'Completed'],
                        datasets: [{
                            data: [pending, completed],
                            backgroundColor: ['#eb5b5b', '#c7fca9'],
                            borderColor: '#fff',
                            borderWidth: 5,
                        }]
                    },
                    options: {
                        responsive: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = context.parsed;
                                        return `${label}: ${value}`;
                                    }
                                }
                            }
                        }
                    }
                });
            </script>

            <div class="task-list-container">
                <header class="section__header">
                    <h2 class="section__header__title">
                        Acompanhe sua lista de tarefas!
                    </h2>
                    <a class="task-list-container__header__add-button" href="inserir.html">Cadastrar</a>
                </header>

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

                        $sql = "select * from tabelatasks";
                        $res = mysqli_query($conn, $sql);
                        $lin = mysqli_affected_rows($conn);

                        while ($reg = mysqli_fetch_row($res)) {

                            $codigo = $reg[0];
                            $titulo = $reg[1];
                            $descricao = $reg[2];
                            $realizada = $reg[3];

                            if ($realizada == 1) {
                                $realizada = "Concluída";
                            } else {
                                $realizada = "Pendente";
                            }

                            echo "<tr>";
                            echo "<td>$codigo</td><td>$titulo</td>";
                            echo "<td>$descricao</td><td>$realizada</td>";
                            echo "<td><button onclick='atualizarRegistro($codigo)'>Atualizar</button>
                                    <button onclick='enviarParaApagar($codigo)'>Excluir</button></td>";
                            echo "</tr>";
                        }

                        mysqli_close($conn);
                        ?>
                    </tbody>
                </table>

            </div>
        </section>
    </main>

    <footer class="footer">
        <p>© 2025 SanSa Developments. Todos os direitos reservados.</p>
    </footer>

    <script src="js/scripts.js"></script>
</body>

</html>