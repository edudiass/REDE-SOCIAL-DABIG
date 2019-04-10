<?php

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';



?>


<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<title>Bem-vindo ao daBig!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>

</head>
<body>

		<?php 

		if(isset($_POST['register_button'])) {
			echo '
			<script>

			$(document).ready(function() {
				$("#first").hide();
				$("#second").show();
			});

			</script>


			';
		}

		?>

	<div class="wrapper">
		<div class="login_box">
			<div class="login_header">

				<!-- <h1>daBig</h1>
				<p>Login ou cadastre-se!</p> -->
			</div>

				<div id="first">
					<br>
					<form action="register.php" method="POST">
					<input type="email" name="log_email" placeholder="Email" value="<?php //nome
					if(isset($_SESSION['log_email'])){
						echo $_SESSION['log_email'];
					}
					?>" required>
					<br>
					<input type="password" name="log_password" placeholder="Senha">
					<?php if(in_array("Email ou senha inválidos", $error_array)) echo "<br>Email ou senha inválidos"; ?>
					<br>
					<br>
					<input type="submit" name="login_button" value="Login">
					<br>
					<br>
					<a href="#" id="signup" class="signup">Não tem uma conta? Registre-se aqui!</a>
					<br>
					<br>
				</form>

				</div>
			
				<div id="second">

					<form action="register.php" method="POST">
						<h2>Dados pessoais</h2>
						<input type="text" name="reg_fname" placeholder="Nome" value="<?php //nome
						if(isset($_SESSION['reg_fname'])){
							echo $_SESSION['reg_fname'];
						}
						?>" required>
						<br>
						<?php if(in_array("Seu nome deve ter entre 2 e 25 caracteres<br>", $error_array)) echo "Seu nome deve ter entre 2 e 25 caracteres<br>"; ?> 
						
						<input type="text" name="reg_lname" placeholder="Sobrenome" value="<?php
						if(isset($_SESSION['reg_lname'])){
							echo $_SESSION['reg_lname'];
						}
						?>" required>
						<br>
						<?php if(in_array("Seu sobrenome deve ter entre 2 e 25 caracteres<br>", $error_array)) echo "Seu sobrenome deve ter entre 2 e 25 caracteres<br>"; ?>
						
						<input type="email" name="reg_email" placeholder="E-mail" value="<?php 
						if(isset($_SESSION['reg_email'])){
							echo $_SESSION['reg_email'];
						}
						?>" required>
						<br>
						<input type="email" name="reg_email2" placeholder="Confirmar E-mail" value="<?php
						if(isset($_SESSION['reg_email2'])){
							echo $_SESSION['reg_email2'];
						}
						?>" required>
						<br>
						<?php if(in_array("E-mail já cadastrado<br>", $error_array)) echo "E-mail já cadastrado<br>";
						else if(in_array("Formato de email invalido<br>", $error_array)) echo "Formato de email invalido<br>";
						else if(in_array("Confirmação de e-mail inválida<br>", $error_array)) echo "Confirmação de e-mail inválida<br>"; ?>
						
						<input type="password" name="reg_password" placeholder="Senha" required>
						<br>
						<input type="password" name="reg_password2" placeholder="Confirmar senha" required>
						<br>
						<?php if(in_array("Suas senhas não são iguais<br>", $error_array)) echo "Suas senhas não são iguais<br>";
						else if(in_array("Sua senha so pode ter caracteres em ingles e numeros<br>", $error_array)) echo "Sua senha so pode ter caracteres em ingles e numeros<br>";
						else if(in_array("Sua senha deve ter entre 5 e 30 caracteres<br>", $error_array)) echo "Sua senha deve ter entre 5 e 30 caracteres<br>"; ?>
						
						Dia de nascimento:
						<br>
						<input type="date" name="bday" required>
						<br>
						<h2>Dados executivos</h2>
						Dia que começou a trabalhar como cientista de dados:
						<br>
						<input type="date" name="day_start_work" required>
						<br>
						<input type="text" name="city" placeholder="Cidade" required>
						<br>
						<input type="text" name="state" placeholder="Estado" required>
						<br>
						<input type="text" name="salary" placeholder="Salário atual" required>
						<br>
						<input type="text" name="level_ins" placeholder="Nível de instrução" required>
						<br>
						<input type="text" name="languages" placeholder="Linguagens de programação" required>
						<br>
						<input type="text" name="company" placeholder="Empresa" required>
						<br>
						<input type="submit" name="register_button" value="Registrar">
						<br>
						
						<?php if(in_array("<span style='color:#14C800;'> Tudo certo! Continue e faça seu login!</span><br>", $error_array)) echo "<span style='color:#14C800;'> Tudo certo! Continue e faça seu login!</span><br>";?>
						<a href="#" id="signin" class="signin">Já possui uma conta? Faça seu login!</a>

					</form>
				</div>
		</div>
	</div>

</body>
</html>