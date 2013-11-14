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
	$item_id = $_POST['item_id'] ;

    $object = $_POST['object'] ;
	
	$description = $_POST['description'] ;

	$size = $_POST['size'] ;

	$color = $_POST['color'] ;

	$weight = $_POST['weight'] ;

	$date_found = $_POST['date_found'] ;

	$place_found = $_POST['place_found'] ;
	

    if(!valid_number($item_id)) {
		echo '<p style="color:red;font-size:16px;">The item_id that you have entered is not a item_id!!!</p>';
		}
	else if (!valid_name($object)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Object!!!</p>';
		}
	else if (!valid_name($description)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Description!!!</p>';
		}
	else if (!valid_name($size)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Size!!!</p>';
		}
	else if (!valid_name($color)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Color!!!</p>';
		}
	else if (!valid_name($weight)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Weight!!!</p>';
		}
	else if (!valid_name($date_found)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Date!!!</p>';
		}
	else if (!valid_name($place_found)){
		echo '<p style="color:red;font-size:16px;">That is not a valid Place!!!</p>';
		}
	else
	  $result = insert_record($dbc, $item_id, $object, $description, $size, $color, $weight, $date_found, $place_found) ;

      #echo "<p>Added " . $result . " new print(s) ". $name . " @ $" . $price . " .</p>" ;
    
	}
	else if ($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		if(isset($_GET['id']))
		{
			show_record($dbc, $_GET['id']);
		}
	}
	else{
      echo '<p>Please input a inventory ID, Object, Date Found and Place Found!</p>' ;
	}


# Show the records
show_link_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Display body section with sticky form. -->
<form action="inventory.php" method="POST">
<p>Item ID: <input type="int" name="item_id" value="<?php if (isset($_POST['item_id'])) echo $_POST['item_id']; ?>"> </p>
<p>Object: <input type="text" name="object" value="<?php if (isset($_POST['object'])) echo $_POST['object']; ?>"></p>
<p>Description: <input type="text" name="description" value="<?php if (isset($_POST['description'])) echo $_POST['description']; ?>"></p>
<p>Size: <input type="text" name="size" value="<?php if (isset($_POST['size'])) echo $_POST['size']; ?>"></p>
<p>Color: <input type="text" name="color" value="<?php if (isset($_POST['color'])) echo $_POST['color']; ?>"></p>
<p>Weight: <input type="text" name="weight" value="<?php if (isset($_POST['weight'])) echo $_POST['weight']; ?>"></p>
<p>Date Found: <input type="date" name="date_found" value="<?php if (isset($_POST['date_found'])) echo $_POST['date_found']; ?>"></p>
<p>Place Found: <input type="text" name="place_found" value="<?php if (isset($_POST['place_found'])) echo $_POST['description']; ?>"></p>
<p><input type="submit"></p>
</form>

</html>
