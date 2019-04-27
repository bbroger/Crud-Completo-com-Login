<?php 
require_once 'conexaoPDO.php';

try {

	$faixa_salarial = 1;
	$nome = "rogerio3";
	$email = "bbroger3@teste.com";
	$senha = "789";
	$dt_nascimento = "15/10/1991";
	$data = date("Y-m-d",strtotime(str_replace('/','-',$dt_nascimento)));//converter a data para formato americano

	$sql = "INSERT INTO usuarios SET faixa_salarial = '$faixa_salarial', nome = '$nome', email = '$email',
				senha = '$senha', dt_nascimento = STR_TO_DATE('$data', '%Y-%m-%d')";
	//STR_TO_DATE converte a data passada no parâmetro como string para o formato Date do banco
	$sql = $pdo ->query($sql);

	header("Location: index.php");

} catch (PDOException $e) {
	echo "Erro: ".$e->getMessage();
}


?>