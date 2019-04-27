<?php 

require_once 'conexaoPDO.php';

//consultar

	$sql = "SELECT * FROM usuarios ORDER BY nome";
	$consulta = $pdo -> query($sql);

	/*if($consulta->rowCount() > 0){

		while($row = $consulta->fetch()) {
			echo $row['id'].' - '.$row['nome']. ' - '. $row['email'].'<br />';
		}//duas formas de fazer a apresentação dos dados

		foreach ($consulta->fetchAll() as $usuario){
			echo $usuario['id'].' - '.$usuario['nome']. ' - '. $usuario['email'].'<br />';
		}//forma apresentada pelo bonieky

		
	}else{
		echo "Não existem usuários cadastrados";
	}*/

?>