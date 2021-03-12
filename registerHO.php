<?php

include("conDb.php");
session_start();

$sqlUsers = "SELECT * FROM user";
$userTable = $conn->query($sqlUsers);
$sqlHO = "SELECT * FROM housingofficer";
$HO_Table = $conn->query($sqlHO);

if(isset($_POST["registerHO_btn"])){
	// attributes for user table
	$userID = $userTable->num_rows + 1;
	$username = $_POST["username"];
	$password = $_POST["password"];
	$fullname = $_POST["fullname"];
	$userType = "HousingOfficer";

	// attributes for housing officer table
	$staffID = $HO_Table->num_rows + 1;


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
		$queryInsertUser = "INSERT INTO user (userID, username, password, fullname, userType) VALUES ('$userID', '$username', '$password','$fullname','$userType')";
		// insert into housing officer table
		$queryInsertHO = "INSERT INTO housingofficer (staffID, userID) VALUES ('$staffID', '$userID')";

	// TODO: Remove later, below commented 2 lines
	    //mysqli_query($conn, $queryInsertUser);
			//mysqli_query($conn, $queryInsertHO);

		//$logged_in_user_id = mysqli_insert_id($db);


		if( $conn->query($queryInsertUser) && $conn->query($queryInsertHO) ){
			header("Location:index.php");
			// $_SESSION['fullname']=$fullname;
			// $_SESSION['userType']='HO';
			//$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
		}
		else
		{
			echo"fail query";
		}
	}

	/*function getUserById($userID){
	global $conn;
	$query = "SELECT * FROM user WHERE id=" . $userID;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}*/
}
?>
