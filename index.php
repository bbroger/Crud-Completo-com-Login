<?php 
require_once 'select.php';
session_start();

if (isset($_SESSION['id']) && empty($_SESSION['id']) == false) {
?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Usuários</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div>
		<div class="adicionar"><a href="adicionar.php">Cadastrar Novo Usuário</a></div>
		<div class="aviso">
			<?php
		        if (isset($_SESSION['msg'])) {
		            echo $_SESSION['msg'];
		            unset($_SESSION['msg']);
		        }
	        ?>	
		</div>
		<table>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Email</th>
				<th>Senha</th>
				<th>Dt.Nascimento</th>
				<th>Ações</th>
			</tr>

			<?php
				if($consulta->rowCount() > 0){

					while($row = $consulta->fetch()) {
						$data = date("d-m-Y",strtotime(str_replace('-','/',$row['dt_nascimento'])));
						echo "	<tr>
									<td>".$row['id']."</td>
									<td>".$row['nome']."</td>
									<td>".$row['email']."</td>
									<td>".$row['senha']."</td>
									<td>".$data."</td>
									<td>
										<a href='editar.php?id=".$row['id']."'>Editar</a> - 
										<a href='excluir.php?id=".$row['id']."'>Excluir</a>
									</td>
								</tr>";
					}
				
				}else{
					echo "Não existem usuários cadastrados";
				}
			?>
		</table>
	</div>
	<div>
		<form action="logout.php" id="logout">
			<input type="submit" name="sair" value="Sair" id="sair" />			
		</form>
	</div>
</body>
</html>
<?php
} else {
	header("Location: login.php");
}
?>

