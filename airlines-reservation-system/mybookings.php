<?php
session_start();
if(isset($_SESSION['user_id'])){}
else {
  header("location: userlogin.php");
 }
?>
<style>
      body{
            background-color:gray;
      }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="assets/homeStyle.css" >
      
      <link rel="stylesheet" type="text/css" href="assets/bookingstableStyle.css" >
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
         <!-- <li id="userlogin"><a href="userlogin.php" >login</a></li>-->
          <li id="index"><a href="index.php" >Book Flight</a></li>            
          <li id="myaccount"> <a href="mybookings.php" >My Account</a></li>
          <li id="signout"><a  href="signout.php">Log Out</a></li>
        </ul>
        </nav>
      </header>

      
      
      <table>    
           <tr>
           <th>Booking ID</th>
           <th>Flight Id</th>
           <th>Airlines</th>
           <th>Ticket Type</th>
           <th>Booking Date</th>
           <th>Price $</th>
           </tr>

           <?php

include "repository/dbConnection.php";
$conn=dbConnection();

if($conn){
      $sql="SELECT booking_id FROM bookings ORDER BY booking_id DESC limit 1;";
$verify=mysqli_query($conn,$sql);
if($verify){
      $row = mysqli_fetch_assoc($verify);
      $booking_id=$row['booking_id'];
      $booking_id+=1;
}

$query="SELECT *FROM bookings";

$result=mysqli_query($conn,$query);
if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) { 


            echo "

        <tr>
           <td>".$row['booking_id']."</td>
           <td> ".$row['flight_id']."</td>
           <td>".$row['airline_id']."</td>
           <td>".$row['ticket_type']."</td>
           <td>".$row['booking_date']."</td>
           <td>$".$row['price']."</td>
           </tr>";

}}}
?>
</form>
</table>
<?php
if(isset($_GET['deleteBooking'])){
$bid=$_GET['deleteBooking'];
if($conn){
      $query="DELETE FROM bookings where booking_id='$bid';";
      $update=mysqli_query($conn,$query);
      if($update){
            header("refresh:1;");
           echo "<script> alert('Deleted'); </script>";
         
      }
      else{
            echo "<script> alert(' 404 error'); </script>";
      }
}

}

      
           
      
?>
</body>
</html>