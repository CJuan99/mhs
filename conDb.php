<?php

$conn = new mysqli("localhost", "root","", "mhsdb");
if ( $conn->connect_error) {
	die ("Connection failure" );
	
echo ("Connect successfully");
}
 
 ?>