<?php
include("conDb.php");

$residenceID = $_REQUEST["rID"];




$sql_residence = "SELECT * FROM residence WHERE residenceID = '$residenceID'";
$result_residence = $conn->query($sql_residence);
$row_residence = $result_residence->fetch_assoc();
$monthlyRental = $row_residence["monthlyRental"];

$sql_unitAva = "SELECT * FROM unit WHERE residenceID = '$residenceID' AND availability=1";
$result_unitAva = $conn->query($sql_unitAva);
$unitsAvailable = $result_unitAva->num_rows;

$res_array = array($residenceID, $unitsAvailable, $monthlyRental);




$apps_array = array();

$sql_apps = "SELECT * FROM application WHERE residenceID = '$residenceID'";
$results = $conn->query($sql_apps);

if($results->num_rows > 0){
    while($row = $results->fetch_assoc()){
        $applicantID = $row["applicantID"];
        $sql_applicant = "SELECT * FROM applicant WHERE applicantID = '$applicantID'";
        $result = $conn->query($sql_applicant);
        $row2 = $result->fetch_assoc();
        
        $userID = $row2["userID"];
        $sql_user = "SELECT * FROM user WHERE userID = '$userID'";
        $result2 = $conn->query($sql_user);
        $row3 = $result2->fetch_assoc();
        
        $fullname = $row3["fullname"];
        $monthlyIncome = $row2["monthlyIncome"];
        $month = $row["requiredMonth"];
        $year = $row["requiredYear"];
        $status = $row["status"];
        $applicationID = $row["applicationID"];
        
        $array = array($fullname, $monthlyIncome, $month, $year, $status, $applicationID);
        array_push($apps_array, $array);

    }
}

$twoArray = array($res_array, $apps_array);

echo json_encode($twoArray);

?>