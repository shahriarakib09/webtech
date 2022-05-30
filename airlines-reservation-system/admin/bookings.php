<?php
session_start();
if(isset($_SESSION['admin_id'])){}
else {
  header("location:../adminlogin.php");
 }
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../assets/adminStyle.css" >
      <title>Bookings</title>
</head>
<body>
      <header>
            <a name="top"></a>
      <nav>
        <div class="logo">Brand</div> 
          <input type="checkbox" id="click">
          <label for="click" class="menu-btn"><i class="fa fa-bars"></i></label>
        <ul>
          <li><a href="homepage.php" >Home</a></li>
          <li><a href="flights.php" >Flights</a></li>
          <li><a href="airlines.php">Airlines</a></li>
          <li><a href="#" class="active">Bookings</a> </li>
          <li> <a href="users.php" >Users</a></li>
          <li><a href="transactions.php">Transactions</a></li>
          <li><a  href="../signout.php">Log Out</a></li>
        </ul>
        </nav>
      </header>
      <form ><input type='submit' class='button' name='bookNewFlight' value='Book New Flight'></form>
      
      <table>    
           <tr>
           <th>Booking ID</th>
           <th>Passenger Id</th>
           <th>Flight Id</th>
           <th>Airlines</th>
           <th>Ticket Type</th>
           <th>Booking Date</th>
           <th>Price $</th>
           </tr>

           <?php

include "../repository/dbConnection.php";
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
           <td>".$row['passenger_id']."</td>
           <td> ".$row['flight_id']."</td>
           <td>".$row['airline_id']."</td>
           <td>".$row['ticket_type']."</td>
           <td>".$row['booking_date']."</td>
           <td>$".$row['price']."</td>
           
           <td  align='center'><button class='button'><a style='text-decoration:none' href='bookings.php?deleteBooking=".$row['booking_id']."'>Delete</a></td>
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
if(isset($_GET['bookNewFlight'])){
      echo "<fieldset>
      <legend><h1>Book New Flight</h1></legend>
      <table >
      <a name='bookNewFlight'></a>
      <form action='bookings.php' method='post'>

            <tr>
                  <td><label for='passenger_id'>Passenger Id</label></td>
                  <td><input type='number' id='passenger_id' name='passenger_id' placeholder='Passenger Id' required></td>
            </tr>
            <tr>
                  <td><label for='flight_id'>Flight Id</label></td>
                  <td><input type='text' id='flight_id' name='flight_id' placeholder='Flight Id' required></td>
            </tr>
            <tr>
                  <td><label for='airline_id'>Airline Id</label></td>
                  <td><input type='number' id='airline_id' name='airline_id' placeholder='Airline Id'  required></td>
            </tr>
            <tr>
            <td><label for='ticket_type'>Ticket type</label></td>
            <td>
            <select name='ticket_type' id='   '>
                      <option value='Economy'>Economy</option>
                      <option value='Business'>Business</option>
                      </select>
            </td>
            </tr>
            <tr>
                  <td><label for='booking_date'>Booking Date</label></td>
                  <td><input type='date' id='booking_date' name='booking_date' placeholder='Booking Date' autocomplete='on' required></td>
            </tr>
            <tr>
                  <td><label for='price'>Price</label></td>
                  <td><input type='number' id='price' name='price' placeholder='price'  required></td>
            </tr>
             <tr>
                   <td colspan='2'><a href='bookings.php'><input class='button' type='submit' name='addnewbooking' value='Insert'></a></td>
             </tr>
      </form>
      <tr>
                   <td colspan='2'><a href='bookings.php'><input class='button' type='submit' value='Cancel'></a></td>
            </tr>
      </table>
      </fieldset>";
}
      if(isset($_POST['addnewbooking'])){
            if( isset($_POST['passenger_id'])& isset($_POST['flight_id'])& isset($_POST['airline_id']) & isset($_POST['ticket_type']) & isset($_POST['booking_date'])  & isset($_POST['price']) ) {
                  
                  $passenger_id=$_POST['passenger_id'];
                  $flight_id=$_POST['flight_id'];
                  $airline_id=$_POST['airline_id'];
                  $ticket_type=$_POST['ticket_type'];
                  $booking_date=$_POST['booking_date'];
                  $price=$_POST['price'];
                  if($conn){
                     $sql="SELECT *FROM bookings  where booking_id='$booking_id';";
                     $result=mysqli_query($conn,$sql);
                     $sql="SELECT *FROM flights WHERE flight_id='$flight_id' and airline_id='$airline_id';"; //check if seat is available 
                     $get_available_seats=mysqli_query($conn,$sql);
                     if($get_available_seats){
                        $row = mysqli_fetch_assoc($get_available_seats);
                        $available_seat=$row['available_capacity'];

                     }
                     if($available_seat>=1){
                         if(mysqli_num_rows($result)>=1) {
                              $query="UPDATE bookings SET passenger_id='$passenger_id',flight_id='$flight_id',airline_id='$airline_id',ticket_type='$ticket_type',booking_date='$booking_date',price='$price'  where booking_id='$booking_id';";  // update if already exist
                              $update=mysqli_query($conn,$query);
                              if($update){
                                    header("refresh:1;");
                              }
                              else{
                                    echo "<script> alert('error'); </script>";
                              }
                           }
                            else{
                              $query="INSERT INTO bookings (passenger_id,flight_id,airline_id,ticket_type,booking_date,price)  VALUES ('$passenger_id','$flight_id','$airline_id','$ticket_type','$booking_date','$price');"; 
                              $update=mysqli_query($conn,$query);
                                     if($update){
      
                                    $updateAvailableSeat="UPDATE flights SET available_capacity=available_capacity-1 WHERE flight_id='$flight_id';";  // update available seats
                                    $transaction_query="INSERT INTO transactions(flight_id,passenger_id,amount)VALUES('$flight_id','$passenger_id','$price')" ;//update transaction
                                    $check_transaction=mysqli_query($conn,$transaction_query);
                                    $check=mysqli_query($conn,$updateAvailableSeat);
                                         if($check & $check_transaction){
                                          header("refresh:1;");
      
                                           }
                                    }
                                            else{
                                                   echo "<script> alert('error'); </script>";
                                                }
                              }

                        } 
                  }


      }
}

            if(isset($_GET['bid']) & isset($_GET['pid'])& isset($_GET['aid'])& isset($_GET['fid']) & isset($_GET['bdate'])& isset($_GET['ticy'])& isset($_GET['pr']) ){
                  echo "<fieldset>
                  <legend><h1>Book New Flight</h1></legend>
                  <table >
                  <a name='bookNewFlight'></a>
                  <form action='bookings.php' method='post'>
                        <tr>
                              <td><label for='booking_id'>Booking Id</label></td>
                              <td><input type='number' id='booking_id' name='booking_id' value=".$_GET['bid']." placeholder='Booking Id' readonly required></td>
                        </tr>
                        <tr>
                              <td><label for='passenger_id'>Passenger Id</label></td>
                              <td><input type='number' id='passenger_id' name='passenger_id' value=".$_GET['pid']." placeholder='Passenger Id' required></td>
                        </tr>
                        <tr>
                              <td><label for='flight_id'>Flight Id</label></td>
                              <td><input type='text' id='flight_id' name='flight_id' value=".$_GET['fid']." placeholder='Flight Id' required></td>
                        </tr>
                        <tr>
                              <td><label for='airline_id'>Airline Id</label></td>
                              <td><input type='number' id='airline_id' name='airline_id' value=".$_GET['aid']." placeholder='Airline Id'  required></td>
                        </tr>
                        <tr>
                        <td><label for='ticket_type'>Ticket type</label></td>
                        <td>
                        <select name='ticket_type' id='ticket_type' >
                                  <option value='Economy'>Economy</option>
                                  <option value='Business'>Business</option>
                                  </select>
                        </td>
                        </tr>
                        <tr>
                              <td><label for='booking_date'>Booking Date</label></td>
                              <td><input type='date' id='booking_date' name='booking_date' value=".$_GET['bdate']." placeholder='Booking Date' autocomplete='on' required></td>
                        </tr>
                        <tr>
                              <td><label for='price'>Price</label></td>
                              <td><input type='number' id='price' name='price'  value=".$_GET['pr']." placeholder='price'  readonly required></td>
                        </tr>
                         <tr>
                               <td colspan='2'><a href='bookings.php'><input class='button' type='submit' name='addnewbooking' value='Insert'></a></td>
                         </tr>
                  </form>
                  <tr>
                               <td colspan='2'><a href='bookings.php'><input class='button' type='submit' value='Cancel'></a></td>
                        </tr>
                  </table>
                  </fieldset>";
            }
      
?>
</body>
</html>