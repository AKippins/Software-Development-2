<?php
$debug = true;

function init($dbname) {
    # Connect to the database, create it if necessary
    $dbc = connect_db($dbname);

    # Populate the database
    populate_db($dbc);

    return $dbc;
}

function connect_db ($dbname) {
    # Connect to the database, if we fail assume the DB doesnt exist
    $dbc = @mysqli_connect ( 'localhost', 'root', '', $dbname );

    if($dbc) {
        mysqli_set_charset( $dbc, 'utf8' ) ;
        return $dbc;
    }
    # Create the database
    $dbc = @mysqli_connect ( 'localhost', 'root', '', '' );
    $query = 'CREATE DATABASE ' . $dbname;
    $results = mysqli_query($dbc, $query);
    check_results($results);

    # Close connection since we dont need it
    mysqli_close( $dbc );

    # Connect to the (newly created) database
    $dbc = @mysqli_connect ( 'localhost', 'root', '', $dbname )
        OR die ( mysqli_connect_error() ) ;

    # Set encoding to match PHP script encoding.
    mysqli_set_charset( $dbc, 'utf8' ) ;

    return $dbc;
}
function populate_db($dbc) {
    # Create prints table, if it doesnt exist
    $query  = 'CREATE TABLE IF NOT EXISTS locations ';
    $query .= '( location_id INT AUTO_INCREMENT PRIMARY KEY, ';
    $query .= '  create_date date not null,';
    $query .= '  update_date date not null,';
    $query .= '  location_name text not null);';
    $results = mysqli_query($dbc,$query);
    check_results( $results );

    # Check if table is already populated
    $query = 'SELECT COUNT(*) FROM locations';
    $results = mysqli_query($dbc,$query);
    check_results( $results );

    if($results) {
        $row = mysqli_fetch_array($results, MYSQLI_NUM);

        if($row[0] > 0){
          usleep(1);
        }
        else
        {
        # If we get here, populate the table
        $query = 'insert into locations(create_date, update_date, location_name) values (\'now()\',\'now()\',\'Hancock Center\'), (\'now()\',\'now()\',\'Dyson Center\'), (\'now()\',\'now()\',\'Donnelly Hall\'), (\'now()\',\'now()\',\'Lowell Thomas\'), (\'now()\',\'now()\',\'Fontaine Hall\'), (\'now()\',\'now()\',\'Fontaine Annex\'), (\'now()\',\'now()\',\'Library\'), (\'now()\',\'now()\',\'Leo Hall\'), (\'now()\',\'now()\',\'Champagnat Hall\'), (\'now()\',\'now()\',\'Sheahan Hall\'), (\'now()\',\'now()\',\'Marian Hall\'), (\'now()\',\'now()\',\'Byrne House\'), (\'now()\',\'now()\',\'Our Lady Seat Of Wisdom Chapel\'), (\'now()\',\'now()\',\'Cornell Boathouse\'), (\'now()\',\'now()\',\'Fern Tor\'), (\'now()\',\'now()\',\'Foy Townhouses\'), (\'now()\',\'now()\',\'Fulton Street Townhouses\'), (\'now()\',\'now()\',\'New Fulton Townhouses\'), (\'now()\',\'now()\',\'Gartland Commons\'), (\'now()\',\'now()\',\'Greystone Hall\'), (\'now()\',\'now()\',\'Kieran Gatehouse\'), (\'now()\',\'now()\',\'Kirk House\'), (\'now()\',\'now()\',\'Longview Park\'), (\'now()\',\'now()\',\'Lower Townhouses\'), (\'now()\',\'now()\',\'Marist Boathouse\'), (\'now()\',\'now()\',\'McCann Center\'), (\'now()\',\'now()\',\'Midrise Hall\'), (\'now()\',\'now()\',\'New Townhouses\'), (\'now()\',\'now()\',\'St.Ann\s Hermitage\'), (\'now()\',\'now()\',\'St.Peter\s\'), (\'now()\',\'now()\',\'Steel Plant Art Studios\'), (\'now()\',\'now()\',\'Rotunda\'), (\'now()\',\'now()\',\'Tenney Stadium\'), (\'now()\',\'now()\',\'Tennis Pavilion\'), (\'now()\',\'now()\',\'Lower West Cedar Townhouses\') , (\'now()\',\'now()\',\'Upper West Cedar Townhouses\');';
        $results = mysqli_query($dbc,$query);
        check_results( $results );
        }
    }
    else
    {
    # If we get here, populate the table
    $query = 'insert into locations(create_date, update_date, location_name) values (\'now()\',\'now()\',\'Hancock Center\'), (\'now()\',\'now()\',\'Dyson Center\') , (\'now()\',\'now()\',\'Donnelly Hall\') , (\'now()\',\'now()\',\'Lowell Thomas\') , (\'now()\',\'now()\',\'Fontaine Hall\')  , (\'now()\',\'now()\',\'Fontaine Annex\')  , (\'now()\',\'now()\',\'Library\') , (\'now()\',\'now()\',\'Leo Hall\') , (\'now()\',\'now()\',\'Champagnat Hall\') , (\'now()\',\'now()\',\'Sheahan Hall\') , (\'now()\',\'now()\',\'Marian Hall\') , (\'now()\',\'now()\',\'Byrne House\') , (\'now()\',\'now()\',\'Our Lady Seat Of Wisdom Chapel\') , (\'now()\',\'now()\',\'Cornell Boathouse\') , (\'now()\',\'now()\',\'Fern Tor\') , (\'now()\',\'now()\',\'Foy Townhouses\') , (\'now()\',\'now()\',\'Fulton Street Townhouses\'), (\'now()\',\'now()\',\'New Fulton Townhouses\') , (\'now()\',\'now()\',\'Gartland Commons\') , (\'now()\',\'now()\',\'Greystone Hall\') , (\'now()\',\'now()\',\'Kieran Gatehouse\') , (\'now()\',\'now()\',\'Kirk House\') , (\'now()\',\'now()\',\'Longview Park\') , (\'now()\',\'now()\',\'Lower Townhouses\'), (\'now()\',\'now()\',\'Marist Boathouse\') , (\'now()\',\'now()\',\'McCann Center\'), (\'now()\',\'now()\',\'Midrise Hall\') , (\'now()\',\'now()\',\'New Townhouses\') , (\'now()\',\'now()\',\'St.Ann\s Hermitage\') , (\'now()\',\'now()\',\'St.Peter\s\') , (\'now()\',\'now()\',\'Steel Plant Art Studios\') , (\'now()\',\'now()\',\'Rotunda\') , (\'now()\',\'now()\',\'Tenney Stadium\') , (\'now()\',\'now()\',\'Tennis Pavilion\') , (\'now()\',\'now()\',\'Lower West Cedar Townhouses\') , (\'now()\',\'now()\',\'Upper West Cedar Townhouses\') ';
    $results = mysqli_query($dbc,$query);
    check_results( $results );

    }
    $query  = 'CREATE TABLE IF NOT EXISTS inventory ';
    $query .= '( item_id INT AUTO_INCREMENT PRIMARY KEY, ';
    $query .= '  description text,';
    $query .= '  object text not null,';
    $query .= '  date_found date not null,';
    $query .= '  location_id int not null references locations(location_id),';
    $query .= '  room text,';
    $query .= '  owner text,';
    $query .= '  finder text,';
    $query .= '  status set(\'found\',\'lost\',\'claimed\') not null );';
    $results = mysqli_query($dbc,$query);
    check_results( $results );

    # Check if table is already populated
    $query = 'SELECT COUNT(*) FROM inventory';
    $results = mysqli_query($dbc,$query);
    check_results( $results );

    if($results) {
        $row = mysqli_fetch_array($results, MYSQLI_NUM);

        if($row[0] > 0){}
        else
        { 
          $query = '';
          $results = mysqli_query($dbc,$query);
        check_results( $results );
        }
    }
    else
    {
    # If we get here, populate the table
    $query = '';
    $results = mysqli_query($dbc,$query);
    check_results( $results );
    }

    $query  = 'CREATE TABLE IF NOT EXISTS users ';
    $query .= '( user_id INT AUTO_INCREMENT PRIMARY KEY, ';
    $query .= '  username char(20) not null,';
    $query .= '  pass char(40) not null );';
    $results = mysqli_query($dbc,$query);
    check_results( $results );

    # Check if table is already populated
    $query = 'SELECT COUNT(*) FROM inventory';
    $results = mysqli_query($dbc,$query);
    check_results( $results );

    if($results) {
        $row = mysqli_fetch_array($results, MYSQLI_NUM);

        if($row[0] > 0){}
        else
        { 
          $query = 'insert into users(username, pass) values (\'admin\',\'gaze11e\');';
          $results = mysqli_query($dbc,$query);
        check_results( $results );
        }
    }
    else
    {
    # If we get here, populate the table
    $query = '';
    $results = mysqli_query($dbc,$query);
    check_results( $results );
    }
}
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
  		echo '<H1>Items</H1>' ;
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
      echo '<H2>These Are The Latest Entries Into Our Database</H2>' ;
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
        echo '<TD><a href=\'deleteentry.php?item_id=' . $row['item_id'] . '\'>Delete</a></TD>' ;
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