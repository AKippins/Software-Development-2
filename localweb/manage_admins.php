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
			show_admins($dbc);
			echo '<br>Add a new Admin here:';
			echo '<form action="add_admin.php" method="POST">';
     		echo 'Username: <input type="textbox" name="username"><br>';
     		echo 'Password: <input type="password" name="pass"><br>';
      		echo '<input type="submit"></input>';
      		echo '</form>';
		}
		}
    
}
else
{
 	echo 'You may Login as an admin ' . '<a href = "admin_login.php">here</a> or go back to the <a href = "inventory.php">Limbo Homepage</a>'; /* Redirect browser */
 }
?>
</br>
</html>