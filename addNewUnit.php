<!DOCTYPE>
<html>
	
	<head>
		<title> Add New Unit </title>
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"
		integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<!---<script src="cj.js"></script>--->
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
		rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
		crossorigin="anonymous">
		<meta charset="utf-8">  
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="CSS/yc.css">
					
	</head>
	<?php
	 session_start();
	 $servername = "localhost";
	 $username = "root";
	 $password = "";
	 $dbname = "mhsdb";
	 $conn = mysqli_connect($servername, $username, $password, $dbname);
	 if(!$conn){
		 die('Not Connected'.mysql_error());
	 }
		// else{
		//	echo"Connected to database".$dbname;
		//}
		
		$sql1 = "SELECT* from residence";
		$results1 = $conn -> query($sql1);
	
	if(isset($_POST['submit']))
	{	 
		 $staffID = $_SESSION["staffID"];
		 $residenceID = $results1->num_rows+1;
		 $residenceName=$_POST['residenceName'];
		 $address=$_POST['address'];
		 $numUnits=$_POST['numUnits'];
		 $sizePerUnit=$_POST['sizePerUnit'];
		 $monthlyRental=$_POST['monthlyRental'];
		 
		$target = "images/".basename($_FILES["image"]["name"]);
		 $image=$_FILES["image"]["name"];
		 
		 $sql = "INSERT INTO residence(residenceID,residenceName,address,numUnits,sizePerUnit,monthlyRental,image,staffID)
		 VALUES ('$residenceID','$residenceName','$address','$numUnits','$sizePerUnit','$monthlyRental','$image','$staffID')";
		 
		//  $sql = "INSERT INTO residence(residenceID,residenceName,address,numUnits,sizePerUnit,monthlyRental,staffID)
		// VALUES ('$residenceID','$residenceName','$address','$numUnits','$sizePerUnit','$monthlyRental','$staffID')";
		 // header('location:addNewUnit.php');
		 
		 mysqli_query($conn,$sql);
		 
		if(move_uploaded_file($_FILES["image"]["tmp_name"],$target)){
			echo "";}
		 else{
			 echo"There is a problem to upload a image";
		 }
		 $sql2 = "SELECT * from unit";
		 $results2 = $conn -> query($sql2);
		 
		 for ($x = 1; $x <= $numUnits; $x++) {
			 
			$rows = $results2->num_rows+$x;
			$sqlAdd = "INSERT INTO unit (unitNo,availability,residenceID)
			VALUES ('$rows',1,'$residenceID')";
			mysqli_query($conn,$sqlAdd);
			//echo $x;
			//echo $conn->error;
			}
		
		 $conn->error;	
		/*if($conn->query($sql)){
			echo " Residence registered successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}*/
		unset($_POST);
	}
	

?>
	<body class="color">
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
						<a class="nav-link js-scroll-trigger" href="index.php#residence">Residence</a>
						</li>
						<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="index.php#contact">Contact Us</a>
						</li>
						<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="viewApp_Officer.php">View Application</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="addNewUnit.php">Add residence</a>
					  </li>
						</ul>
					</div>
		<div class="collapse navbar-collapse" id="navBarUser">
		  <ul class="nav navbar-nav ml-auto my-2 my-lg-0 ">
		  <!--  <li class="nav-item">
			  <a class="nav-link js-scroll-trigger" href="#" data-toggle="modal" data-target="#login">
			  <span class="fa fa-lock mx-3" aria-hidden="true"></span>Login</a>
			</li>-->
			<li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#"><span class="fa fa-user mx-3" aria-hidden="true"></span>User1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="logout.php"><span class="fas fa-sign-out-alt mx-3" aria-hidden="true"></span>Logout</a>
            </li>
		  </ul>
		</div>
		</div>
		</nav>
	<!---navigation-->
		<img src="images/Residence.jpg" class="container-fluid p-0" alt="Residence">
			<div class="container my-3">
				<div class = "row">
				<div class="container py-5 my-5 ">
				<form method="POST" action="addNewUnit.php" enctype="multipart/form-data">
					<div class="mb-3 py-3" id="title">
						<h1 class=" text-center">Add New Residence</h1>
					</div>
							<div class="form-group">
								<label for="unitType">Residence Name:</label>
								<input type="text" class="form-control" id="residenceName" name="residenceName" placeholder="Residence Name" required>
							</div>
							<div class="form-group">
								<label for="location">Address:</label>
								<input type="text" class="form-control" id="address" name="address" placeholder="Location" required>
							</div>
							<div class="form-group">
								<label for="unitAvailable">Unit Available:</label>
								<input type="text" class="form-control" id="numUnits" name="numUnits" placeholder="Unit Available" required>
							</div>
							<div class="form-group">
								<label for="unitSize">Unit Size:</label>
								<input type="text" class="form-control" id="sizePerUnit" name="sizePerUnit"  placeholder="Unit Size" required>
							</div>
							<div class="form-group">
								<label for="rental">Monthly rental:</label>
								<input type="text" class="form-control" id="monthlyRental" name="monthlyRental" placeholder="Rental" required>
							</div>
							<div class="form-group">
								<label for="rental">Image:</label>
								<input type="file" class="form-control" id="image" name="image" placeholder="image" required>
							</div>
							
							<br><br>
						<div class="col text-center">
							<button type="submit" class="btn btn-primary btn-lg btnWidth" value="submit" name="submit" onclick="addRow();clearTextBox();">Add</button><br><br>
							<!---<button class="btn btn-danger btn-lg btnWidth" onclick="closeForm()">Close</button> -->
						</div>
					</div>
				</form>
				</div>
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
			<br>
			<!---<div class="row">
				<div class="col-lg-2 offset-lg-5">
					<input class="btn btn-primary btn-block" type="button" name="new" value="New" onclick="openForm()">
				</div>
			</div> -->
			
			
		</div>
			
	
	</body>
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
							<p><i class="fa fa-envelope  mx-2"></i><a class="text-decoration-none text-white" 
							href="dbkualalumpur@gmail.com">dbkl@dbkl.gov.my</a></p>
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
	<div class="footer-copyright text-center py-2 text-white bg-dark">© 2019 Copyright:
		<a class="text-white" href="#"> MHS2u</a>
	</div>
	</footer>

</html>
<script src="yc.js"></script>