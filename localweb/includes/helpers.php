<?php
$debug = true;

# Shows the records in prints
function show_records($dbc) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT number, fname, lname FROM presidents ORDER BY number DESC' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Presidents</H1>' ;
  		echo '<TABLE>';
  		echo '<TR>';
  		echo '<TH>Number</TH>';
  		echo '<TH>First Name</TH>';
		echo '<TH>Last Name</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD>' . $row['number'] . '</TD>' ;
    		echo '<TD>' . $row['fname'] . '</TD>' ;
			echo '<TD>' . $row['lname'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}


function show_record($dbc, $id) {
	# Create a query to get the name and price sorted by price
	$query = 'SELECT * FROM presidents where id = ' . $id ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Presidents</H1>' ;
  		echo '<TABLE>';
  		echo '<TR>';
  		echo '<TH align=right>Number</TH>';
  		echo '<TH>First Name</TH>';
		echo '<TH>Last Name</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
    		echo '<TR>' ;
    		echo '<TD align=right>' . $row['number'] . '</TD>' ;
    		echo '<TD>' . $row['fname'] . '</TD>' ;
			echo '<TD>' . $row['lname'] . '</TD>' ;
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
	$query = 'SELECT id, fname, lname FROM presidents ORDER BY number DESC' ;

	# Execute the query
	$results = mysqli_query( $dbc , $query ) ;
	check_results($results) ;

	# Show results
	if( $results )
	{
  		# But...wait until we know the query succeed before
  		# rendering the table start.
  		echo '<H1>Presidents</H1>' ;
  		echo '<TABLE>';
  		echo '<TR>';
  		echo '<TH>ID</TH>';
  		echo '<TH>First Name</TH>';
		echo '<TH>Last Name</TH>';
  		echo '</TR>';

  		# For each row result, generate a table row
  		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
  		{
		$alink = '<A HREF=linkypresidents.php?id=' . $row['id'] . '>' . $row['id'] . '</A>' ;
    		echo '<TR>' ;
    		echo '<TD align=right>' . $alink . '</TD>' ;
    		echo '<TD>' . $row['fname'] . '</TD>' ;
			echo '<TD>' . $row['lname'] . '</TD>' ;
    		echo '</TR>' ;
  		}

  		# End the table
  		echo '</TABLE>';

  		# Free up the results in memory
  		mysqli_free_result( $results ) ;
	}
}


# Inserts a record into the prints table
function insert_record($dbc, $number, $fname, $lname) {
  $query = 'INSERT INTO presidents(number, fname, lname) VALUES ("' . $number . '" , "' . $fname . '", "' . $lname . '" )' ;
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