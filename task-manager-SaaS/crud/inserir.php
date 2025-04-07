<html>
	<body>
		<?php

			include "conexao.php";

			$titulo= $_POST['titulo'];
			$descricao= $_POST['descricao'];
			$status= $_POST['status'];

			$sql="Insert into tabelatasks VALUES('NULL', '$titulo','$descricao', $status)";
			$res=mysqli_query($conn, $sql);
			$lin=mysqli_affected_rows($conn);
			if($lin>0){
				
				echo "inserido $lin";
			}
			else{
				
				echo "nao inserido";
				
			}

			mysqli_close($conn);
		?><br><br>		
		<a href="../gerenciador.php">Voltar</a>
	</body>
</html>



