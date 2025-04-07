<?php

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include 'conexao.php';

  $sql = "SELECT COUNT(*) AS total_concluidas FROM tabelatasks WHERE realizada = 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["total_concluidas"];
  } else {
    echo "0";
  }

  $conn->close();
?>