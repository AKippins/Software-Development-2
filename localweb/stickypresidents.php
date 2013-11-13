<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>PHP Sticky Form</title>
</head>
<body>

<?php 
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$number = $_POST['number'] ;

    $fname = $_POST['fname'] ;
	
	$lname = $_POST['lname'] ;
	

    if(!valid_number($number)) {
		echo '<p style="color:red;font-size:16px;">The number that you have entered is not a number!!!</p>';
		}
	else if (!valid_name($fname)){
		echo '<p style="color:red;font-size:16px;">That is not a valid first name!!!</p>';
		}
	else if (!valid_name($lname)){
		echo '<p style="color:red;font-size:16px;">That is not a valid last name!!!</p>';
		}
	else
	  $result = insert_record($dbc, $number, $fname, $lname) ;

      #echo "<p>Added " . $result . " new print(s) ". $name . " @ $" . $price . " .</p>" ;
    
	}
	else{
      echo '<p>Please input a president number, first name, and last name!</p>' ;
	}


# Show the records
show_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Display body section with sticky form. -->
<form action="stickypresidents.php" method="POST">
<p>Number: <input type="text" name="number" value="<?php if (isset($_POST['number'])) echo $_POST['number']; ?>"> </p>
<p>First Name: <input type="text" name="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"></p>
<p>Last Name: <input type="text" name="lname" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"></p>
<p><input type="submit"></p>
</form>

</html>
