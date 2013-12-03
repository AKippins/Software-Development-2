<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Limbo</title>
<!--Aaron Kippins & Zack Meath-->
</head>
<body>

<?php 
# Connect to MySQL server and the database
require( 'limbo_alpha/connect_db.php' ) ;

# Includes these helper functions
require( 'limbo_alpha/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

    $username = $_POST['username'] ;
	
	$password = $_POST['password'] ;
	
    if (!valid_name($username) or !valid_name($password))
    	{
		echo '<p style="color:red;font-size:16px;">You must enter a username and password</p>';
		}
	else
		{
		adminlogin($dbc, $username, $password);
		}
    
}
else
{
 	header("Location: admin_login.php"); /* Redirect browser */
	exit();
}
?>
</br>