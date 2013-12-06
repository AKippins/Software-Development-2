<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Limbo</title>
<!--Aaron Kippins & Zack Meath-->
</head>
<body>

<h1>Change Status</h1>
</br>
<?php
require('connect_db.php');
require( 'helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'GET') {

     $change_id = $_GET['item_id'] ;
     $query = 'SELECT item_id, object, description, owner, finder, date_found, location_name, room, status FROM inventory as i inner join locations as l on i.location_id = l.location_id where item_id = ' . $change_id . ' ORDER BY item_id ASC' ;

	  # Execute the query
	  $results = mysqli_query( $dbc , $query ) ;
	  check_results($dbc, $results) ;

	  echo '<H2>Latest Entries</H2>' ;
	  echo '<TABLE border=1 cellpadding=3>';
	  echo '<TR>';
	  echo '<TH align=right>Item ID</TH>';
	  echo '<TH>Object</TH>';
	  echo '<TH>Description</TH>';
	  echo '<TH>Owner</TH>';
	  echo '<TH>Finder</TH>';
	  echo '<TH>Date</TH>';
	  echo '<TH>Location</TH>';
	  echo '<TH>Room</TH>';
	  echo '<TH>Status</TH>';
	  echo '</TR>';

	  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        
        echo '<TR>' ;
        #echo '<TD align=right>' . $alink . '</TD>' ;
        echo '<TD align=right>' . $row['item_id'] . '</TD>' ;
        echo '<TD>' . $row['object'] . '</TD>' ;
        echo '<TD>' . $row['description'] . '</TD>' ;
        echo '<TD>' . $row['owner'] . '</TD>' ;
        echo '<TD>' . $row['finder'] . '</TD>' ;
        echo '<TD>' . $row['date_found'] . '</TD>' ;
        echo '<TD>' . $row['location_name'] . '</TD>' ;
        echo '<TD>' . $row['room'] . '</TD>' ;
        echo '<TD>' . $row['status'] . '</TD>' ;
        echo '</TR>' ;
      }


      $change = '<br>Change the status of this item to: ';
      $change .= '<form action="changestatus.php" method="POST">';
      $change .= '<select required=1 name=\'status\'>';
      $change .= '<option value="found">Found</option>';
      $change .= '<option value="lost">Lost</option>';
      $change .= '<option value="claimed">Claimed</option>';
      $change .= '</select>';
      $change .= '<input type="hidden" name="id" value="' . $change_id . '">';
      $change .= '<input type="submit"></input>';
      $change .= '</form>';
      echo $change;

}
elseif ($_SERVER[ 'REQUEST_METHOD' ] == 'POST')
{	
	$id = $_POST['id'] ;
	$status = $_POST['status'] ;
	$query = 'UPDATE inventory SET status = \''. $status . '\' WHERE item_id = ' . $id;

	  # Execute the query
	$results = mysqli_query( $dbc , $query ) ;
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
 	
	exit();
}


?>