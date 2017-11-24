<?php
session_start();

include_once 'session.php';
//$db = mysqli_connect('localhost','root','');
 $error = false;

if (isset($_POST['reg_user'])) {
	
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$passwd = mysqli_real_escape_string($db, $_POST['passwd']);
	// jelszó titkosítás SHA256();
    $password = hash('sha256', $password);
	$passwd = hash('sha256', $passwd);

	// itt ellenörzi hogy megfelelően töltötték e ki az űrlapot
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }

	if ($password != $passwd) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
		$query = "INSERT INTO users (username, email, password) 
				  VALUES('$username', '$email', '$password')";
		mysqli_query($db, $query);

		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');
	}

}

//valós email 
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) 
  {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysql_query($query);
   $count = mysql_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  // password encrypt using SHA256();
  $password = hash('sha256', $password);
 }
?>