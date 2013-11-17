<?php
$debug = true;

#Shows the records in inventory 
function show_records($dbc) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT item_id, object, description, room, owner, date_found, location_id, status FROM inventory ORDER BY item_id ASC' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Lost Items</H1>' ;
  		echo '<TABLE border=1>';
  		echo '<TR>';
  		echo '<TH align=right>Item ID</TH>';
  		echo '<TH>Object</TH>';
  		echo '<TH>Description</TH>';
	   	echo '<TH>Room</TH>';
		  echo '<TH>Owner</TH>';
		  echo '<TH>Date Lost</TH>';
		  echo '<TH>Place Lost</TH>';
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
  $query = 'SELECT item_id, object, description, room, owner, date_found, location_id, status FROM inventory WHERE status="found" ORDER BY item_id ASC' ;

  # Execute the query
  $results = mysqli_query( $dbc , $query ) ;
  check_results($results) ;

  # Show results
  if( $results )
  {
      # But...wait until we know the query succeed before
      # rendering the table start.
      echo '<H2>These Are Some Items That Have Been Recently Found.....</H2>' ;
      echo '<H3>Are Any Of These What You\'re Looking For???</H3>' ;
      echo '<TABLE border=1>';
      echo '<TR>';
      echo '<TH align=right>Item ID</TH>';
      echo '<TH>Object</TH>';
      echo '<TH>Description</TH>';
      echo '<TH>Room</TH>';
      echo '<TH>Owner</TH>';
      echo '<TH>Date Lost/Found</TH>';
      echo '<TH>Place Lost/Found</TH>';
      echo '<TH>Status</TH>';
      echo '</TR>';

      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        $alink = '<A HREF=inventory_lost.php?item_id=' . $row['item_id'] . '>' . $row['item_id'] . '</A>' ;
        echo '<TR>' ;
        echo '<TD align=right>' . $alink . '</TD>' ;
        echo '<TD>' . $row['object'] . '</TD>' ;
        echo '<TD>' . $row['description'] . '</TD>' ;
        echo '<TD>' . $row['room'] . '</TD>' ;
        echo '<TD>' . $row['owner'] . '</TD>' ;
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
?>