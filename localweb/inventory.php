<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Limbo</title>
<!--Aaron Kippins & Zack Meath-->
</head>
<body>

<?php 
# Includes these helper functions
require('helpers.php');
$dbc = init('limbo_db');
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
      echo '<p>Please input a inventory ID, Object, Date Lost/Found and Place Lost/Found!</p>' ;
	}

show_header();
show_link_records($dbc, 'all');


# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Display body section with sticky form. -->
<!-- <form action="inventory.php" method="POST">
</br>
<table border=1>
	<tr><td><p>Object: </td> <td><input type="text" name="object" value="<?php if (isset($_POST['object'])) echo $_POST['object']; ?>"></p></td></tr>
	<tr><td><p>Description: </td> <td><input type="text" name="description" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>"></p></td></tr>
	<tr><td><p>Room: </td> <td><input type="text" name="room" value="<?php if (isset($_POST['room'])) echo $_POST['room']; ?>"></p></td></tr>
	<tr><td><p>Owner: </td> <td><input type="text" name="owner" value="<?php if (isset($_POST['owner'])) echo $_POST['owner']; ?>"></p></td></tr>
	<tr><td><p>Finder: </td> <td><input type="text" name="finder" value="<?php if (isset($_POST['finder'])) echo $_POST['finder']; ?>"></p></td></tr>
	<tr><td><p>Date Lost/Found: </td> <td><input type="date" name="date_found" value="<?php if (isset($_POST['date_found'])) echo $_POST['date_found']; ?>"></p></td></tr>
	<tr><td><p>Place Lost/Found: </td> <td><select required=1 name='location_id'>
									  	<option value="">Select the location that the item was found</option>
									  	<option value="1">Hancock Center</option>
									  	<option value="2">Dyson Center</option>
									  	<option value="3">Donnelly Hall</option>
									  	<option value="4">Lowell Thomas</option>
									  	<option value="5">Fontaine Hall</option>
									  	<option value="6">Fontaine Annex</option>
									  	<option value="7">Library</option>
									  	<option value="8">Leo Hall</option>
									  	<option value="9">Champagnat Hall</option>
									  	<option value="10">Sheahan Hall</option>
									  	<option value="11">Marian Hall</option>
									  	<option value="12">Bryne House</option>
									  	<option value="13">Our Lady Seat Of Wisdom Chapel</option>
									  	<option value="14">Cornell Boathouse</option>
									  	<option value="15">Fern Tor</option>
									  	<option value="16">Foy Townhouses</option>
									  	<option value="17">Fulton Street Townhouses</option>
									  	<option value="18">New Fulton Townhouses</option>
									  	<option value="19">Gartland Commons</option>
									  	<option value="20">Greystone Hall</option>
									  	<option value="21">Kieran Gatehouse</option>
									  	<option value="22">Kirk House</option>
									  	<option value="23">Longview Park</option>
									  	<option value="24">Lower Townhouses</option>
									  	<option value="25">Marist Boathouse</option>
									  	<option value="26">McCann Center</option>
									  	<option value="27">Midrise Hall</option>
									  	<option value="28">New Townhouses</option>
									  	<option value="29">St.Anns Hermitage</option>
									  	<option value="30">St.Peters</option>
									  	<option value="31">Steel Plant Art Studios</option>
									  	<option value="32">Rotunda</option>
									  	<option value="33">Tenney Stadium</option>
									  	<option value="34">Tennis Pavilion</option>
									  	<option value="35">Lower West Cedar Townhouses</option>
									  	<option value="36">Upper West Cedar Townhouses</option>
									  </select>
									</p></td></tr>
	<tr><td><p>Status:</td> <td><select required=1 name='status'>
									<option value="">Select the status of the item</option>
									<option value="found">Found</option>
									<option value="lost">Lost</option>
									<option value="claimed">Claimed</option>
								</select></p></td></tr>
</table>
<p><input type="submit"></p>
</form> -->

</html>