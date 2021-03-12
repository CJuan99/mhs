<?php

include("conDb.php");
session_start();

$sqlUsers = "SELECT * FROM user";
$userTable = $conn->query($sqlUsers);
$sqlApplicants = "SELECT * FROM applicant";
$applicantTable = $conn->query($sqlApplicants);

if(isset($_POST["registerApplicant_btn"])){
// attributes for user table
$userID = $userTable->num_rows + 1;
$username = $_POST["username"];
$password = $_POST["password"];
$fullname = $_POST["fullname"];
$userType = "Applicant";

// attributes for applicant table
$applicantID = $applicantTable->num_rows + 1;
$email = $_POST["email"];
$monthlyIncome = $_POST["monthlyIncome"];
$paySlip = $_FILES["paySlip"];


$query = "SELECT * FROM user;";
$results = $conn->query($query);

$userExist = false;
if($results->num_rows > 0){
	while($row = $results->fetch_assoc()){
		if($username == $row["username"]){
			$userExist = true;
		}
	}
}

if($userExist){
	echo '<script type="text/javascript">window.alert("User already exist. Please try again.");';
	echo 'window.location.href="index.php";</script>'; //instead header(); because unable to alert
}else{

	$password=md5($password);
	// insert into user table
	$queryInsertUser = "INSERT INTO user (userID, username, password, fullname, userType) VALUES ('$userID', '$username', '$password', '$fullname', '$userType')";
	// insert into applicant table
	$queryInsertApplicant = "INSERT INTO applicant (applicantID, email, monthlyIncome, userID) VALUES ('$applicantID', '$email', '$monthlyIncome', '$userID')";

// TODO: Remove later, below commented 2 lines
	//mysqli_query($conn, $queryInsertUser);
	//mysqli_query($conn, $queryInsertApplicant);

	if( $conn->query($queryInsertUser) && $conn->query($queryInsertApplicant) ){
		header("Location:index.php");
		//$_SESSION['fullname']=$fullname;
		//$_SESSION['userType']='applicant';
	}
	else{
		echo"fail query";
	}
}

}
?>
