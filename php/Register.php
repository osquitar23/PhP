<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" href="miestilo.css">
</head>
<?php

error_reporting(0);
$full_name="";
$email="";
$username="";
$password="";

include("connection.php");


if(isset($_POST["register"]))//Cuando pulso al boton
{
if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']))//Estos datos me los registrar en la tabla usertbl.
{
$full_name=$_POST['full_name'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];

$query=mysqli_query($con,"select * from usertbl where username='".$username."'");

$numrows=mysqli_num_rows($con,$query);

if($numrows==0)//Si no devuelve filas no hay registro.
{
	$sql="insert into usertbl(full_name, email, username, password) values ('$full_name','$email','$username','$password')";
	
	$result=mysqli_query($con,$sql);//Aqui lanzamos un mensaje de cuenta creada, y en else el error.

	if($result){
	$message ="Cuenta creada correctamente";
	//$crear=mysqli_query($con,"create table $username (id varchar (10) primary key, nombre varchar (20), apellidos varchar (20))"); 
	$crear=mysqli_query($con, "create user '$username'@localhost identified by '$password'");
	$crear2=mysqli_query($con, "grant select on userlitdb.'$username' to '$username'@localhost");
	$crear3=mysqli_query($con,"grant select on userlitdb.productos to '$username'@localhost");
	$crear4=mysqli_query($con, "flush privileges");
	
	}
	else{
	$message ="El nombre de usuario ya existe! Por favor, intenta con otro!";	
	}
}
else
{
$message ="Error al ingresar datos de la informacion!";
}
}
else
{
$message ="Todos los campos no deben estar vacios!";
}
}	

?>

<?php
if(!empty($message))
{
echo "<p class=\"error\">"."MESSAGE: ".$message."</p>";	
}
?>
<body>
<div class="container mregister">
<div id="Login">
<h1>Registrar</h1>
<form name="registergorm" id="registerform" action="Register.php" method="post">
<p>
<label for="user_login">Nombre Completo<br />
<input type="text" name="full_name" id="full_name" class="input" size="32" value="" /></label>
</p>
<p>
<label for="user_pass">E-mail<br />
<input type="text" name="email" id="email" class="input" size="32" value="" /></label>
</p>
<p>
<label for="user_pass">Nombre De Usuario<br />
<input type="text" name="username" id="username" class="input" size="32" value="" /></label>
</p>
<p>
<label for="user_pass">Contraseña<br />
<input type="text" name="password" id="password" class="input" size="32" value="" /></label>
</p>
<p class="submit">
<input type="submit" name="register" id="register" class="button" value="Registrar" />
</p>
<p class="regtext">¿Ya tienes cuenta? <a href="Login.php" >Entra Aqui!</a>!</p>
</form>

</div>
</div>
<?php
include ("footer.php");
?> 
</body>
</html>