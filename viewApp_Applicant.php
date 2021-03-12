<?php
include("conDb.php");

$userID = $_SESSION["userID"];
$applicantID = $_SESSION["applicantID"];

?>

<script type="text/javascript">
    
(function($) {
  "use strict";

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 80) {
      $("#mainNav").addClass("navbar-scrolled");
    } else {
      $("#mainNav").removeClass("navbar-scrolled");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  $('.navbar-toggler').click(function() {
    $('.navbar-collapse').collapse('hide');
  });
})(jQuery);

//Status Color
function assignStatusColor(){
    var Status = document.getElementsByClassName("status");

    for (var i=0; i<Status.length; i++){
        if(Status[i].innerHTML == "New")
            Status[i].style.color = "#0275d8";
        else if(Status[i].innerHTML == "Waitlist")
            Status[i].style.color = "#a85f2a";
        else if(Status[i].innerHTML == "Appeal Pending")
            Status[i].style.color = "#a85f2a";
        else if(Status[i].innerHTML == "Approved")
            Status[i].style.color = "#5cb85c";
        else if(Status[i].innerHTML == "Rejected")
            Status[i].style.color = "#d9534f";
    }
}

    

//Residence Applications
//Application info put here (days, residenceName, status, states, district, residenceId, unitAvailable, monthlyRentals)
var residenceList = new Array();

<?php

$sql_application = "SELECT * FROM application WHERE applicantID = '$applicantID'";
$results = $conn->query($sql_application);
if($results->num_rows > 0 ){
    while($row = $results->fetch_assoc()){
        $residenceID = $row["residenceID"];
        
        $sql_residence = "SELECT * FROM residence WHERE residenceID = '$residenceID'";
        $results_residence = $conn->query($sql_residence);
        if($results_residence->num_rows > 0){
            $row2 = $results_residence->fetch_assoc();
            
            $sql_unit = "SELECT * FROM unit WHERE residenceID = '$residenceID' AND availability=1";
            $results_unit = $conn->query($sql_unit);
            $unitsAvailable = $results_unit->num_rows;
            
            $applicationDate = $row["applicationDate"];
            $currentDate = date("Y-m-d");
            $applicationDate = new DateTime($applicationDate);
            $currentDate = new DateTime($currentDate);
            $days_diff = $applicationDate->diff($currentDate);
            $daysAgo = $days_diff->days;
            
            switch($daysAgo){
                case 0 :
                    $daysAgo = "Today";
                    break;
                case 1 :
                    $daysAgo = $daysAgo . " day ago";
                    break;
                default:
                    $daysAgo = $daysAgo . " days ago";
            }
            
            if($row["favourite"]){
                $favourite = true;
            }else{
                $favourite = false;
            }
            
            if($row["appealed"]){
                $appealed = true;
            }else{
                $appealed = false;
            }

            echo "app" . $row["applicationID"]?> = new Array( "<?php echo $daysAgo ?>", 
                                                             "<?php echo $row2["residenceName"] ?>", 
                                                             "<?php echo $row["status"] ?>",
                                                            "<?php echo $row2["address"] ?>",
                                                            "<?php echo $residenceID ?>",
                                                            "<?php echo $unitsAvailable ?>",
                                                            "<?php echo $row2["monthlyRental"] ?>",
                                                            "<?php echo $favourite ?>",
                                                            "<?php echo $row["applicationID"] ?>",
                                                            "<?php echo $appealed ?>");    
            residenceList.push(<?php echo "app" . $row["applicationID"]?>);
        <?php
        }        
    }
}
?>



//Recommended Residence put here (residenceName, unitAvailable)
var recList = new Array();

<?php

$sql_all_residence = "SELECT * FROM residence";
$results_all_residence = $conn->query($sql_all_residence);
if($results_all_residence->num_rows > 0){
    while($row = $results_all_residence->fetch_assoc()){
        $residenceID = $row["residenceID"];
        $sql_unit = "SELECT * FROM unit WHERE residenceID = '$residenceID' AND availability=1";
        $results_unit = $conn->query($sql_unit);
        $unitsAvailable = $results_unit->num_rows;
        
        $sold_units = $row["numUnits"] - $unitsAvailable;
        
        echo "rec".$residenceID ?> = new Array("<?php echo $row["residenceName"] ?>",
                                                    "<?php echo $unitsAvailable ?>",
                                              "<?php echo $sold_units ?>",
                                              "<?php echo $residenceID ?>");
        recList.push(<?php echo "rec".$residenceID?>);
<?php
    }
?>
    recList.sort(sortFunction);

    function sortFunction(a, b) {
        return b[2]-a[2];
    }
    
    var recentList = new Array();
    
    var c = 0;
    while(recentList.length < 10 && c < recList.length){
        if(recList[c][1] > 0){
            recentList.push(recList[c]);    
        }
        c++;
    }
    
<?php
}
?>
    

//countId --> For tracking the appBox is belong to which array in "residenceList"

function generateAppBox(list, countId){
    var favourite = document.getElementById("favourite");
    var unfavourite = document.getElementById("unfavourite");

    var div = document.createElement("DIV");
    var rBox = `<div class="application p-4 d-block d-lg-flex align-items-center">
                    <div class="desc mb-4">
                        <div class="align-items-center mb-3">
                            <span class="timeAgo">` + list[0] + `</span>
                            <h2><a href="#">` + list[1] + `</a></h2>
                        </div>
                        <div class="roomDetails d-block d-md-flex">
                            <div class="mr-5"><i class="fas fa-file-alt mr-1"></i><span>Status: </span><span class="status" id="` + "status" + countId + `">` + list[2] + `</span></div>
                            <div class="w-50"><i class="fas fa-map-marker-alt mr-1"></i><span>` + list[3] + `</span></div>
                        </div>
                    </div>
                    <div class="appBtn mx-auto mt-4 d-flex align-items-center">
                        <div>
                            <a onclick="favourite(this, ` + countId + `)" id="icons` + countId + `" class="icon d-flex text-center justify-content-center align-items-center mr-3">
                                <i class="fas fa-heart"></i>
                            </a>
                        </div>
                        <a href="#" class="btn btnShadow btn-primary py-2" data-toggle="modal" data-target="#` + "viewApp" + countId + `">View App</a>
                    </div>
                </div>`;
    div.className = "col-md-12";
    div.innerHTML = rBox;

    if (list[7]==true){
        favourite.appendChild(div);
    }else{
        unfavourite.appendChild(div);
    }

}

function generateModals(list, countId){
    var modalBox = `    <div id=` + "viewApp" + countId + ` class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content"> 
                                    <div class="modal-header bg-warning">
                                        <h4 class="modal-title col text-center">` + list[1] + `</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="px-2 mx-auto mw-100">
                                            <form action="javascript:void(0)" onsubmit="appealRejection(`+ countId + `)" method="post">
                                                <div class="form-group">
                                                    <label for="rId">Residence ID</label>
                                                    <input type="text" class="form-control" id="rId" name="rId" value="R` + list[4] + `" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="uAvai">Units Available</label>
                                                    <input type="text" class="form-control" id="uAvai" name="uAvai" value="` + list[5] + `" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mRental">Monthly Rentals</label>
                                                    <input type="text" class="form-control" id="mRental" name="mRental" value="RM` + list[6] + `" readonly>
                                                </div>
                                                <div id="` + "appealGroup" + countId + `" class="form-group">
                                                    <label for="appealFile">Additional Documents for Appealing</label>
                                                    <input type="file" id="appealFile"  required>
                                                </div>

                                                <div class="text-center">
                                                    <button type="submit" id="` + "reject" + countId + `" class="btn btn-danger mb-4 px-5" value="appealRejection">Appeal Rejection</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;

    document.write(modalBox);

    var rejectButton = document.getElementById("reject" + countId);
    var appealGroup = document.getElementById("appealGroup" + countId);

    //Decide the display method for rejectButton based on Status
    switch(list[2]){
        case "New":
        case "Waitlist":
        case "Approved":
            rejectButton.classList.add("d-none");
            appealGroup.classList.add("d-none");
            break;
        case "Appeal Pending":
            rejectButton.classList.add("disabled");
            rejectButton.title = "Your appeal is being processed.";
            appealGroup.children[1].disabled = true;
            appealGroup.parentElement.onsubmit = "";
            break;
        case "Rejected":
            if(list[9]==true){
                rejectButton.classList.add("disabled");
                rejectButton.title = "You're already appealed 1 time.";
                appealGroup.children[1].disabled = true;
                appealGroup.parentElement.onsubmit = "";
            }
            break;
        default:
            alert("Error");
    }

}

function appealRejection(countId){
    var list = residenceList[countId-1];
    list[2] = "Appeal Pending"; //This variable stored used to ammend the data in database

    var statusId = "status" + countId;
    var statusText = document.getElementById(statusId);
    var rejectId = "reject" + countId;
    var rejectButton = document.getElementById(rejectId);
    var appealGroupId = "appealGroup" + countId;
    var appealGroup = document.getElementById(appealGroupId);

    statusText.innerHTML = "Appeal Pending";
    rejectButton.classList.add("disabled");
    rejectButton.title = "Your appeal is being processed.";
    appealGroup.children[1].disabled = true;
    appealGroup.parentElement.onsubmit = "";
    assignStatusColor();
    
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("GET", "appealUpdate.php?q="+list[8], true);
    xmlhttp.send();
    
    alert("Your appeal have been submitted!");
}

function generateRecommendedResidence(recentList){
    var residenceRecommended = document.getElementById("residenceRecommended");

    var div = document.createElement("DIV");
    var residence = `   <a href="submitApp.php?residenceID=` + recentList[3] + `&residenceName=` + recentList[0] + `">
                        <img src="images/Residence.jpg" class="img-fluid" alt="Residence Image"></a>

                        <div class="residence py-2 px-1">
                            <h5><a href="submitApp.php?residenceID=` + recentList[3] + `&residenceName=` + recentList[0] + `">` + recentList[0] + `</a></h5>
                            <p><span class="numUnits px-3 rounded">` + recentList[1] + `</span> <span>Units Available</span></p>
                        </div>`
    div.className = "col-md-12 residenceInfo mt-3";
    div.innerHTML = residence;
    residenceRecommended.appendChild(div);
}

function favourite(icon, countId){
    var residence = residenceList[countId-1];
    var favourite_s = residence[7];

    if(!favourite_s){
        icon.style.cssText = "background: rgba(253, 40, 82, 1) !important";
        icon.children[0].style.cssText = "color: #ffffff !important";
        residence[7] = true;
    }
    else{
        icon.style.backgroundColor = "rgba(253, 40, 82, 0)";
        icon.children[0].style.color = "rgba(253, 40, 82, 0)";
        residence[7] =  false;
    }

    var ele = icon.parentElement.parentElement.parentElement.parentElement;
    ele.remove();

    var favourite = document.getElementById("favourite");
    var unfavourite = document.getElementById("unfavourite");

    if (residence[7]){
        favourite.appendChild(ele);
    }else{
        unfavourite.appendChild(ele);
    }

    noApplicationDisplay();
    
    var xmlhttp1 = new XMLHttpRequest();
    
    xmlhttp1.open("GET", "favouriteUpdate.php?appID="+residence[8]+"&s="+residence[7], true);
    xmlhttp1.send();
}

function favouriteLoad(){
    for(var i=0; i<residenceList.length; i++){
        var r = residenceList[i];
        var icon = document.getElementById("icons" + (i+1));

        if(r[7]){
            icon.style.cssText = "background: rgba(253, 40, 82, 1) !important";
            icon.children[0].style.cssText = "color: #ffffff !important";
        }
        else{
            icon.style.backgroundColor = "rgba(253, 40, 82, 0)";
            icon.children[0].style.color = "rgba(253, 40, 82, 0)";
        }
    }
}

function noApplicationDisplay(){
    var favourite = document.getElementById("favourite");
    var unfavourite = document.getElementById("unfavourite");
    var favEmptyMsg = document.getElementById("favouriteEmpty");
    var unfavEmptyMsg = document.getElementById("unfavouriteEmpty");

    if(favourite.childElementCount-2>0){
        if(favEmptyMsg.className == "col-md-12 bg-white py-3"){
            favEmptyMsg.className = "col-md-12 bg-white py-3 d-none";
        }
    }
    else{
        if(favEmptyMsg.className == "col-md-12 bg-white py-3 d-none"){
            favEmptyMsg.className = "col-md-12 bg-white py-3";
        }
    }

    if(unfavourite.childElementCount-2>0){
        if(unfavEmptyMsg.className == "col-md-12 bg-white py-3"){
            unfavEmptyMsg.className = "col-md-12 bg-white py-3 d-none";
        }
    }
    else{
        if(unfavEmptyMsg.className == "col-md-12 bg-white py-3 d-none"){
            unfavEmptyMsg.className = "col-md-12 bg-white py-3";
        }
    }
}

//Function Call
var countId = 1;

for (r of residenceList){
    generateAppBox(r, countId);
    generateModals(r, countId);
    countId++;
}

for (recent of recentList){
    generateRecommendedResidence(recent);
}

assignStatusColor();
favouriteLoad();
noApplicationDisplay();
    
</script>