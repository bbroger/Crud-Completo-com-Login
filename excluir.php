<?php 
	require_once 'conexaoPDO.php';

	if(isset($_GET['id']) && empty($_GET['id']) == false){

		$id = addslashes($_GET['id']);

		$sql = "DELETE FROM usuarios WHERE id = $id";
		$sql = $pdo ->query($sql);

		header("Location: index.php");

	}else{

		header("Location: index.php");
	}
?>
