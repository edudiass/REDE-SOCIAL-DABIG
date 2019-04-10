<?php  

require 'config/config.php';

//declarando variaveis para prevenir erros

$fname = ""; //nome
$lname = ""; //sobrenome
$em = ""; //email
$em2 = ""; //email2
$password = ""; //senha
$password2 = ""; //senha2
$date = ""; //data de submit
$error_array = array();
$bday = "";
$day_start_work ="";
$city = "";
$state = "";
$salary ="";
$level_ins = "";
$languages = "";
$company = "";



if(isset($_POST['register_button'])){
//registrando dados do form


	//nome
	$fname = strip_tags($_POST['reg_fname']);//tira tags html
	$fname = str_replace(' ','', $fname);//tira espaços
	$fname = ucfirst(strtolower($fname));//coloca so a primeira letra maiuscula
	$_SESSION['reg_fname'] = $fname;//salve o valor na sessao

	//sobrenome
	$lname = strip_tags($_POST['reg_lname']);//tira tags html
	$lname = str_replace(' ','', $lname);//tira espaços
	$lname = ucfirst(strtolower($lname));//coloca so a primeira letra maiuscula
	$_SESSION['reg_lname'] = $lname;//salve o valor na sessao

	//email
	$em = strip_tags($_POST['reg_email']);//tira tags html
	$em = str_replace(' ','', $em);//tira espaços
	//$em = ucfirst(strtolower($em));//coloca so a primeira letra maiuscula
	$_SESSION['reg_email'] = $em;//salve o valor na sessao

	//email2
	$em2 = strip_tags($_POST['reg_email2']);//tira tags html
	$em2 = str_replace(' ','', $em2);//tira espaços
	//$em2 = ucfirst(strtolower($em2));//coloca so a primeira letra maiuscula
	$_SESSION['reg_email2'] = $em2;//salve o valor na sessao

	//senha
	$password = strip_tags($_POST['reg_password']);//tira tags html
	$password2 = strip_tags($_POST['reg_password2']);//tira tags html

	$date = date("Y-m-d"); //data atual
	$bday = strip_tags($_POST['bday']);//dia de nascimento
	$day_start_work = strip_tags($_POST['day_start_work']);//dia que comeceu a trampar
	
	$city = strip_tags($_POST['city']);//cidade
	$state = strip_tags($_POST['state']);//estado
	$salary = strip_tags($_POST['salary']);//salario
	$languages = strip_tags($_POST['languages']);//linguaguens preferidas
	$level_ins = strip_tags($_POST['level_ins']);//nivel instrução
	$company = strip_tags($_POST['company']);//empresa atual



	//validar email
	if($em == $em2) {
	//compara os emails
		if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//verifica se o email existe
			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");
			//conta numero retornado
			$num_rows = mysqli_num_rows($e_check);

			if ($num_rows > 0) {
				array_push($error_array, "E-mail já cadastrado<br>");
			}
		}
		else{
			array_push($error_array, "Formato de email invalido<br>"); //verifica se falta o @
		}
	}
	else {
		array_push($error_array, "Confirmação de e-mail inválida<br>");
	}
	

	//validar nome e senha
	if(strlen($fname) > 25 || strlen($fname) < 2){
		array_push($error_array, "Seu nome deve ter entre 2 e 25 caracteres<br>");
	}
	if(strlen($lname) > 25 || strlen($lname) < 2){
		array_push($error_array, "Seu sobrenome deve ter entre 2 e 25 caracteres<br>");
	}
	if ($password != $password2) {
		array_push($error_array, "Suas senhas não são iguais<br>");
	}
	else {
		if(preg_match('/[^A-Za-z0-9]/', $password)){
			array_push($error_array, "Sua senha so pode ter caracteres em ingles e numeros<br>");
		}
	}
	if (strlen($password > 30 || strlen($password) < 5)) {
		array_push($error_array, "Sua senha deve ter entre 5 e 30 caracteres<br>");
	}

	if (empty($error_array)) {
		$password = md5($password); //encripta a senha antes de enviar ao banco

		//gerando um username com o nome e sobrenome

		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

		$i = 0;
		//se o usuario existe, adiociona numero ao username
		while(mysqli_num_rows($check_username_query) !=0){
			$i++;//adiciona 1 para i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

		}
		//gerando uma imagem de perfil
		$rand = rand(1, 2); //numeros randomicos entre 1 e 2

		if ($rand == 1) 
			$profile_pic = "assets/images/profile_pics/defaults/head_alizarin.png";
		else if ($rand == 2)
			$profile_pic = "assets/images/profile_pics/defaults/head_amethyst.png";

		$query = mysqli_query($con, "INSERT INTO users VALUES('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',', '$bday', '$day_start_work', '$city', '$state', '$salary','$languages','$level_ins','$company')");
		array_push($error_array,"<span style='color:#14C800;'> Tudo certo! Continue e faça seu login!</span><br>");
		//limpar sessao
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}
		
	}
?>