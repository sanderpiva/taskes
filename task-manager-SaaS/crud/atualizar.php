<?php
include "conexao.php";

if (isset($_GET['codigo'])) {
    $cod = $_GET['codigo'];

    // Buscar valor atual de 'realizada'
    $sql2 = "SELECT realizada FROM tabelatasks WHERE codigo = $cod";
    $result = mysqli_query($conn, $sql2);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $value = ($row['realizada'] == 1) ? 0 : 1;

        // Atualizar valor de 'realizada'
        $sql = "UPDATE tabelatasks SET realizada = $value WHERE codigo = $cod";
        $res = mysqli_query($conn, $sql);
        $lin = mysqli_affected_rows($conn);

        if ($lin > 0) {
            header("Location: ../gerenciador.php?msg=atualizado");
            exit();
        } else {
            header("Location: ../gerenciador.php?msg=erro_atualizar");
            exit();
        }
    } else {
        header("Location: ../gerenciador.php?msg=erro_encontrar");
        exit();
    }
} else {
    header("Location: ../gerenciador.php?msg=erro_receber");
    exit();
}
?>