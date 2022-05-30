<?php
session_start();
if(isset($_SESSION['admin_id'])){}
else {
  header("location: ../adminlogin.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../assets/adminStyle.css" >
     
      <title>Home Page</title>
</head>
<body>
      <header>
            <a name="top"></a>
      <nav>
        <div class="logo">Brand</div>
       
          <input type="checkbox" id="click">
          <label for="click" class="menu-btn"><i class="fa fa-bars"></i></label>

        <ul>
          <li><a href="#" class="active">Home</a></li>
          <li><a href="flights.php" >Flights</a></li>
          <li><a href="airlines.php">Airlines</a></li>
          <li><a href="bookings.php" >Bookings</a> </li>
          <li> <a href="users.php" >Users</a></li>
          <li><a href="transactions.php">Transactions</a></li>
          <li><a  href="../signout.php">Log Out</a></li>
        </ul>
        </nav>

      </header>

  <h1 style='padding-top:500px; font-size:60px'>Welcome to ABC Flight Reservation system</h1>

</body>
</html>