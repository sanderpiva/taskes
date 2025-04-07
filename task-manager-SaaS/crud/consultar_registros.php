<?php
    include 'conexao.php'; // Certifique-se de que este caminho está correto

    $sql = "SELECT codigo, titulo, descricao, realizada FROM tabelatasks";
    $result = $conn->query($sql);

// A variável $result estará disponível na página principal.php

// Não precisamos fechar a conexão aqui, pois a página principal pode precisar dela para outras consultas.
// Se você não for fazer mais nada com o banco nesta página, pode fechar a conexão aqui:
// $conn->close();
?>