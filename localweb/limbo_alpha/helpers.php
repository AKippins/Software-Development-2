<?php
$debug = true;

#Shows the records in inventory 
function show_records($dbc) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT item_id, object, description, room, owner, finder, date_found, location_id, status FROM inventory ORDER BY item_id ASC' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Latest Entries</H1>' ;
  		echo '<TABLE border=1>';
  		echo '<TR>';
  		echo '<TH align=right>Item ID</TH>';
  		echo '<TH>Object</TH>';
  		echo '<TH>Description</TH>';
	   	echo '<TH>Room</TH>';
		  echo '<TH>Owner</TH>';
		  echo '<TH>Finder</TH>';
		  echo '<TH>Date Lost/Found</TH>';
		  echo '<TH>Place Lost/Found</TH>';
      echo '<TH>Status</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD align=right>' . $row['item_id'] . '</TD>' ;
    		echo '<TD>' . $row['object'] . '</TD>' ;
    		echo '<TD>' . $row['description'] . '</TD>' ;
    		echo '<TD>' . $row['room'] . '</TD>' ;
    		echo '<TD>' . $row['owner'] . '</TD>' ;
    		echo '<TD>' . $row['finder'] . '</TD>' ;
    		echo '<TD>' . $row['date_found'] . '</TD>' ;
			  echo '<TD>' . $row['location_id'] . '</TD>' ;
        echo '<TD>' . $row['status'] . '</TD>' ;

    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

function show_record($dbc, $item_id) {
  # Create a query to get the name and price sorted by price
  $query = 'SELECT * FROM inventory WHERE item_id = ' . $item_id ;

  # Execute the query
  $results = mysqli_query( $dbc , $query ) ;
  check_results($results) ;

  # Show results
  if( $results )
  {
      # But...wait until we know the query succeed before
      # rendering the table start.
      echo '<H1>You\'ve Selected This Item...</H1>' ;
      echo '<TABLE border=1>';
      echo '<TR>';
      echo '<TH align=right>Item ID</TH>';
      echo '<TH>Object</TH>';
      echo '<TH>Description</TH>';
      echo '<TH>Room</TH>';
      echo '<TH>Owner</TH>';
      echo '<TH>Finder</TH>';
      echo '<TH>Date Lost/Found</TH>';
      echo '<TH>Place Lost/Found</TH>';
      echo '<TH>Status</TH>';
      echo '</TR>';

      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        echo '<TR>' ;
        echo '<TD align=right>' . $row['item_id'] . '</TD>' ;
        echo '<TD>' . $row['object'] . '</TD>' ;
        echo '<TD>' . $row['description'] . '</TD>' ;
        echo '<TD>' . $row['room'] . '</TD>' ;
        echo '<TD>' . $row['owner'] . '</TD>' ;
        echo '<TD>' . $row['finder'] . '</TD>' ;
        echo '<TD>' . $row['date_found'] . '</TD>' ;
        echo '<TD>' . $row['location_id'] . '</TD>' ;
        echo '<TD>' . $row['status'] . '</TD>' ;

        echo '</TR>' ;
      }

      # End the table
      echo '</TABLE>';

      # Free up the results in memory
      mysqli_free_result( $results ) ;
  }
}

function show_link_records($dbc) {
  # Create a query to get the name and price sorted by price
  $query = 'SELECT item_id, object, description, room, owner, finder, date_found, location_id, status FROM inventory WHERE (status="lost") or (status="found") ORDER BY item_id ASC' ;

  # Execute the query
  $results = mysqli_query( $dbc , $query ) ;
  check_results($results) ;

  # Show results
  if( $results )
  {
      # But...wait until we know the query succeed before
      # rendering the table start.
      echo '<H2>These Are The Latest Entries Into Our Database...</H2>' ;
      echo '<H3>If You\'ve Lost Or Found Any Of These Items Let Us Know So We Can Help You Out!</H3>';
      echo '<TABLE border=1>';
      echo '<TR>';
      echo '<TH align=right>Item ID</TH>';
      echo '<TH>Object</TH>';
      echo '<TH>Description</TH>';
      echo '<TH>Room</TH>';
      echo '<TH>Owner</TH>';
      echo '<TH>Finder</TH>';
      echo '<TH>Date Lost/Found</TH>';
      echo '<TH>Place Lost/Found</TH>';
      echo '<TH>Status</TH>';
      echo '</TR>';

      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        $alink = '<A HREF=inventory.php?item_id=' . $row['item_id'] . '>' . $row['item_id'] . '</A>' ;
        echo '<TR>' ;
        echo '<TD align=right>' . $alink . '</TD>' ;
        echo '<TD>' . $row['object'] . '</TD>' ;
        echo '<TD>' . $row['description'] . '</TD>' ;
        echo '<TD>' . $row['room'] . '</TD>' ;
        echo '<TD>' . $row['owner'] . '</TD>' ;
        echo '<TD>' . $row['finder'] . '</TD>' ;
        echo '<TD>' . $row['date_found'] . '</TD>' ;
        echo '<TD>' . $row['location_id'] . '</TD>' ;
        echo '<TD>' . $row['status'] . '</TD>' ;
        echo '</TR>' ;
      }

      # End the table
      echo '</TABLE>';

      # Free up the results in memory
      mysqli_free_result( $results ) ;
  }
}

# Inserts a record into the prints table
function insert_record($dbc, $object, $description, $room, $owner, $finder, $date_found, $location_id, $status) {
  $query = 'INSERT INTO inventory(object, description, room, owner, finder, date_found, location_id, status) VALUES ("' . $object . '", "'. $description . '", "' . $room . '", "'. $owner . '", "' . $finder . '", "' . $date_found . '", "' . $location_id . '", "' . $status . '")';
  show_query($query);
 
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;

  return $results ;
}

# Shows the query as a debugging aid
function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;

  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}

# Checks for Valid Number
function valid_number($num) {
  if(empty($num) || !is_numeric($num)) {
    return false ;
	}
  else {
    $num = intval($num) ;
     if($num <= 0)
        return false ;
  }
  return true ;
}

#Checks for valid Name
function valid_name($aname) {
  if(empty($aname)) 
    return false ;
  else {
        return true ;
  }	
}

function show_admin_records($dbc) {
  # Create a query to get the name and price sorted by price
  $query = 'SELECT item_id, object, description, room, owner, finder, date_found, location_id, status FROM inventory WHERE (status="lost") or (status="found") ORDER BY item_id ASC' ;

  # Execute the query
  $results = mysqli_query( $dbc , $query ) ;
  check_results($results) ;

  # Show results
  if( $results )
  {
      # But...wait until we know the query succeed before
      # rendering the table start.
      echo '<H2>These Are The Latest Entries Into Our Database...</H2>' ;
      echo '<TABLE border=1>';
      echo '<TR>';
      echo '<TH align=right>Item ID</TH>';
      echo '<TH>Object</TH>';
      echo '<TH>Description</TH>';
      echo '<TH>Room</TH>';
      echo '<TH>Owner</TH>';
      echo '<TH>Finder</TH>';
      echo '<TH>Date Lost/Found</TH>';
      echo '<TH>Place Lost/Found</TH>';
      echo '<TH>Status</TH>';
      echo '<TH>Delete</TH>';
      echo '</TR>';

      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        $alink = '<A HREF=inventory.php?item_id=' . $row['item_id'] . '>' . $row['item_id'] . '</A>' ;
        echo '<TR>' ;
        echo '<TD align=right>' . $alink . '</TD>' ;
        echo '<TD>' . $row['object'] . '</TD>' ;
        echo '<TD>' . $row['description'] . '</TD>' ;
        echo '<TD>' . $row['room'] . '</TD>' ;
        echo '<TD>' . $row['owner'] . '</TD>' ;
        echo '<TD>' . $row['finder'] . '</TD>' ;
        echo '<TD>' . $row['date_found'] . '</TD>' ;
        echo '<TD>' . $row['location_id'] . '</TD>' ;
        echo '<TD>' . $row['status'] . '</TD>' ;
        echo '<TD>' . '<a href=\'/deleteentry.php\'>Delete</a>' . '</TD>' ;
        echo '</TR>' ;
      }

      # End the table
      echo '</TABLE>';

      # Free up the results in memory
      mysqli_free_result( $results ) ;
  }
}
function adminlogin($dbc, $username, $password)
{
  $query = 'SELECT username, pass FROM users WHERE username = ' . '\'' . $username . '\' and pass = \'' . $password .'\'' ;

  # Execute the query
  $results = mysqli_query( $dbc , $query ) ;
  check_results($results) ;

  # Show results
  if( $results )
    {
      $x=0;
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        $x = $x + 1;
      }
      if ($x>1 or $x<1){echo 'Something is very wrong in the database';}
      else
      {
        echo '<h1>Admin page</h1>';
        show_admin_records($dbc);
      }
    }
  
}
?>