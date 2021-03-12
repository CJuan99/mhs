
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


var originalModal = $('#login').clone();
$(document).on('#login', 'hidden.bs.modal', function () {
    $('#login').remove();
    var myClone = originalModal.clone();
    $('body').append(myClone);
});

var originalModal2 = $('#signUp').clone();
$(document).on('#login', 'hidden.bs.modal', function () {
    $('#signUp').remove();
    var myClone = originalModal.clone();
    $('body').append(myClone);
});


})(jQuery); // End of use strict

// Select all tabs
$('.nav-tabs a').click(function(){
  $(this).tab('show');
})

// Select tab by name
$('.nav-tabs a[href="#home"]').tab('show')

// Select first tab
$('.nav-tabs a:first').tab('show')

/*function signUpFunction(){

}
var sample1 = new Array("R001", "Flora Residence", "Kuala Lumpur", "Bangsar South");
var sample2 = new Array("R002", "Avenue Residence", "Kuala Lumpur", "Genting Highland");
var sample3 = new Array("R003", "Fortune Residence", "Kuala Lumpur", "Kepong" );
var sample4 = new Array("R004", "Gurney Residence", "Penang", "Persiaran Gurney");
var sample5 = new Array("R005", "Sunway Residence", "Rejected", "Kuala Lumpur", "Sunway");

var residenceList = new Array(sample1, sample2, sample3, sample4, sample5);


var residence1 = document.getElementById("residence1");
var residence2 = document.getElementById("residence2");
var optionEle1;
var optionEle2;
var residenceStr;
var count=1;

for(residence of residenceList){
    residenceStr = "";
    for(detail of residence){
        residenceStr += detail + ", ";
    }
    residenceStr = residenceStr.slice(0, -2);
    optionEle1 = document.createElement("option");
    optionEle2 = document.createElement("option");
    optionEle1.value = "residence" + count;
    optionEle1.innerHTML = residenceStr;
    optionEle2.value = "residence" + count;
    optionEle2.innerHTML = residenceStr;
    residence1.appendChild(optionEle1);
    residence2.appendChild(optionEle2);
    count++;
}
*/
/*function applyValidate(){
  if (window.confirm('We appreciate that you’ve apply with us. We’ll get back to you very soon. You may check your appliction '))
  {
  window.location.href='ViewApplication_Applicant.html';
  document.forms[0].submit();
  document.forms[0].reset();
  }

  return true;
  }*/

  function applyAction(){
  alert("Please login or sign up an account to proceed");
}

/*function signUpAction(){
    alert("Account created")
}
/*
function loginFunction(){
    alert("Login successful");
}*/


