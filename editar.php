<?php 
	require_once 'conexaoPDO.php';

	$id = 0;

	if(isset($_GET['id']) && empty($_GET['id']) == false){
		$id = addslashes($_GET['id']);
	}

	if(isset($_POST['nome']) && empty($_POST['nome']) == false){
		$nome = addslashes($_POST['nome']);
		$email = addslashes($_POST['email']);
		$senha = md5(addslashes($_POST['senha']));
		$dtNascimento = addslashes($_POST['dtNascimento']);
		$data = date("Y-m-d",strtotime(str_replace('/','-',$dtNascimento)));

		$sql = "UPDATE usuarios SET 
					nome = '$nome',
					email = '$email',
					senha = '$senha',
					dt_nascimento = '$data'
				WHERE id = '$id'
					";

		$stmt = $pdo ->query($sql);

		header("Location: index.php");
	}

	$sql = "SELECT * FROM usuarios WHERE id = '$id'";
	$stmt = $pdo -> query($sql);

	if($stmt->rowCount() > 0){
		$dado = $stmt -> fetch();
		$data = date("d/m/Y",strtotime(str_replace('-','/',$dado['dt_nascimento'])));
	}else{
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Editar Usuário</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

</body>
</html>

<form method="POST" id="form2">
	Nome:<br />
	<input type="text" name="nome" required="required" value="<?php echo $dado['nome'];?>" /><br />
	Email:<br />
	<input type="email" name="email" required="required" value="<?php echo $dado['email'];?>" /><br />
	Senha:<br />
	<input type="password" name="senha" required="required" value="<?php echo $dado['senha'];?>" /><br />
	Dt.Nascimento:<br />
	<input type="date" name="dtNascimento" required="required" value="<?php echo $data;?>" /><br /><br />

	<input type="submit" value="Atualizar" id="atualizar" />

</form>

