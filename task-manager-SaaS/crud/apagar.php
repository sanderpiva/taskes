<html>
	<body>
	<?php

		include "conexao.php";
		//precisa pegar do formulario o valor do campo cod
		$cod = $_POST['codigo'];
		
		$sql="delete from tabelatasks where codigo = $cod";
		$res=mysqli_query($conn, $sql);
		$lin=mysqli_affected_rows($conn);
		if($lin>0){
			
			echo "apagado $lin";
		}
		else{
			
			echo "nao apagado";
			
		}

		mysqli_close($conn);


	?><br><br>	
	<a href="../gerenciador.php">Voltar</a>
	</body>
</html>