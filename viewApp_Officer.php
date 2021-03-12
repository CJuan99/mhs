<?php
include("conDb.php");

$userID = $_SESSION["userID"];
$staffID = $_SESSION["staffID"];

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

//Status color
function assignStatusColor(){
    var desc = document.getElementsByTagName("td");

    for(var i=0; i<desc.length; i++){
        if(desc[i].innerHTML == "New")
            desc[i].style.color = "#0275d8";
        else if(desc[i].innerHTML == "Waitlist")
            desc[i].style.color = "#a85f2a";
        else if(desc[i].innerHTML == "Appeal Pending")
            desc[i].style.color = "#a85f2a";
        else if(desc[i].innerHTML == "Approved")
            desc[i].style.color = "#5cb85c";
        else if(desc[i].innerHTML == "Rejected")
            desc[i].style.color = "#d9534f";
    }
}

//Residence Applications Data and ArrayList
var sampleRID = new Array();
var appList = new Array();
    
function showApps(selectOption){
    var res_id = selectOption.value;
    
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var twoArray = JSON.parse(this.responseText);
            sampleRID = twoArray[0];
            appList = twoArray[1];
            
            //Function Call
            setRUM(sampleRID);
            
            trackArray = 0;
            
            var tableProcessing = document.getElementById("appProcessing");
            var tableCompleted = document.getElementById("appCompleted");
            
            while(tableProcessing.rows.length>1){
                tableProcessing.deleteRow(1);
            }
            while(tableCompleted.rows.length>1){
                tableCompleted.deleteRow(1);
            }
                
            for (l of appList){
                insertData(l);
            }

            disable_Approve_Reject();
            assignStatusColor();

        }
    }
    xhttp2.open("GET", "retrieveAppsHO.php?rID="+res_id, true);
    xhttp2.send();
    
}
    

//trackArray --> For tracking the tr(table row) is belong to which array in "appList"
var trackArray = 0;

function insertData(data){
    var tableProcessing = document.getElementById("appProcessing");
    var tableCompleted = document.getElementById("appCompleted");

    if(data[4]=="Approved"||data[4]=="Rejected"){
        var row = tableCompleted.insertRow(tableCompleted.length);
        var cell1 = row.insertCell(0);
        cell1.innerHTML = data[0];
        var cell2 = row.insertCell(1);
        cell2.innerHTML = data[1];
        var cell3 = row.insertCell(2);
        cell3.innerHTML = data[2];
        var cell4 = row.insertCell(3);
        cell4.innerHTML = data[3];
        var cell5 = row.insertCell(4);
        cell5.innerHTML = data[4];
        var cell9 = row.insertCell(5);
        cell9.innerHTML = `<button onclick="approve(this, ` + trackArray + `)" class="btn btn-primary">Approve</button>`
        var cell10 = row.insertCell(6);
        cell10.innerHTML = `<button onclick="reject(this, ` + trackArray + `)" class="btn btn-danger">Reject</button>`
    }else{
        var row = tableProcessing.insertRow(tableProcessing.length);
        var cell1 = row.insertCell(0);
        cell1.innerHTML = data[0];
        var cell2 = row.insertCell(1);
        cell2.innerHTML = data[1];
        var cell3 = row.insertCell(2);
        cell3.innerHTML = data[2];
        var cell4 = row.insertCell(3);
        cell4.innerHTML = data[3];
        var cell5 = row.insertCell(4);
        cell5.innerHTML = data[4];
        var cell9 = row.insertCell(5);
        cell9.innerHTML = `<button onclick="approve(this, ` + trackArray + `)" class="btn btn-primary">Approve</button>`
        var cell10 = row.insertCell(6);
        cell10.innerHTML = `<button onclick="reject(this, ` + trackArray + `)" class="btn btn-danger">Reject</button>`
    }

    trackArray+=1;
}

function approve(buttonApprove, arrayNum){
    row = buttonApprove.parentElement.parentElement;
    row.cells[4].innerHTML = "Approved";
    var dataArray = appList[arrayNum];
    dataArray[4] = "Approved";
    
    var location = "forwardToAllocation.php?applicationID="+dataArray[5];
    
    window.location.href=location;
    /*var unitAvai = document.getElementById("unitAvai");

    var currentAvai = --sampleRID[1];
    unitAvai.innerHTML = currentAvai;

    sampleRID[1] = currentAvai;

    assignStatusColor();

    buttons = row.getElementsByTagName("button");

    for(b of buttons){
        b.disabled = true;
    }

    var rowChg = buttonApprove.parentElement.parentElement;
    rowChg.remove();

    var appCompleted = document.getElementById("appCompleted");

    appCompleted.appendChild(rowChg);*/
}

function reject(buttonReject, arrayNum){
    row = buttonReject.parentElement.parentElement;
    row.cells[4].innerHTML = "Rejected";
    var dataArray = appList[arrayNum];
    dataArray[4] = "Rejected"
    assignStatusColor();
    
    var xhttp3 = new XMLHttpRequest();
    
    xhttp3.open("GET", "rejectUpdate.php?applicationID="+dataArray[5], true);
    xhttp3.send();

    var buttons = row.getElementsByTagName("button");

    for(b of buttons){
        b.disabled = true;
    }

    var rowChg = buttonReject.parentElement.parentElement;
    rowChg.remove();

    var appCompleted = document.getElementById("appCompleted");

    appCompleted.appendChild(rowChg);
    
    
}

function setRUM(data){ //RUM - Residence ID, Units Available, Monthly Rental
    var unitsAvailable = document.getElementById("unitAvai");
    var monthlyRentalPrice = document.getElementById("monthlyRentalPrice");
    
    unitsAvailable.innerHTML = data[1];
    monthlyRentalPrice.innerHTML = "RM " + data[2];
    
}

function disable_Approve_Reject(){
    var table = document.getElementsByTagName("table");
    var tableRows;
    var tableStatus

    for(t of table){
        tableRows = t.rows;
        for(var i=1; i<t.rows.length; i++){
            tableStatus = tableRows[i].cells[4].innerHTML;
            if(tableStatus=="Approved"||tableStatus=="Rejected"){
                var buttons = tableRows[i].getElementsByTagName("button");

                for(b of buttons){
                    b.disabled = true;
                }
            }
        }
    }
}


</script>