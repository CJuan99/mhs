<?php
include("conDb.php");

$applicationID = $_REQUEST["q"];

$sql_update = "UPDATE application SET status = 'Appeal Pending', appealed = true WHERE applicationID = '$applicationID'";
$conn->query($sql_update);

?>