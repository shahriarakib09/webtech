<?php
session_start();
if(isset($_SESSION['user_id'])){}
else {
  header("location: repository/loginauthentication.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="assets/homeStyle.css" >
      <link rel="stylesheet" type="text/css" href="assets/footerStyle.css" >
      <link rel="stylesheet" type="text/css" href="assets/tableStyle.css" >
      <title>ABC Flight Reservations</title>
</head>
<body>
      <header>
            <a name="top"></a>
      <nav>
        <div class="logo"><a href="index.php"><i class="fa fa-plane" aria-hidden="true"> ABC Flight Reservations</i></a></div> 
          <input type="checkbox" id="click">
          <label for="click" class="menu-btn"><i class="fa fa-bars"></i></label>
        <ul>
         <!-- <li id="userlogin"><a href="userlogin.php" >login</a></li>
          <li id="register"><a href="#" >Register</a></li>            -->
          <li id="myaccount"> <a href="mybookings.php" >My Account</a></li>
          <li id="signout"><a  href="signout.php">Log Out</a></li>
        </ul>
        </nav>
      </header> 
      <div class="homepage_img"></div>
       <section class="flight_search">
             <div>
                   <fieldset>
                         <legend >
                         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                <span class="halfStyle" data-content="F">F</span>
                                <span class="halfStyle" data-content="L">L</span>
                                <span class="halfStyle" data-content="I">I</span>
                                <span class="halfStyle" data-content="G">G</span>
                                <span class="halfStyle" data-content="H">H</span>
                                <span class="halfStyle" data-content="T">T</span>
                         </legend>
                         <form action="#" method="POST" >
                               <div class="box">
                               <i class="fa fa-map-marker" aria-hidden="true"> Departure</i><br>
                               <input type="text" list="airports" name="departure" id="departure" placeholder="enter departure airport here...">
                               <datalist id="airports">
                               <?php

                                      include "repository/dbConnection.php";
                                      $query="SELECT * FROM airports";
                                      $conn=dbConnection();
                                      $result=mysqli_query($conn,$query);
                                      if (mysqli_num_rows($result) > 0) {
                                          while($row = mysqli_fetch_assoc($result)) { 
                                                echo "<option >".$row['airport_name']."</option>";
                                          }
                                    }
                             ?>
                              </datalist>	
                               </div>
                               <div class="box">
                               <i class="fa fa-map-marker" aria-hidden="true">  Destination</i><br><input list="airports" type="text" name="destination" id="destination" placeholder="enter destination airport here..." >					  	
                              </div>
                               <div class="box">
                                <label for="dDate"style="font-weight:bolder">Departure Date</label><br><input type="date" name="dDate" id="dDate">
                               </div>
                               <div class="box">
                               <br><input type="button" id="searchflights" value="Search" onclick="flightSearch()">
                               </div>
                         </form>
                   </fieldset>
             </div>
       </section>
       </section>
       <section class="flight_results"id="flight_results" style="display:none">
             <fieldset>
                   <legend>Available Flights</legend>
                   <p id="no-data-found"></p>
                   <div id="flights_found">

                   </div>
             </fieldset>

       </section>
       <section class="book_flight"id="booking_block" style="display:none">
       <fieldset>
                   <legend>Book Flights</legend>
                   
                   <div id="booking_data">

                   </div>
             </fieldset>
        </section>
       
</body>

<!--footer begins here -->
<section >
      <div class="footer-remastered">
<footer class="footer">
      <div class="container">
            <div class="row">
                  <div class="footer-col">
                        <h4>Terms</h4>
                        <ul>
                              <li><a href="about_us.php">about us</a></li>
                              <li><a href="bestprice.php">Best Price Guarantee</a></li>
                              <li><a href="blog.php">Blog</a></li>
</ul>
</div>
<div class="footer-col">
      <h4>Services</h4>
      <ul>
            <li><a href="faq.php">FAQ</a><li>
            <li><a href="#">Easy EMI</a><li>
            <li><a href="#">Return</a><li>
            <li><a href="#">Payment option</a><li>
            </ul>
</div>
<div class="footer-col">
      <h4>Newsletter</h4>
      <div  id="Newsletter">
      <ul>
      <h2>Subscribe</h2>
<form action="home.php">
  <label for="Email">Email:</label><br>
  <input type="text" id="Email" name="Email"><br>
  <input type="submit"id="submit" value="Submit">
</form>

            </ul>
</div>
</div>
<div class="footer-col">
      <h4>Follow us</h4>
     <div class="social-links">
           <a href="#"><i class="fa fa-facebook-f"></i></a>
           <a href="#"><i class="fa fa-twitter"></i></a>
           <a href="#"><i class="fa fa-instagram"></i></a>
           <a href="#"><i class="fa fa-linkedin"></i></a>
           <div class="place">
           <span class="fa fa-briefcase"></span>
           <span class="text">Uttara,Sector-07,Dhaka</span></div>
           <div class="phone">
           <span class="fa fa-phone"></span>
           <span class="text">01812121956</span></div>
           <div class="phone">
           <span class="fa fa-phone"></span>
           <span class="text">017XXXXXXXXX</span></div>
           <div class="mail">
           <span class="fa fa-envelope"></span>
           <span class="text">abc@trv.in</span></div>
</div>
</div>
</div>

<p>Copyright <span><i class="fa fa-copyright" ></i></span> ABC Flight Reservations 2021</p>
</footer>
</div>
</section>
</html>

<script>

      function flightSearch() {
            var dep=document.getElementById("departure").value;
            var des=document.getElementById("destination").value;
           
            var xmlhttp=new XMLHttpRequest(); 
            console.log(des);
            xmlhttp.onreadystatechange=function() {
                  if (this.readyState==4 && this.status==200) {
                        document.getElementById("no-data-found").style.display="none";
                        document.getElementById("flights_found").innerHTML=this.responseText;
                        document.getElementById("flight_results").style.display="block";
                        }
                        else{
                              document.getElementById("no-data-found").innerHTML="No Flights Found";
                              document.getElementById("flight_results").style.display="block";
                              }
            }             
            xmlhttp.open("GET","repository/flightsearch.php?departure=" + dep + "&destination=" + des, true);
            xmlhttp.send();
                       
      }

      function flightbooking(){
            
            
            var fid=document.getElementById("fid").innerHTML;
            var dep=document.getElementById("dep").innerHTML;
            var arr=document.getElementById("arr").innerHTML;
            var at=document.getElementById("dt").innerHTML;
            var dt=document.getElementById("at").innerHTML;
            var ep=document.getElementById("ep").innerHTML;
            var bp=document.getElementById("bp").innerHTML;
            var acap=document.getElementById("acap").innerHTML;
            var aid=document.getElementById("aid").innerHTML;
           
            var xmlhttp=new XMLHttpRequest(); 
            console.log(fid);
            xmlhttp.onreadystatechange=function() {
                  if (this.readyState==4 && this.status==200) {
                       
                        document.getElementById("booking_data").innerHTML=this.responseText;
                        document.getElementById("booking_block").style.display="block";
                        }
                        else{
                            
                              document.getElementById("booking_data").style.display="block";
                              }
            }             
            xmlhttp.open("GET","repository/bookflight.php?fid="+fid+"&dep=" + dep+"&arr=" +arr+"&dt=" +dt+"&at=" +at+"&ep=" + ep+"&bp=" +bp+"&acap=" +acap+"&aid=" +aid, true);
            xmlhttp.send();
                       
      }  
      function confirmbooking(){
            var xmlhttp=new XMLHttpRequest(); 
            console.log(fid);
            xmlhttp.onreadystatechange=function() {
                  if (this.readyState==4 && this.status==200) {
                       
                        document.getElementById("booking_data").innerHTML=this.responseText;
                        alert("Booking Successfull");  
                        console.log(this.status);  // fix here
                        document.getElementById("booking_block").style.display="none";
                        document.getElementById("flights_found").style.display="none";
                        window.refresh();
                        
                        }
                        else{
                            
                              document.getElementById("booking_data").style.display="block";
                              }
            }             
            xmlhttp.open("GET","repository/bookflight.php?insertBooking="+'ok', true);
            xmlhttp.send();

      }

</script>
