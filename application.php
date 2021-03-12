<?php

include("conDb.php");
session_start();

$sql="SELECT * FROM application";
$applyRecord=$conn->query($sql);


if(isset($_POST["btnsubmit"])){
	
	$applicant=$_SESSION["applicantID"] ;
	$fullname= $_POST['fullname'];
	$email= $_POST['email'];
	$monthlyIncome= $_POST['monthlyIncome'];
	$residence1=$_SESSION['residence1ID'];
	$residence1name=$_SESSION['residenceName'];
	$residence2=$_POST['resTwo'];
	$test=strtotime($_POST['requiredmonth_year']);

    $date=date('d',$test);
    $month=date('m',$test);
    $year=date('Y',$test);
	echo$residence2;
	
	//create applicationID and date
	$applicationID= $applyRecord->num_rows + 1;
	
	$applicationID2= $applyRecord->num_rows + 2;

	$datetime = date('Y-m-d') ;
	

//insert to application 
if(!empty($residence2)){
	
	$sqlApp="INSERT INTO application (applicationID, applicationDate, requiredMonth, requiredYear, status, applicantID, residenceID, favourite, appealed ) 
				VALUES('$applicationID', '$datetime', '$month','$year','New','$applicant','$residence1','false','false'),
				('$applicationID2', '$datetime', '$month','$year','New','$applicant','$residence2','false','false')";
	

	
		
	if($conn->query($sqlApp)){
		echo 'Submitted';
		header('location:viewApplication_Applicant.php');
	}else{
			echo 'Fail';
			echo $conn->error;
		}
		
		
	}else{
		
	$sqlApp="INSERT INTO application (applicationID, applicationDate, requiredMonth, requiredYear, status, applicantID, residenceID, favourite, appealed ) 
				VALUES('$applicationID', '$datetime', '$month','$year','New','$applicant','$residence1','false','false')";
	
		
	
	if(mysqli_query($conn, $sqlApp)){
		echo 'Submitted';
		header('location:viewApplication_Applicant.php');
	}else{
			echo 'Fails';
		}
		
	}
}
	

	

	



?>