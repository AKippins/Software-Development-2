<?php #connect to limbo_db

#setting a variable to connect to the database limbo_db with the proper login constraints
$dbc = @mysqli_connect("localhost", 'root', '', 'limbo_db')

# Otherwise fail gracefully and explain the error. 
OR die ( mysqli_connect_error() ) ;

# Set encoding to match PHP script encoding.
mysqli_set_charset( $dbc, 'utf8' ) ;