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
		$foto = $_FILES['arquivo'];

		// Se a foto estiver sido selecionada
		if (!empty($foto["name"])) {

			// Largura máxima em pixels
			$largura = 150;
			// Altura máxima em pixels
			$altura = 180;
			// Tamanho máximo do arquivo em bytes
			$tamanho = 250000;
	 
			$error = array();
	 
	    	// Verifica se o arquivo é uma imagem
	    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
	     	   $error[1] = "Isso não é uma imagem.";
	   	 	} 
		
			// Pega as dimensões da imagem
			$dimensoes = getimagesize($foto["tmp_name"]);
		
			// Verifica se a largura da imagem é maior que a largura permitida
			if($dimensoes[0] > $largura) {
				$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
			}
	 
			// Verifica se a altura da imagem é maior que a altura permitida
			if($dimensoes[1] > $altura) {
				$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
			}
			
			// Verifica se o tamanho da imagem é maior que o tamanho permitido
			if($foto["size"] > $tamanho) {
	   		 	$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
			}
	 
			// Se não houver nenhum erro
			if (count($error) == 0) {
				echo "entrou no segundo if";
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
	 
	        	// Gera um nome único para a imagem
	        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
	 
	        	// Caminho de onde ficará a imagem
	        	$caminho_imagem = "assets/fotos/" . $nome_imagem;
	 
				// Faz o upload da imagem para seu respectivo caminho
				move_uploaded_file($foto["tmp_name"], $caminho_imagem);	

				$sql = "UPDATE usuarios SET 
							nome = '$nome',
							email = '$email',
							senha = '$senha',
							dt_nascimento = '$data',
							foto = '$nome_imagem'
						WHERE id = '$id'
							";

				$stmt = $pdo ->query($sql);
			} 
			if (count($error) != 0) {
				foreach ($error as $erro) {
					echo $erro . "<br />";
				}
			}else{
				header("Location: index.php");
			}
		}
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
	<div id="voltar"><a href="index.php">VOLTAR</a></div>
	<h2>Editar usuário</h2>
	<form method="POST" id="form2" enctype="multipart/form-data">
		Nome:<br />
		<input type="text" name="nome" required="required" value="<?php echo $dado['nome'];?>" /><br />
		Email:<br />
		<input type="email" name="email" required="required" value="<?php echo $dado['email'];?>" /><br />
		Senha:<br />
		<input type="password" name="senha" required="required" value="<?php echo $dado['senha'];?>" /><br />
		Dt.Nascimento:<br />
		<input type="text" name="dtNascimento" required="required" value="<?php echo $data;?>" /><br /><br />
		
		<div class="foto">
			<div>
				Foto:<br />
				<img src='assets/fotos/<?php echo $dado['foto'];?>' alt='Foto de exibição' /><br />
			</div>
			<div class="foto2">
				Trocar foto:<br />
				<input type="file" name="arquivo" id="foto2"/><br /><br />
			</div>
		</div>
		<input type="submit" value="Atualizar" id="atualizar" />
	</form>
</body>
</html>


