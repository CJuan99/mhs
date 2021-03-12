<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!--Link for Font Awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" href="CSS/ricky.css">

    <title>View Applications</title>
</head>
<body>
    <!-- Navbar -->
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
          <!--  <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#" data-toggle="modal" data-target="#login"> <span class="fa fa-lock mx-3" aria-hidden="true"></span>Login</a>
            </li>-->
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#"><span class="fa fa-user mx-3" aria-hidden="true"></span><?php echo $_SESSION['user']; ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="logout.php"><span class="fas fa-sign-out-alt mx-3" aria-hidden="true"></span>Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <!---nav--->
<!--header-->
  <header class="headerUser">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 align-self-end ">
          <h1 class="text-uppercase text-white">Profile</h1>
        </div>
      </div>
    </div>
  </header>
  <!--headerImg-->
    <!-- Application List -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mb-4">Residence Applications Applied</h2>
                    </div>
                </div>
                <div class="row" id="favourite">
                    <h3 class="ml-3">Favourite</h3>
                    <p id=favouriteEmpty class="col-md-12 bg-white py-3"> - - No Applications are found here - -</p>
                    <!--Residence Applications favourite will display here-->
                </div>
                <div class="row" id="unfavourite">
                    <h3 class="ml-3 mt-5">Normal</h3>
                    <p id=unfavouriteEmpty class="col-md-12 bg-white py-3"> - - No Applications are found here - -</p>
                    <!--Residence Applications unfavourite will display here-->
                </div>
            </div>
            <div class="col-lg-3 recommendedResidence">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Recommended</h3>
                    </div>
                </div>
                <div class="row" id="residenceRecommended">
                    <!--Recommended Residence will display here-->
                </div>
            </div>
        </div>
    </div>
<!---footer--->
    <footer class="mt-5" style="background-color: #2c292f">
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
    <?php include("viewApp_Applicant.php"); ?>
    
</body>
</html>
