<?php

session_start();
include("conDb.php");

$username =$_SESSION['user'];

$applicantID=$_SESSION["applicantID"];

$sql = "SELECT fullname FROM user WHERE username ='$username'";
$resultset = mysqli_query($conn, $sql);
$userRecord = mysqli_fetch_assoc($resultset);


$qry= "SELECT email, monthlyIncome FROM applicant WHERE applicantID='$applicantID'";
$result=  mysqli_query($conn, $qry);
$applicantRecord = mysqli_fetch_assoc($result);

$sql2 = "SELECT residenceID, residenceName, address, numUnits, sizePerUnit, monthlyRental FROM residence ";
$residenceRecord=mysqli_query($conn, $sql2);

if(isset($_GET['residenceID'])){
	$resID= $_GET['residenceID'];
	$_SESSION['residence1ID']=$resID;
}

if(isset($_GET['residenceName'])){
	$resName= $_GET['residenceName']; 
	$_SESSION['residenceName']= $resName;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="CSS/stylesheetCJ.css">
  <title>Submit Application</title>

</head>

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-expand-lg navbar-light fixed-top pt-2">
  <div class="container">
    <button type="button" class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navBarUser" aria-controls="navBarUser" aria-expanded="false" aria-label="Toggle navigation">
      <i class="icon fa fa-user"></i>
    </button>
    <a class="navbar-brand js-scroll-trigger" href="index.php" id="logo">MHS2u</a>
    <button type="button" class="navbar-toggler navbar-toggler-left" data-toggle="collapse" data-target="#navBarResponsive" aria-controls="navBarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <i class="icon fas fa-bars fa-1x"></i>
    </button>

    <div class="collapse navbar-collapse" id="navBarResponsive">
      <ul class="navbar-nav ml-3  my-lg-0 ">
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger " href="index.php#about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="index.php#residence">Residence</a>
        </li>
        <li class="nav-item">
          <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact Us</a>
        </li>
      </ul>

    </div>
    <div class="collapse navbar-collapse" id="navBarUser">
      <ul class="nav navbar-nav ml-auto my-2 my-lg-0 ">
    
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href=""><span class="fa fa-user mx-3" aria-hidden="true"></span><?php echo $_SESSION['user']; ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="logout.php"><span class="fas fa-sign-out-alt mx-3" aria-hidden="true"></span>Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<header class="headerApp">
  <div class="container h-100">
    <div class="row h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-10 align-self-end ">
        <h1 class="text-uppercase text-white">Apply Now</h1>
      </div>
    </div>
  </div>
</header>

<!--<script>
window.onload = function () {
    var url = document.location.href,
        params = url.split('?')[1].split('&'),
        data = {}, tmp;
    for (var i = 0, l = params.length; i < l; i++) {
         tmp = params[i].split('=');
         data[tmp[0]] = tmp[1];
    }
    document.getElementById('here').innerHTML = data.res;
}
</script>-->

  <div class="container  py-5 my-5 ">
      <form action="application.php" method="POST" onsubmit="applyValidate()" class="form-container" id="form1">
        <div class="mb-3 py-3 bg-warning" id="title">
          <h1 class=" text-center">Application form</h1>
        </div>
        <div class="form-group row  px-3">
          <label for="staticFullName" class="col-sm-4 col-form-label ">Full Name</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="fullname" name="fullname" value="<?php echo  $userRecord['fullname'];?>">
          </div>
        </div>
        <div class="form-group row  px-3">
          <label for="staticEmail" class="col-sm-4 col-form-label">Email</label>
          <div class="col-sm-8">
            <input type="text" readonly class="form-control-plaintext" id="email" name="email" value="<?php echo  $applicantRecord['email'];?>">
          </div>
        </div>
        <div class="form-group row  px-3">
          <label for="monthlyIncome" class="col-sm-4 col-form-label">Monthly Income</label>
          <div class="col-sm-8">
          <input type="text" readonly class="form-control-plaintext" id="monthlyIncome" name="monthlyIncome" value="<?php echo  "RM ".$applicantRecord['monthlyIncome'];?>">
          </div>
        </div>
        <div class="form-group row py-2 px-3">
          <label for="residence1" class="col-sm-4 col-form-label">Residence 1</label>
          <div class="col-sm-8 ">
			 <input type="text" readonly class="form-control-plaintext" id="residence1" name="residence1" value="<?php echo $resName; ?>">
          </div>
        </div>

		 <div class="form-group row py-2 px-3">
          <label for="residene2" class="col-sm-4 col-form-label">Residence 2</label>
          <div class="col-sm-8">
			<select name="resTwo" class="form-control py-2 w-100">
				<option disabled="disabled" selected="selected" value="">Choose option </option>
					<?php while($row=mysqli_fetch_array($residenceRecord)) { ?>
						<?php if($row['residenceID']!=$resID){?>
						<?php if($row['numUnits'] != 0){?>
							<?php
								echo "<option value='". $row['residenceID']."'>" . $row['residenceID']. ", ".$row['residenceName']. ", ".$row['address'].'</option>'; ?>
							<?php } ?>
						<?php }  ?>
					<?php } ?>
			</select>
          </div>
        </div>
		
		<!--<div class="form-group row py-2 px-3">
          <label for="residene2" class="col-sm-4 col-form-label">Duration</label>
          <div class="col-sm-8">
			<select name="duration" id="duration" class="form-control py-2 w-100">';?>
				<option disabled="disabled" selected="selected" value="">Choose option </option>
				<option selected="selected" value="12">12 Months </option>
				<option selected="selected" value="18">18 Months </option>
			</select>
          </div>
        </div>-->
		
		
		
        <div class="form-group row py-2 px-3">
        <label for="requiredmonth" class="col-sm-4 col-form-label ">Required Month and Year</label>
        <div class="col-sm-8 ">
          <input type="date" name="requiredmonth_year" id="requiredmonth" class="form-control py-2 ">
        </div>
      </div>
      <div class="text-center pt-4">
        <button class="btn btn-danger py-3 px-5 text-uppercase " id="btnsubmit" name="btnsubmit" type="submit" value="Submit" onclick="resetFunction()">Submit</button>
      </div>
    </form>
  </div>


<footer style="background-color: #2c292f">
  <div class="container ">
    <div class="row ">
      <div class="col-md-4 text-center text-md-left ">
        <div class="py-0">
          <h3 class="my-4 font-weight-bold" id="logo">MHS2u</h3>

          <p class="flinks font-weight-bold">
            <a class="text-white " href="index.php">Home</a>
            |
            <a class="text-white" href="index.php#about">About</a>
            |
            <a class="text-white" href="index.php#residence">Residences</a>
            |
            <a class="text-white" href="index.php#contact">Contact Us</a>
          </p>
        </div>
      </div>

      <div class="col-md-4 text-white text-center text-md-left ">
        <div class="icon py-2 my-4">
          <div>
            <p class="text-white"> <i class="fa fa-map-marker-alt mx-2 "></i>
              KUALA LUMPUR CITY HALL
              Menara DBKL 1, Jalan Raja Laut
              50350 Kuala Lumpur, MALAYSIA</p>
          </div>
          <div>
            <p><i class="fa fa-phone  mx-2 "></i> +03 2617 9000</p>
          </div>
          <div>
            <p><i class="fa fa-envelope  mx-2"></i><a class="text-decoration-none text-white" href="dbkualalumpur@gmail.com">dbkl@dbkl.gov.my</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-4 text-white my-4 text-center text-md-left ">
        <blockquote class="blockquote text-center">
          <p class="font-italic">There is nothing more important than a good, safe, secure home.</p>
          <footer class="blockquote-footer">
            <cite title="Source Title">Unknown</cite>
          </footer>
        </blockquote>
      </div>
    </div>
  </div>
</footer>
<!-- Copyright -->
<div class="col-lg-12 footer-copyright text-center py-2 text-white bg-dark">© 2019 Copyright:
  <a class="text-white" href="#"> MHS2u</a>
</div>
<!-- Footer -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


<script src="js/cj.js"></script>

</html>
