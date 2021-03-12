<?php
include("conDb.php");

$applicationID = $_REQUEST["appID"];
$favourite = $_REQUEST["s"];

if($favourite=="true"){
    $favourite = true;
}else{
    $favourite = false;
}


$sql_update = "UPDATE application SET favourite = '$favourite' WHERE applicationID='$applicationID'";
$conn->query($sql_update);

?>