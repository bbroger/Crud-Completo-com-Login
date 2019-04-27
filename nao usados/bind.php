<?php 
require_once 'conexaoPDO.php';

$id = 5;
$faixa_salarial = 3;
$nome = "Lala";
$email = "lala@teste.com";
$senha = "695";
$dt_nascimento = "27/05/1999";
$data = date("Y-m-d",strtotime(str_replace('/','-',$dt_nascimento)));//converter a data para formato americano

$sql = "UPDATE usuarios SET
			faixa_salarial = :faixa_salarial,
			nome = :nome,
			email = :email,
			senha = :senha,
			dt_nascimento = :data,
			id = :id
		WHERE id = :id";

$stmt = $pdo -> prepare($sql);

//o bindValue aceita como valor o retorno de uma função por exemplo, enquanto o bindParam só aceita variaveis já preenchidas
$stmt -> bindValue(':faixa_salarial', $faixa_salarial);
$stmt -> bindValue(':nome', $nome);
$stmt -> bindValue(':email', $email);
$stmt -> bindValue(':senha', $senha);
$stmt -> bindValue(':data', $data);
$stmt -> bindValue(':id', $id);

$stmt->execute();

header("Location: index.php");
?>