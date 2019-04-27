<?php 

//biblioteca para conexão ao banco de dados, possibilita a conexão com todos os bancos de dados atuais

$dsn = "mysql:dbname=b7web;host=localhost;charset=utf8";//qual banco de dados será utilizado, nome do banco, local do banco
$dbuser = "root";
$dbpass = "";

try {
	$pdo = new PDO($dsn, $dbuser, $dbpass);
	//echo "Conexão estabelecida com sucesso!<br />";
	
} catch (PDOException $e) {
	echo "Erro: ".$e->getMessage();
}

?>