<?php

include("conDb.php");
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$password = md5($password);

$sql = "select * from user where username = '$username' and password = '$password'";


$result = $conn->query($sql);
if($result->num_rows > 0){

    $values = $result->fetch_assoc();
    $userID = $values["userID"];

    $_SESSION["userID"] = $userID;
    $_SESSION["user"] = $username;
    $_SESSION["fullName"] = $fullname;

    if($values["userType"] == "Applicant"){ // Check user type
        $sql_applicant = "select applicantID from applicant where userID = '$userID'";
        $result_applicant = $conn->query($sql_applicant);
        $row = $result_applicant->fetch_assoc();
        $applicantID = $row["applicantID"];

        $_SESSION["applicantID"] = $applicantID;
        $_SESSION["userType"]=$values["userType"];

        header('location:index.php');
    }else{
        $sql_ho = "select staffID from housingofficer where userID = '$userID'";
        $result_ho = $conn->query($sql_ho);
        $row = $result_ho->fetch_assoc();
        $staffID = $row["staffID"];

        $_SESSION["staffID"] = $staffID;
       $_SESSION["userType"]=$values["userType"];

        header('location:index.php');
    }
}else{
    echo '<script type="text/javascript">window.alert("Incorrect username or password. Please try again.");';
    echo 'window.location.href="index.php";</script>'; //instead header(); because unable to alert
}

$conn->close();


?>
