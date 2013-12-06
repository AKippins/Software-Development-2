<?php
$debug = true;

function show_header(){
  echo '<h1>Welcome To Limbo</h1>';
  echo '<h3>Whether you\'ve lost or found something, You\'re in the right place!</h3>';
  echo '<table cellspacing = 10>';
  echo '<th><a href="inventory.php">Home</a></th>';
  echo '<th><a href="inventory_lost.php">Lost Something</a></th>';
  echo '<th><a href="inventory_found.php">Found Something</a></th>';
  echo '<th><a href="admin_login.php">Admin Login</a></th>';
  echo '</table>';
}
function show_admin_header($dbc){
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
  echo '<table cellspacing = 10>';
  echo '<th><form id=\'form1\' method="POST" action="admin.php"><input type="hidden" name="username" value="'.$username.'"><input type="hidden" name="password" value="'.$password.'"><A HREF="javascript:document.getElementById(\'form1\').submit();">Admin Home</A></form></th>';
  echo '<th><form id=\'form2\' method="POST" action="manage_admins.php"><input type="hidden" name="username" value="'.$username.'"><input type="hidden" name="password" value="'.$password.'"><A HREF="javascript:document.getElementById(\'form2\').submit();">Manage Admins</A></form></th>';
  echo '<th><a href="inventory.php">Logout</a></th>';
}
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
    check_results($dbc, $results);

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
    check_results($dbc, $results );

    # Check if table is already populated
    $query = 'SELECT COUNT(*) FROM locations';
    $results = mysqli_query($dbc,$query);
    check_results($dbc, $results);

    if($results) {
        $row = mysqli_fetch_array($results, MYSQLI_NUM);

        if($row[0] > 0){
          usleep(1);
        }
        else
        {
        # If we get here, populate the table
        $query = 'insert into locations(create_date, update_date, location_name) values (now(),now(),\'Hancock Center\'), (now(),now(),\'Dyson Center\'), (now(),now(),\'Donnelly Hall\'), (now(),now(),\'Lowell Thomas\'), (now(),now(),\'Fontaine Hall\'), (now(),now(),\'Fontaine Annex\'), (now(),now(),\'Library\'), (now(),now(),\'Leo Hall\'), (now(),now(),\'Champagnat Hall\'), (now(),now(),\'Sheahan Hall\'), (now(),now(),\'Marian Hall\'), (now(),now(),\'Byrne House\'), (now(),now(),\'Our Lady Seat Of Wisdom Chapel\'), (now(),now(),\'Cornell Boathouse\'), (now(),now(),\'Fern Tor\'), (now(),now(),\'Foy Townhouses\'), (now(),now(),\'Fulton Street Townhouses\'), (now(),now(),\'New Fulton Townhouses\'), (now(),now(),\'Gartland Commons\'), (now(),now(),\'Greystone Hall\'), (now(),now(),\'Kieran Gatehouse\'), (now(),now(),\'Kirk House\'), (now(),now(),\'Longview Park\'), (now(),now(),\'Lower Townhouses\'), (now(),now(),\'Marist Boathouse\'), (now(),now(),\'McCann Center\'), (now(),now(),\'Midrise Hall\'), (now(),now(),\'New Townhouses\'), (now(),now(),\'St.Ann\s Hermitage\'), (now(),now(),\'St.Peter\s\'), (now(),now(),\'Steel Plant Art Studios\'), (now(),now(),\'Rotunda\'), (now(),now(),\'Tenney Stadium\'), (now(),now(),\'Tennis Pavilion\'), (now(),now(),\'Lower West Cedar Townhouses\') , (now(),now(),\'Upper West Cedar Townhouses\');';
        $results = mysqli_query($dbc,$query);
        check_results($dbc, $results);
        }
    }
    else
    {
    # If we get here, populate the table
    $query = 'insert into locations(create_date, update_date, location_name) values (now(),now(),\'Hancock Center\'), (now(),now(),\'Dyson Center\') , (now(),now(),\'Donnelly Hall\') , (now(),now(),\'Lowell Thomas\') , (now(),now(),\'Fontaine Hall\')  , (now(),now(),\'Fontaine Annex\')  , (now(),now(),\'Library\') , (now(),now(),\'Leo Hall\') , (now(),now(),\'Champagnat Hall\') , (now(),now(),\'Sheahan Hall\') , (now(),now(),\'Marian Hall\') , (now(),now(),\'Byrne House\') , (now(),now(),\'Our Lady Seat Of Wisdom Chapel\') , (now(),now(),\'Cornell Boathouse\') , (now(),now(),\'Fern Tor\') , (now(),now(),\'Foy Townhouses\') , (now(),now(),\'Fulton Street Townhouses\'), (now(),now(),\'New Fulton Townhouses\') , (now(),now(),\'Gartland Commons\') , (now(),now(),\'Greystone Hall\') , (now(),now(),\'Kieran Gatehouse\') , (now(),now(),\'Kirk House\') , (now(),now(),\'Longview Park\') , (now(),now(),\'Lower Townhouses\'), (now(),now(),\'Marist Boathouse\') , (now(),now(),\'McCann Center\'), (now(),now(),\'Midrise Hall\') , (now(),now(),\'New Townhouses\') , (now(),now(),\'St.Ann\s Hermitage\') , (now(),now(),\'St.Peter\s\') , (now(),now(),\'Steel Plant Art Studios\') , (now(),now(),\'Rotunda\') , (now(),now(),\'Tenney Stadium\') , (now(),now(),\'Tennis Pavilion\') , (now(),now(),\'Lower West Cedar Townhouses\') , (now(),now(),\'Upper West Cedar Townhouses\') ';
    $results = mysqli_query($dbc,$query);
    check_results($dbc, $results);

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
    check_results($dbc, $results);

    # Check if table is already populated
    $query = 'SELECT COUNT(*) FROM inventory';
    $results = mysqli_query($dbc,$query);
    check_results($dbc, $results);

    if($results) {
        $row = mysqli_fetch_array($results, MYSQLI_NUM);

        if($row[0] > 0){}
        else
        { 
          $query = 'insert into inventory(description, object, date_found, location_id, room, owner, finder, status) values ';
          $query .= '(\'Black, crack in the top right corner\',\'iPhone 4s\',now(),1,\'0004\',\'Zack Meath\',null,\'lost\'), ';
          $query .= '(\'Wireless, white\',\'Xbox 360 Controller\',now(),8,\'Ground Floor\',null,\'Aaron Kippins\',\'found\'), ';
          $query .= '(\'Marist lanyard\',\'Keys\',now(),13,null,null,\'Ron Coleman\',\'found\'), ';
          $query .= '(\'Blue, says my name on it\',\'Calculator\',now(),3,\'236a\',\'Brian Valzovano\',null,\'lost\'), ';
          $query .= '(\'Alienware with OpenDaylight and ADVA stickers \',\'laptop\',now(),1,\'2020\',\'Rob Rizzacasa\',null,\'lost\'), ';
          $query .= '(\'Orange Razor scooter\',\'Scooter\',now(),1,\'0018\',null,\'Junaid Kapadia\',\'found\') ';
          $query .= ';';
          $results = mysqli_query($dbc,$query);
        check_results($dbc, $results);
        }
    }
    else
    {
    # If we get here, populate the table
    $query = 'insert into inventory(description, object, date_found, location_id, room, owner, finder, status) values ';
    $query .= '(\'Black, crack in the top right corner\',\'iPhone 4s\',now(),1,\'0004\',\'Zack Meath\',null,\'lost\'), ';
    $query .= '(\'Wireless, white\',\'Xbox 360 Controller\',now(),8,\'Ground Floor\',null,\'Aaron Kippins\',\'found\'), ';
    $query .= '(\'Marist lanyard\',\'Keys\',now(),13,null,null,\'Ron Coleman\',\'found\'), ';
    $query .= '(\'Blue, says my name on it\',\'Calculator\',now(),3,\'236a\',\'Brian Valzovano\',null,\'lost\'), ';
    $query .= '(\'Alienware with OpenDaylight and ADVA stickers \',\'laptop\',now(),1,\'2020\',\'Rob Rizzacasa\',null,\'lost\'), ';
    $query .= '(\'Orange Razor scooter\',\'Scooter\',now(),1,\'0018\',null,\'Junaid Kapadia\',\'found\') ';
    $query .= ';';
    $results = mysqli_query($dbc,$query);
    check_results($dbc, $results);
    }
    $query  = 'CREATE TABLE IF NOT EXISTS users ';
    $query .= '( user_id INT AUTO_INCREMENT PRIMARY KEY, ';
    $query .= '  username char(20) not null,';
    $query .= '  pass char(40) not null );';
    $results = mysqli_query($dbc,$query);
    check_results($dbc, $results);

    # Check if table is already populated
    $query = 'SELECT COUNT(*) FROM users';
    $results = mysqli_query($dbc,$query);
    check_results($dbc, $results);

    if($results) {
        $row = mysqli_fetch_array($results, MYSQLI_NUM);

        if($row[0] > 0){}
        else
        { 
          $query = 'insert into users(username, pass) values (\'admin\',\'gaze11e\');';
          $results = mysqli_query($dbc,$query);
          check_results($dbc, $results);
        }
    }
    else
    {
    # If we get here, populate the table
    $query = 'insert into users(username, pass) values (\'admin\',\'gaze11e\');';
    show_query($query);
    $results = mysqli_query($dbc,$query);
    check_results($dbc, $results);
    }
}


function show_record($dbc, $item_id) {
  # Create a query to get the name and price sorted by price
  $query = 'SELECT * FROM inventory WHERE item_id = ' . $item_id ;

  # Execute the query
  $results = mysqli_query( $dbc , $query ) ;
  check_results($dbc, $results) ;

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
function show_admins($dbc)
{
  $query = 'select user_id, username, pass from users';
  $results = mysqli_query( $dbc , $query ) ;
  check_results($dbc, $results) ;
  if( $results )
  {
      # But...wait until we know the query succeed before
      # rendering the table start.
      echo '<H2>Select an admin to change password</H2>' ;
      echo '<TABLE border=1 cellpadding=10>';
      echo '<tr><th>Username</th><th>Click to Delete</th></tr>';

      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        echo '<TR>' ;
        echo '<TD><a href="pass_admin.php?id='.$row['user_id'] . '">' . $row['username'] . '</a></TD>' ;
        echo '<TD><a href="delete_admin.php?id='.$row['user_id'] . '">' . 'Delete' . '</a></TD>' ;
        echo '</TR>' ;
      }

      # End the table
      echo '</TABLE>';

      # Free up the results in memory
      mysqli_free_result( $results ) ;
  }
}
function show_link_records($dbc, $status) {
  # Create a query to get the name and price sorted by price
  $query = 'SELECT item_id, object, description, owner, finder, date_found, location_name, room, status FROM inventory as i inner join locations as l on i.location_id = l.location_id' ;
  if ($status == 'all')
  {
    $query .= ' WHERE (status="lost") or (status="found")';
  }
  elseif ($status == 'found'){
    $query .= ' WHERE status="found" ';
  }
  elseif ($status == 'lost')
  {
    $query .= ' WHERE status="lost" ';
  }
  
  $query .= ' ORDER BY item_id ASC';

  # Execute the query
  $results = mysqli_query( $dbc , $query ) ;
  check_results($dbc, $results) ;

  # Show results
  if( $results )
  {
      # But...wait until we know the query succeed before
      # rendering the table start.
      echo '<H2>These Are The Latest Entries Into Our Database</H2>' ;
      echo '<TABLE border=1 cellpadding=5>';
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

      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        $alink = '<A HREF=inventory.php?item_id=' . $row['item_id'] . '>' . $row['item_id'] . '</A>' ;
        echo '<TR>' ;
        echo '<TD align=right>' . $alink . '</TD>' ;
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
  check_results($dbc, $results) ;

  return $results ;
}

# Shows the query as a debugging aid
function show_query($query) {
  global $debug;

  if($debug)
    echo "<p>Query = $query</p>" ;
}

# Checks the query results as a debugging aid
function check_results($dbc, $results) {
  #global $dbc;

  if($results != true){
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
  }
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
  $query = 'SELECT item_id, object, description, owner, finder, date_found, location_name, room, status FROM inventory as i inner join locations as l on i.location_id = l.location_id ORDER BY item_id ASC' ;

  # Execute the query
  $results = mysqli_query( $dbc , $query ) ;
  check_results($dbc, $results) ;

  # Show results
  if( $results )
  {
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
      echo '<TH>Change Status</TH>';
      echo '<TH>Delete</TH>';
      echo '</TR>';

      # For each row result, generate a table row
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        $alink = '<A HREF=admin.php?item_id=' . $row['item_id'] . '>' . $row['item_id'] . '</A>' ;
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
        echo '<TD><a href="changestatus.php?item_id='. $row['item_id'] . '">Change Status</a></TD>' ;
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
  check_results($dbc, $results) ;

  # Show results
  if( $results )
    {
      $x=0;
      while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
      {
        $x = $x + 1;
      }
      if ($x<1)
      {
        echo 'Username or password is incorrect, please try again';
        return false;
      }
      else if ($x>1)
        {
          echo 'There are multiple entries with the same credentials in the database, please contact the database administrator';
          return false;
        }
      else
      {
        return true;
      }
    }
  
}
?>