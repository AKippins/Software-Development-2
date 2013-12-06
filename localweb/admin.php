<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Limbo</title>
<!--Aaron Kippins & Zack Meath-->
</head>
<body>

<?php 
require('connect_db.php');

# Includes these helper functions
require( 'helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

    $username = $_POST['username'] ;
	
	$password = $_POST['password'] ;
	
    if (!valid_name($username) or !valid_name($password))
    	{
		echo '<p style="color:red;font-size:16px;">You must enter a username and password</p>';
		}
	else
		{
		if (adminlogin($dbc, $username, $password))
		{
			echo '<h1>Admin page</h1>';
			show_admin_header($dbc);
			show_admin_records($dbc);
		}
		}
    
}
else
{
 	header("Location: http://www.127.0.0.1:8888/limbo_alpha/admin_login.php"); /* Redirect browser */
	exit();
}
?>
</br>