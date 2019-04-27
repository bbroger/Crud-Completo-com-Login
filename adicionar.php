<?php 
	require_once 'conexaoPDO.php';

	if(isset($_POST['nome']) && empty($_POST['nome']) == false){

		$nome = addslashes($_POST['nome']);
		$email = addslashes($_POST['email']);
		$senha = md5(addslashes($_POST['senha']));
		$dt_nascimento = addslashes($_POST['dtNascimento']);
		$data = date("Y-m-d",strtotime(str_replace('/','-',$dt_nascimento)));

		$sql = "INSERT INTO usuarios SET nome = '$nome', email = '$email',
				senha = '$senha', dt_nascimento = STR_TO_DATE('$data', '%Y-%m-%d')";
		$sql = $pdo ->query($sql);

		header("Location: index.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastrar Usuário</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
	<body>
		<h2>Cadastrar novo usuário</h2>
		<form method="POST" id="form1">
			Nome:<br />
			<input type="text" name="nome" required="required" /><br />
			Email:<br />
			<input type="email" name="email" required="required" /><br />
			Senha:<br />
			<input type="password" name="senha" required="required" /><br />
			Dt.Nascimento:<br />
			<input type="date" name="dtNascimento" required="required" /><br /><br />

			<input type="submit" value="Cadastrar" id="cadastrar" />

		</form>
	</body>
</html>
