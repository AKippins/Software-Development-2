<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PHP Sticky Form</title>
<!--Aaron Kippins & Zack Meath-->
</head>
<body>

<?php 
# Connect to MySQL server and the database
require( 'limbo_alpha/connect_db.php' ) ;

# Includes these helper functions
require( 'limbo_alpha/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	#$item_id = $_POST['item_id'] ;

    $object = $_POST['object'] ;
	
	$description = $_POST['description'] ;

	$room = $_POST['room'] ;

	$owner = $_POST['owner'] ;

	$finder = $_POST['finder'] ;

	$date_found = $_POST['date_found'] ;

	$location_id = $_POST['location_id'] ;

	$status = $_POST['status'] ;
	

    if (!valid_name($object)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Object!!!</p>';
		}
	else if (!valid_name($date_found)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Date!!!</p>';
		}
	else if (!valid_number($location_id)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Place!!!</p>';
		}
	else
	  $result = insert_record($dbc, $object, $description, $room, $owner, $finder, $date_found, $location_id, $status) ;

      #echo "<p>Added " . $result . " new print(s) ". $name . " @ $" . $price . " .</p>" ;
    
	}
	else if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if(isset($_GET['item_id']))
		{
			show_record($dbc, $_GET['item_id']);
		}
	}
	else{
      echo '<p>Please input a inventory ID, Object, Date Found and Place Found!</p>' ;
	}

echo '<h1>Welcome To Limbo</h1>';
echo '<h3>Whether you\'ve lost or found something, You\'re in the right place!!!</h3>';

# Show the records
show_link_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Display body section with sticky form. -->
<form action="inventory.php" method="POST">
</br>
<table border=1>
	<tr><td><p>Object: </td> <td><input type="text" name="object" value="<?php if (isset($_POST['object'])) echo $_POST['object']; ?>"></p></td></tr>
	<tr><td><p>Description: </td> <td><input type="text" name="description" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>"></p></td></tr>
	<tr><td><p>Room: </td> <td><input type="text" name="room" value="<?php if (isset($_POST['room'])) echo $_POST['room']; ?>"></p></td></tr>
	<tr><td><p>Owner: </td> <td><input type="text" name="owner" value="<?php if (isset($_POST['owner'])) echo $_POST['owner']; ?>"></p></td></tr>
	<tr><td><p>Finder: </td> <td><input type="text" name="finder" value="<?php if (isset($_POST['finder'])) echo $_POST['finder']; ?>"></p></td></tr>
	<tr><td><p>Date Found: </td> <td><input type="date" name="date_found" value="<?php if (isset($_POST['date_found'])) echo $_POST['date_found']; ?>"></p></td></tr>
	<tr><td><p>Place Found: </td> <td>
									<?php 
										# Connect to MySQL server and the database
										require( 'limbo_alpha/connect_db.php' ) ;

										$query = 'SELECT location_id, location_name FROM locations ORDER BY location_id DESC' ;

										# Execute the query
										$results = mysqli_query( $dbc , $query ) ;
										check_results($results) ;

										if($results){
											echo '<select required=1 name="location_id">';
											while ( $choice = mysql_fetch_array( $results, MYSQLI_ASSOC)) {
												echo '<option value="' . $choice['location_id'] . '">' . $choice['location_name'] . '</option>';
											}

											echo '</select>';

											# Free up the results in memory
										  	mysqli_free_result( $results ) ;

										}

										# Checks the query results as a debugging aid
										function check_results($results) {
										  global $dbc;

										  if($results != true)
										    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
									?>
									</p></td></tr>
	<tr><td><p>Status:</td> <td><select required=1 name='status'>
									<option value="">Select the status of the item</option>
									<option value="'found'">Found</option>
									<option value="'lost'">Lost</option>
									<option value="'claimed'">Claimed</option>
								</select>
</table>
<p><input type="submit"></p>
</form>

</html>