<?php

session_start();
include("conDb.php");

//$user_id = $userID;
$sql = "SELECT residenceID, residenceName, address, numUnits, sizePerUnit, monthlyRental, image FROM residence";
$result = $conn->query($sql);
$arr_residence = [];

if ($result->num_rows > 0) {
    $arr_residence = $result->fetch_all(MYSQLI_ASSOC);
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
  <title>Home</title>
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav id="mainNav" class="navbar navbar-expand-lg navbar-light fixed-top pt-2">
    <div class="container">
      <button type="button" class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navBarUser" aria-controls="navBarUser" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon fa fa-user"></i>
      </button>
      <a class="navbar-brand js-scroll-trigger" href="#page-top" id="logo">MHS2u</a>
      <button type="button" class="navbar-toggler navbar-toggler-left" data-toggle="collapse" data-target="#navBarResponsive" aria-controls="navBarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon fas fa-bars fa-1x"></i>
      </button>

      <div class="collapse navbar-collapse" id="navBarResponsive">
        <ul class="navbar-nav ml-3  my-lg-0 ">
		<?php if(!empty($_SESSION['user'])) { ?>
			<?php if($_SESSION['userType']=='HousingOfficer') { ?>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger " href="#about">About</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#residence">Residence</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="viewApplication_Officer.php">View Application</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="addNewUnit.php">Add residence</a>
				  </li>
				  <?php }else{?>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger " href="#about">About</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#residence">Residence</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
				  </li>
				<?php } ?>
		<?php }else { ?>
		   <li class="nav-item">
            <a class="nav-link js-scroll-trigger " href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#residence">Residence</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
          </li>
        </ul>
		<?php } ?>

      </div>
      <div class="collapse navbar-collapse" id="navBarUser">

        <ul class="nav navbar-nav ml-auto my-2 my-lg-0 ">
		<?php if(!empty($_SESSION['user'])) { ?>
			<?php if($_SESSION['userType']=='HousingOfficer') { ?>
				  <li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="addNewUnit.php " > <span class="fa fa-user mx-3" aria-hidden="true"></span><?php echo $_SESSION['user']; ?></a>
				  </li>
			<?php } else{?>	
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="viewApplication_Applicant.php" > <span class="fa fa-user mx-3" aria-hidden="true"></span><?php echo $_SESSION['user']; ?></a>
				  </li>
			<?php } ?>	  
		   <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="logout.php"><span class="fas fa-sign-out-alt mx-3" aria-hidden="true"></span>Logout</a>
          </li>
		<?php } else { ?>
          <li class="nav-item ">
            <a class="nav-link js-scroll-trigger" href="index.php" data-toggle="modal" data-target="#login"> <span class="fa fa-lock mx-3" aria-hidden="true" ></span>Login</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link js-scroll-trigger" href="index.php" data-toggle="modal" data-target="#signUp"> <span class="fa fa-user mx-3" aria-hidden="true"></span>Sign Up</a>
          </li>
		<?php } ?>
        </ul>
      </div>
    </div>
  </nav>
<!--sign up-->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content ">
        <div class="modal-header bg-warning">
          <h4 class="col text-center ">Login Now</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="login px-2 mx-auto mw-100">
            <form action="login.php" method="POST">
              <div class="form-group">
                <label class="mb-2">Username</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="">
              </div>
              <div class="form-group">
                <label class="mb-2">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary submit mb-4 px-5" value="login">Login</button>
              </div>
              <p class="text-center pb-4">
                <a href="#" data-toggle="modal" data-target="#signUp" data-dismiss="modal"> Don't have an account?</a>
              </p>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="modal fade"  id="signUp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content ">
        <div class="modal-header bg-warning">
          <h4 class="col text-center">Sign Up</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
		<ul class="nav nav-tabs px-3 m-auto" id="tabContent">
        <li class="active mx-2 px-5 py-2"><a class="tempTextChg" href="#home" data-toggle="tab">Applicant</a></li>
        <li class="px-5 py-2"><a class="tempTextChg" href="#menu1" data-toggle="tab">Housing Officer</a></li>
		</ul>

        <div class="modal-body">
          <div class="login px-2 mx-auto mw-100">
			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active">
			  <h3>New Applicant</h3>
				<form action="register.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">

                <label for="name">Username</label>
                <input type="text" class="form-control" id="name" placeholder="Username" name="username" required="">
              </div>
              <div class="form-group">
                <label for="newpwd">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password"  required="">
              </div>
              <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="fullname" class="form-control" id="fullname" placeholder="Full Name" name="fullname"  required="">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email" name="email"  required="">
              </div>
              <div class="form-group">
                <label for="name">Monthly Income</label>
                <input type="text" class="form-control" id="monthlyIncome" placeholder="Monthly Income" name="monthlyIncome" required="">
              </div>
              <div class="form-group">
                <label for="newemail">Pay Slip </label>
                <input type="file" id="paySlip" name="paySlip" required="">
              </div>
              <div class="text-center">
                <button type="submit" name="registerApplicant_btn" class="btn btn-primary submit mb-4 px-5" value="signUp">Sign Up</button>
              </div>
            </form>
			  </div>

			  <!----HousingOfficer-->
			  <div id="menu1" class="tab-pane fade">
				<h3>New Housing Officer</h3>
				<form action="registerHO.php" method="post">
              <div class="form-group">
                <label for="name">Username</label>
                <input type="text" class="form-control" id="name" placeholder="Username" name="username" required="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required="">
              </div>
              <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="fullname" class="form-control" id="fullname" placeholder="Full Name" name="fullname"  required="">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter new email" name="email"  required="">
              </div>

              <div class="text-center">
                <button type="submit" name="registerHO_btn" class="btn btn-primary submit mb-4 px-5" value="signUp">Sign Up</button>
              </div>
            </form>
			  </div>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--signup-->

  <!--signup-->


  <!--login&signup-->


  <header class="masthead">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end ">
          <h1 class="text-uppercase text-white" >Micro Housing System</h1>
          <hr class="linedivider my-4 ">
        </div>
        <div class="col-lg-8 align-self-baseline">

          <p class="text-white font-weight-light ">A scheme to help youths to rent accommodation at affordable prices</p>

        <i class="arrow bounce text-white fa-3x fas fa-angle-double-down mt-5"></i>
        </div>

      </div>
    </div>
  </header>

  <section class="page-section " style="background-color:lightgrey;" id="about">
    <div class="container">
      <h2 class="text-center mt-0">Our Vision</h2>
      <hr class="divider my-4">
      <div class="row">
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-gem text-primary mb-4"></i>
            <h3 class="h4 mb-2 ">Affordable Price</h3>
            <p class="text-muted mb-0">Rent a house with affordable price not a dream</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-laptop-code text-primary mb-4"></i>
            <h3 class="h4 mb-2">Fast service</h3>
            <p class="text-muted mb-0">Application will be process within 1 week</p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-globe text-primary mb-4"></i>
            <h3 class="h4 mb-2">Open for youths</h3>
            <p class="text-muted mb-0">Age of 22-30 are welcome to apply and register</p>
          </div>
        </div>


        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-heart text-primary mb-4"></i>
            <h3 class="h4 mb-2">Made with Love</h3>
            <p class="text-muted mb-0">We poured our hearts into these scheme</p>
          </div>
        </div>
      </div>

    </div>
  </section>


  <!-- Page Heading -->
  <div class="page-section" id="residence">
    <div class="container">
      <h2 class="text-center mt-0">Our Residences</h2>
      <hr class="divider my-4">

      <div class="row">
	 <script>
	  function sendResidence(residenceName){

			var resID= document.getElementById("res").value,
			 url = 'http://localhost/webprg/submitApp.php?residenceName=' + encodeURIComponent(resID);
			 document.location.href = url;
										}</script>

	     <?php if(!empty($arr_residence)) { ?>
			 <?php foreach($arr_residence as $residence) {?>
				<?php if($residence['numUnits'] != 0){?>
					<div class="col-lg-4 col-sm-6 mb-4">
						<div class="card h-100">
							<a href="#"><img class="card-img-top" src="<?php echo $residence['image'];?>" alt="Resident Subang"></a>
								<div class="card-body">
								  <h4 class="card-title">
									<a id="res" href=#><?php echo $residence['residenceName'];?></a><span class="text-muted px-2"><?php echo "R".$residence['residenceID'];?></span></a>
								  </h4>
								  <ul class="houseList list-unstyled px-3 ">
									<li><span class="fas fa-bed "></span>3</li>
									<li><span class="fas fa-bath"></span>2</li>
									<li><span class="fas fa-map "></span><?php echo $residence['sizePerUnit'];?> sqft</li>
								  </ul>
								  <ul class="list-unstyled px-3 ">
									<li class="houseTitle">Address</li>
									<p "card-text"></span><?php echo $residence['address'];?></p>
									<li class="houseTitle">Monthly Rental</li>
									<p "card-text">RM <?php echo $residence['monthlyRental'];?></p>

									<li class="houseTitle">Number of available <span class="badge"><?php echo $residence['numUnits'];?></span></li>
								  </ul>
								  <?php if (!empty($_SESSION['user'])) { ?>
									<?php echo "<a class='btn btn-danger float-right'. href='submitApp.php?residenceID=" . $residence['residenceID'] . "&residenceName=" . $residence['residenceName'] . "'>" .'Apply Now'. "</a>" ; ?>
								  <?php
								  } else { ?>
									<a href="#" class="btn btn-danger float-right" role="button"  >Apply Now</a>
								  <?php } ?>
							</div>
					</div>
				</div>
				<?php } ?>
			<?php } ?>
		<?php }  ?>
		</div>
		</div>
	</div>

      <!-- /.row -->
      <!-- Pagination -->
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>

    </div>
  </div>


  <section class="page-section" style="background-color:lightgrey;" id="contact">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0">Let's Get In Touch</h2>
          <hr class="divider my-4">
          <p class="text-muted mb-5">Looking for a house? Give us a call or send us an email and we will get bak to you as soon as possible.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div class="pb-5"> +03 2617 9000</div>
        </div>
        <div class="col-lg-4 mr-auto pb-5 text-center ">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <a class="d-block text-decoration-none text-dark" href="mailto:contact@yourwebsite.com">dbkualalumpur@gmail.com</a>
        </div>
        <div class="col-lg-4 mr-auto pb-5 justify-content-center text-center">
          <ul class="social_section_1info">
            <li class="mb-3 facebook"> <a class="fb-ic">
                <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 twitter"> <a class="tw-ic">
                <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 google"> <a class="gplus-ic">
                <i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 linkedin"> <a class="li-ic">
                <i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 instagram"><a class="ins-ic">
                <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
              </a></li>
            <li class="mb-3 pinterest"><a class="pin-ic">
                <i class="fab fa-pinterest fa-lg white-text fa-2x"> </i>
              </a></li>
          </ul>
        </div>

      </div>
    </div>
  </section>


  <footer style="background-color: #2c292f">
    <div class="container ">
      <div class="row ">
        <div class="col-md-4 text-center text-md-left ">
          <div class="py-0">
            <h3 class="my-4 font-weight-bold" id="logo">MHS2u</h3>

            <p class="flinks font-weight-bold">
              <a class="text-white " href="">Home</a>
              |
              <a class="text-white" href="#about">About</a>
              |
              <a class="text-white" href="#residence">Residences</a>
              |
              <a class="text-white" href="#contact">Contact Us</a>
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
    </div>
  </footer>
  <!-- Copyright -->
  <div class="col-lg-12 footer-copyright text-center py-2 text-white bg-dark">© 2019 Copyright:
    <a class="text-white" href="#"> MHS2u</a>
  </div>
  <!-- Copyright -->


  <!-- Footer -->
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


  <script src="js/cj.js"></script>

</body>


</html>
