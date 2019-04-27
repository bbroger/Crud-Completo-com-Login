<?php 
require_once 'conexaoPDO.php';
session_start();

if (isset($_POST['usuario']) && empty($_POST['usuario']) == false &&
	isset($_POST['senha']) && empty($_POST['senha']) == false) {

	$email = addslashes($_POST['usuario']);
	$senha = md5(addslashes($_POST['senha']));

	$sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
	$stmt = $pdo -> query($sql);

	if ($stmt->rowCount() > 0) {
		$dado = $stmt->fetch();
		$_SESSION['id'] = $dado['id'];

		if($dado['email'] === $email && $dado['senha'] === $senha){
		header("Location: index.php");
		}else{
			echo "Usuário ou senha inválidos.";
		}
	}else{
		echo "Usuário não localizado.";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<form method="post" id="login">
		<!--Usuário:<br />-->
		<input type="email" name="usuario" placeholder="Usuário" autofocus maxlength="20" required autocomplete="off" /><br /><br />
		<!--Senha:<br />-->
		<input type="password" name="senha" placeholder="Senha" required /><br /><br />
		<div class="submit">
			<input type="submit" name="Enviar" value="Acessar" id="acessar" />
		</div>
	</form>
</body>
</html>