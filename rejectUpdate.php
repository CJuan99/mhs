<?php
include("conDb.php");

$applicationID = $_REQUEST["applicationID"];

$sql_update = "UPDATE application SET status ='Rejected' WHERE applicationID = '$applicationID'";
echo $conn->query($sql_update);


?>