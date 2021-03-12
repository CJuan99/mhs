<!DOCTYPE>
<html>
<title>Allocation of Unit</title>

<head>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" 
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" 
	integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/yc.css">


</head>
<?php
	Session_start();
	 $servername = "localhost";
	 $username = "root";
	 $password = "";
	 $dbname = "mhsdb";
	 $conn = mysqli_connect($servername, $username, $password, $dbname);
	 
	 $sqlAllocation = "SELECT* from allocation";
	 $resultsAllocate = $conn -> query($sqlAllocation);
	 $applicantID = $_SESSION["applicantID"];
	 $residenceID = $_SESSION["residenceID"];
	 $allocationID = $resultsAllocate -> num_rows+1;
	 
	if(!$conn){
	die("Connection fail :".mysqli_connect_error());}
		/*else{
			echo"Connected to database";
		}*/
		

	if(isset($_POST['submit']))
	{	 
		$sqlCheckUnit = "UPDATE unit SET availability = 0 WHERE availability !=0 AND residenceID = $residenceID LIMIT 1" ;
		$resultsCheckUnit = $conn -> query($sqlCheckUnit);					
			echo "Allocate successfully";
		 
	
		 $test=strtotime($_POST['fromDate']);
		 $fromDate = date('Y-m-d') ;
		 $duration=$_POST['duration'];
		  if($duration == "18 months"){
			$endDate = date('Y-m-d', strtotime("+18 months", strtotime($endDate)));
		  }
		  else{
			$endDate = date('Y-m-d', strtotime("+12 months", strtotime($endDate)));
		  }
		 
		 $sql = "INSERT INTO allocation (allocationID,fromDate,duration,endDate,applicantID,unitNo)
		 VALUES ('$allocationID,'$fromDate','$duration','$endDate','$applicantID','$unitNo',)";
		 if($conn->query($sql)){
			echo " Allocation successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sqlCheckUnit = "UPDATE unit SET availability = 0 WHERE availability !=0 AND residenceID = $residenceID LIMIT 1" ;
		$resultsCheckUnit = $conn -> query($sqlCheckUnit);					
			echo "Allocate successfully";
		 
	}
	?>
<body class="color">
	
	<!-- Navigation -->	
	<nav id="mainNav" class="navbar navbar-expand-lg navbar-light fixed-top pt-2">
	  <div class="container">
	    <button type="button" class="navbar-toggler navbar-toggler-right" data-toggle="collapse" 
		data-target="#navBarUser" aria-controls="navBarUser" aria-expanded="false" aria-label="Toggle navigation">
	      <i class="icon fa fa-user"></i>
	    </button>
	    <a class="navbar-brand js-scroll-trigger" href="#page-top" id="logo">MHS2u</a>
	    <button type="button" class="navbar-toggler navbar-toggler-left" data-toggle="collapse" 
		data-target="#navBarResponsive" aria-controls="navBarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	      <i class="icon fas fa-bars fa-1x"></i>
	    </button>

	    <div class="collapse navbar-collapse" id="navBarResponsive">
	      <ul class="navbar-nav ml-3  my-lg-0 ">
	        <li class="nav-item">
	          <a class="nav-link js-scroll-trigger " href="index.html#about">About</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link js-scroll-trigger" href="index.html#residence">Residence</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link js-scroll-trigger" href="index.html#contact">Contact Us</a>
	        </li>
			<li class="nav-item">
				<a class="nav-link js-scroll-trigger" href="#residence">View Application</a>
			</li>
			<li class="nav-item">
				<a class="nav-link js-scroll-trigger" href="#contact">Add residence</a>
			</li>
	      </ul>

	    </div>
	    <div class="collapse navbar-collapse" id="navBarUser">
	      <ul class="nav navbar-nav ml-auto my-2 my-lg-0 ">
	      <!--  <li class="nav-item">
	          <a class="nav-link js-scroll-trigger" href="#" data-toggle="modal" data-target="#login"> <span class="fa fa-lock mx-3" aria-hidden="true"></span>Login</a>
	        </li>-->
	        <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#"><span class="fa fa-user mx-3" aria-hidden="true"></span>User1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.html"><span class="fas fa-sign-out-alt mx-3" aria-hidden="true"></span>Logout</a>
            </li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<!---navigation-->

	<img src="images/Residence.jpg" class="container-fluid p-0" alt="Residence">
	<div class="container-fluid my-5 mx-2">
		<h3 class="text-center">Allocate Unit </h3>
		<div class="col-lg-10 offset-lg-1 border my-5 pt-4">
			<form>
				<div class="form-group row">
					<label for="residenceID" class="col-sm-2 col-form-label">Residence ID</label>
					<div class="col-sm-10">

					<input list="residenceID" name="residenceID" class="form-control" value="<?php$_SESSION['residenceID']?>" placeholder="ID">
					<!--	<input list="residenceID" name="residenceID" class="form-control" placeholder="ID">
						<!--<datalist id="residenceID">
							<?php/*
									$query = "SELECT residenceID FROM residence";
									$result = mysql_query($query);
									while($rows = mysql_fetch_assoc($result))
									{
									echo "<option value=".$rows['residenceID'] ."/>";
									}*/
									?>
						</datalist> -->
					</div>
				</div>
				<div class="form-group row">
					<label for="fromDate" class="col-sm-2 col-form-label">From Date</label>
					<div class="col-sm-10">
						<input type="date" class="form-control" id="fromDate" placeholder="From Date">
					</div>
				</div>
				<div class="form-group row">
					<label for="Applicant" class="col-sm-2 col-form-label">Applicant</label>
					<div class="col-sm-10">
						<input type="text" name="applicant" class="form-control" value="<?php //$_SESSION['applicant'] ?>">
						<!--<input list="applicant" name="applicant" class="form-control"> -->	
					
					</div>
				</div>
				<div class="form-group row">
					<label for="Duration" class="col-sm-2 col-form-label">Duration</label>

					<div class="col-sm-10">
						<input list="duration" name="duration" class="form-control">
						<datalist id="duration">
							<option value="12 months">
							<option value="18 months">
						</datalist>
					</div>
				</div>

				<div class="form-group row">
					<div class="col text-center">
						<button class="button btn-sm btn-primary mx-4" id="submit" name="submit" onclick="clearTextBox();">Submit</button>
					</div>
				</div>
			</form>
		</div><br><br>
	</div>
	
	<div class="container my-5">
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-md-12">
						<h2>Unit Available</h2>
					</div>
				</div>
				<div class="row">
					<table class="table bg-white table-hover" id="info">
						<thead>
							<tr class="bg-dark text-white">
								<th>Residence ID</th>
								<th>Residence Name</th>
								<th>Location</th>
								<th>Unit Available</th>
								<th>Unit Size</th>
								<th>Rental</th>
							</tr>
						</thead>
						<tbody>
							<?php

								$db ="mhsdb";
								$conn= mysqli_connect("localhost","root","",$db);
								if($conn->connect_error){
									die("Connection failed".$conn->connect_error);
								}
								
								$sql = "SELECT residenceID,residenceName,address,numUnits,sizePerUnit,monthlyRental from residence";
								$results = $conn -> query($sql);
								
								if($results->num_rows > 0){
								while($row = $results->fetch_assoc()){
									$sql_unit = "SELECT * FROM unit WHERE residenceID = ".$row["residenceID"]." AND availability=1";
									$resultss = mysqli_query($conn,$sql_unit);
									$unitAva = $resultss->num_rows;
									
									echo "<tr><td>" . $row["residenceID"]. "</td><td>" . $row["residenceName"] . "</td><td>".$row["address"] . "</td><td>". $unitAva
										."</td><td>". $row["sizePerUnit"]. "</td><td>". $row["monthlyRental"] . "</td></tr>";
								
								}
								}
								?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</body>

<!--footer-->
	<footer>
		<footer style="background-color: #2c292f">
		<div class="container ">
			<div class="row ">
				<div class="col-md-4 text-center text-md-left ">
					<div class="py-0">
						<h3 class="my-4 font-weight-bold" id="logo">MHS2u</h3>

						<p class="flinks font-weight-bold">
							<a class="text-white " href="index.html">Home</a>
							|
							<a class="text-white" href="index.html#about">About</a>
							|
							<a class="text-white" href="index.html#residence">Residences</a>
							|
							<a class="text-white" href="index.html#contact">Contact Us</a>
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
		<!--</div> -->
	
	<!-- Copyright -->
	<div class="footer-copyright text-center py-2 text-white bg-dark">© 2019 Copyright:
		<a class="text-white" href="#"> MHS2u</a>
	</div>
	</footer>
</footer>
</html>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="js/yc.js"></script>