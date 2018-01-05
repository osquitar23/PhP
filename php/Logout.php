<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>
<?php
session_start();
unset($_SESSION['session_username']);
session_destroy();
header("location: Login.php");
?>
<body>
</body>
</html>