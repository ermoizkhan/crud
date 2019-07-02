<?php
session_start();

include('db_connection.php');

if (isset($_POST['login'])) 
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "select * from admin where username = '$username' and password = '$password'";
	$result = mysqli_query($con,$sql);
	//echo "<pre>";
	//print_r(mysqli_fetch_assoc($result));
	$num = mysqli_fetch_array($result);
	if ($num>0) 
	{
		//echo "ok";
		$_SESSION['alogin']=$_POST['username'];
		//print_r($_SESSION['login']);exit;
		header('location:index.php');
	}
	else
	{
		//echo "not";
		header('location:admin.php');
	}


}


?>



<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
</head>
<body>
	<form action="admin.php" method="post">
		<h1>Admin Login</h1>
		<label>Username:</label>
		<input type="text" name="username">
		<br><br>
		<label>Password:</label>
		<input type="password" name="password">
		<br><br>
		<input type="submit" name="login" value="login">
	</form>
</body>
</html>