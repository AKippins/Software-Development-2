<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.
By Aaron Kippins
-->
<!DOCTYPE html>
<html>
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

<!-- Get inputs from the user. -->
<form action="vipresidents.php" method="POST">
<table>
<tr>
<td>Number:</td><td><input type="text" name="number"></td>
</tr>
<tr>
<td>First Name:</td><td><input type="text" name="fname"></td>
</tr>
<tr>
<td>Last Name:</td><td><input type="text" name="lname"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>