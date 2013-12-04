<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Limbo</title>
<!--Aaron Kippins & Zack Meath-->
</head>
<body>

<h1>Delete entry page</h1>
</br>
<?php
require( 'helpers.php' ) ;
$query = 'DELETE FROM inventory WHERE item_id = ' . '\'' . $_GET["item_id"] . '\'';
$results = mysqli_query($dbc,$query) ;
check_results($results) ;
header( 'Location: 127.0.0.1:8888/limbo_alpha/admin.php' ) ;
?>
</body>
