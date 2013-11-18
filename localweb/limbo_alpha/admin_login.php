<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Limbo</title>
<!--Aaron Kippins & Zack Meath-->
</head>
<body>

<h1>Admin Login page</h1>
</br>
<form action="admin.php" method="POST">
<table cellspacing = 15>
	<tr><td>Username: </td> <td><input type="text" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"></td></tr>
	<tr><td>Password: </td> <td><input type="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>"></td></tr>
</table>
<input type="submit">
</form>
</body>
