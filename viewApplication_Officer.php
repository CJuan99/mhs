<?php
session_start();

$staffID = $_SESSION["staffID"];
include("conDb.php");
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
          <h1 class="text-uppercase text-white">Officer's Profile</h1>
        </div>
      </div>
    </div>
  </header>
  <!--headerImg-->
    <div class="container my-5">
        <div id="boxRUM" class="row">
            <div id="r_Info" class="m-auto w-50 py-3 px-5 bg-dark text-white">
                <label>Residence ID: </label>
                <select onchange="showApps(this)" class="w-100 py-2" name="resID">
                    <option disabled selected value=""> - - Select Residence - - </option>
                    <?php
                        $sql_residenceHO = "SELECT * FROM residence WHERE staffID = '$staffID'";
                        $results = $conn->query($sql_residenceHO);
                        if($results->num_rows > 0){
                            while($row = $results->fetch_assoc()){
                                $residenceID = $row["residenceID"];
                                echo "<option value='$residenceID'>R$residenceID</option>";
                                
                            }
                        }
                    ?>
                    
                </select>
                <br><br>
                <span>Units Available: </span><br><span id="unitAvai">0</span><br><br>
                <span>Monthly Rental: </span><br><span id="monthlyRentalPrice"> RM 0 </span>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12 pl-0">
                        <h2>Residence Applications</h2>
                    </div>
                </div>
                <div class="row">
                    <table class="table bg-white tableHeight" id="appProcessing">
                        <h4 class="mt-4">Processing</h4>
                        <tr class="bg-dark text-white">
                            <th>Applicant Username</th>
                            <th>Monthly Income</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th class="statusWidth">Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <!--Application in processing will be adding here-->
                    </table>
                    <table class="table bg-white tableHeight" id="appCompleted">
                        <h4 class="mt-4">Completed</h4>
                        <tr class="bg-dark text-white">
                            <th>Applicant Username</th>
                            <th>Monthly Income</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th class="statusWidth">Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <!--Application completed will be adding here-->
                    </table>
                </div>
            </div>
        </div>
    </div>

  <!--footer--->
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
    <?php include("viewApp_Officer.php"); ?>
    
</body>
</html>
