<?php
    include "conexao.php";

    if (isset($_GET['codigo'])) {
        $cod = $_GET['codigo'];

        $sql = "DELETE FROM tabelatasks WHERE codigo = $cod";
        $res = mysqli_query($conn, $sql);
        $lin = mysqli_affected_rows($conn);

        if ($lin > 0) {
            echo "<p style='color: green;'>Registro com codigo <strong>{$cod}</strong> foi apagado com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>Erro: Nenhum registro encontrado com o codigo <strong>{$cod}</strong>.</p>";
        }
    } else {
        echo "<p style='color: orange;'>Atenção: Codigo da tarefa nao foi recebido.</p>";
    }

    mysqli_close($conn);
?>
<br><br>
<a href="../gerenciador.php">Voltar para a lista de tarefas</a>