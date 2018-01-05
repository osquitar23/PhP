<!Doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" href="miestilo.css">
</head>
<?php
error_reporting(2);// Evita errorres
session_start();//Aqui iniciamos la sesion
require_once("connection.php");// Se meten los datos de conexion de php 
//require_once ---> Te inserta el fichero una vez, y es obligatorio que se cargue el fichero una vez
if(isset($_SESSION["session_username"]))// si en el array del $_SESSION se conecta un usuario que no esta registrado te dara un error
{
header("Location: Intropage.php");	// El header lanza el fichero de conexion.
}
if(isset($_POST["login"]))// si pulso el boton de enviar, dentro compruebo los datos.
{
if(!empty($_POST['username']) && !empty($_POST['password']))
{
$username=$_POST['username'];
$password=$_POST['password'];	

$query=mysqli_query($con, "select * from usertbl where username='$username' and password='$password';");
$numrows=mysqli_num_rows($query);

if($numrows!=0)//Si esto es distinto de cero, significa que los usuarios estan creados.
{
while($row=mysqli_fetch_row($query))
{
$dbusermane=$row[3];
$dbpassword=$row[4];
}
if($username==$dbusermane && $password==$dbpassword)//en $dbusermane es el valor de la columna de la base de datos.
{
$_SESSION['session_username']=$username;
header("location: Intropage.php");
}
}
else
{
$message="Nombre de usuario o contraseña invalidas!";
}
}
else{
$message="Todos los campos son requeridos!";
}
}

?>
<body> 
<div class="container mlogin">
<div id="Login">
<h1>Logueo</h1>
<form name="user_login" id="loginform" action="" method="post">
<p>
<label for="user_login">Nombre De Usuario<br />
<input type="text" name="username" id="username" class="input" value="" size="20" /></label>
</p>
<p>
<label for="user_pass">Contraseña<br />
<input type="text" name="password" id="password" class="input" value="" size="20" /></label>
</p>
<p class="submit">
<input type="submit" name="login" class="button" value="Entrar" />
</p>
<p class="regtext">¿No estas registrado? <a href="Register.php" >Regitrate Aqui</a>!</p>
</form>

</div>

</div>
</body>
<?php
if(!empty($message))//imprime el mensaje de error.
{
echo "<p class=\"error\">"."MESSAGE: ".$message."</p>";	
}
?>
</html>