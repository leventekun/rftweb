<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['email'])){
header("location: profile.php");
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<title>Login</title>
<center><h1>Login</h1></center>
</head>
<body>
<form action="/action_page.php">
  E-mail: <input type="text" name="email"><br>
  Jelszó: <input type="password" name="password"><br>
  <input type="submit" value="Belépés">
</form>
</body>
</html>