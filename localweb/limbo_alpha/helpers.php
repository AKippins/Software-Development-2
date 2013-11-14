<?php
$debug = true;

#Shows the records in inventory 
function show_records($dbc) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT item_id, object, description, size, color, weight, date_found, place_found FROM inventory ORDER BY item_id DESC' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Inventory</H1>' ;
  		echo '<TABLE>';
  		echo '<TR>';
  		echo '<TH>Item ID</TH>';
  		echo '<TH>Object</TH>';
  		echo '<TH>Description</TH>';
	   	echo '<TH>Size</TH>';
		  echo '<TH>Color</TH>';
		  echo '<TH>Weight</TH>';
		  echo '<TH>Date Found</TH>';
		  echo '<TH>Place Found</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['item_id'] . '</TD>' ;
    		echo '<TD>' . $row['object'] . '</TD>' ;
    		echo '<TD>' . $row['description'] . '</TD>' ;
    		echo '<TD>' . $row['size'] . '</TD>' ;
    		echo '<TD>' . $row['color'] . '</TD>' ;
    		echo '<TD>' . $row['weight'] . '</TD>' ;
    		echo '<TD>' . $row['date_found'] . '</TD>' ;
			  echo '<TD>' . $row['place_found'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}

# Inserts a record into the prints table
function insert_record($dbc, $object, $description, $size, $color, $weight, $date_found, $place_found) {
  $query = 'INSERT INTO inventory(object, description, size, color, weight, date_found, place_found) VALUES ($object . ", " . $description . ", " . $size . ", " . $color . ", " . $weight . ", " . $date_found . ", " . $place_found)';
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