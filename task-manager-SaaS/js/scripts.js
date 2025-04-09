function atualizarRegistro(codigo) {
  alert("Atualizar registro do codigo: " + codigo);
}

function enviarParaApagar(codigo) {
  const confirmar = confirm(
    "Tem certeza que deseja excluir o registro de codigo: " + codigo + "?"
  );
  if (confirmar) {
    window.location.href = "crud/apagar.php?codigo=" + codigo;
  }
}
