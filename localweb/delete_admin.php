<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Limbo</title>
<!--Aaron Kippins & Zack Meath-->
</head>
<body>

<h1>Delete Admin page</h1>
</br>
<?php
require('connect_db.php');
require( 'helpers.php' ) ;
$query = 'DELETE FROM users WHERE user_id = ' . '\'' . $_GET["id"] . '\'';
$results = mysqli_query($dbc,$query) ;
check_results($dbc, $results) ;


$query = 'SELECT user_id, pass, username FROM users WHERE user_id = 1';
$results = mysqli_query($dbc,$query) ;
check_results($dbc,$results) ;
if( $results )
  {
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        $username = $row['username'];
        $password = $row['pass'];
      }
      # Free up the results in memory
      mysqli_free_result( $results ) ;
  }
echo '<form id=\'form1\' method="POST" action="admin.php">';
echo '<input type="hidden" name="username" value="'.$username.'">';
echo '<input type="hidden" name="password" value="'.$password.'">';
echo '<A HREF="javascript:document.getElementById(\'form1\').submit();">Go back to the admin page</A>';
echo '</form>';
?>
</body>
