<?php
include "dbConnection.php";
$conn=dbConnection();
session_start();
$departure=$_REQUEST["dep"];
$destination=$_REQUEST["arr"];
$flight_id=$_REQUEST['fid'];
$a_time=$_REQUEST['at'];
$d_time=$_REQUEST['dt'];
$eprice=$_REQUEST['ep'];
$bprice=$_REQUEST['bp'];
$acap=$_REQUEST['acap'];
$aid=$_REQUEST['aid'];
$pid=11;
$price=0;


if(isset($_REQUEST['fid']) & isset($_REQUEST["arr"]) & isset($_REQUEST["dep"]) & isset($_REQUEST['at']) & isset($_REQUEST['dt']) & isset($_REQUEST['ep']) & isset($_REQUEST['bp']) & isset($_REQUEST['acap']) & isset($_REQUEST['aid']) ){
      echo "<fieldset>
      <legend><h1>Book New Flight</h1></legend>
      <table >
      <a name='bookNewFlight'></a>
      <form action='bookings.php' method='post'>
            <tr>
                  <td><label for='flight_id'>Flight Id</label></td>
                  <td><input type='text' id='flight_id' name='flight_id' value=".$_REQUEST['fid']." placeholder='Flight Id' readonly></td>
            </tr>
            <tr>
                  <td><label for='airline_id'>Airline Id</label></td>
                  <td><input type='number' id='airline_id' name='airline_id' value=".$_REQUEST['aid']." placeholder='Airline Id'  readonly></td>
            </tr>
            <tr>
                  <td><label for='departure'>Departure</label></td>
                  <td><input type='text' id='departure' name='departure' value=".$_REQUEST['dep']." placeholder='departure'  readonly></td>
            </tr>
            <tr>
                  <td><label for='destination'>Destination</label></td>
                  <td><input type='text' id='destination' name='destination' value=".$_REQUEST['arr']." placeholder='destination'  readonly></td>
            </tr>
            <tr>
            <td><label for='ticket_type'>Ticket type</label></td>
            <td>
            <label>Economy price=".$eprice." Business Price=".$bprice."</label>
            <select name='ticket_type' id='ticket_type' >
                      <option id='economy' value='Economy'.>Economy</option>
                      <option id='business' value='Business'>Business</option>
                      </select>
            </td>
            </tr>
             <tr>
                   <td colspan='2'><input class='button' type='submit' name='confirmbooking' value='Confirm Booking' onclick='confirmbooking()'></td>
             </tr>
      </form>
      <tr>
                   <td colspan='2'><a href='index.php'><input class='button' type='submit' value='Cancel'></a></td>
            </tr>
      </table>
      </fieldset>";

}
else if(isset($_POST['insertBooking'])){
      echo "<script> console.log(222222222); </script>";
       $ticket_type = $_POST['ticket_type'];
       if($ticket_type=="Economy"){
             $price=$eprice;
       }
       else{
             $price=$bprice;
       }
       
             if($conn){
                $sql="SELECT *FROM flights WHERE flight_id='$fid' and airline_id='$aid';"; //check if seat is available 
                $get_available_seats=mysqli_query($conn,$sql);
                if($get_available_seats){
                   $row = mysqli_fetch_assoc($get_available_seats);
                   $available_seat=$row['available_capacity'];

                }
                if($available_seat>=1){
                    if(mysqli_num_rows($result)>=1) {
                         $query="UPDATE bookings SET passenger_id='$pid',flight_id='$fid',airline_id='$aid',ticket_type='$ticket_type',booking_date='$booking_date',price='$price'  where booking_id='$booking_id';";  // update if already exist
                         $update=mysqli_query($conn,$query);
                         if($update){
                               header("refresh:1;");
                         }
                         else{
                               echo "<script> alert('error'); </script>";
                         }
                      }
                       else{
                         $query="INSERT INTO bookings (passenger_id,flight_id,airline_id,ticket_type,booking_date,price)  VALUES ('$pid','$fid','$aid','$ticket_type','$booking_date','$price');"; 
                         $update=mysqli_query($conn,$query);
                                if($update){

                               $updateAvailableSeat="UPDATE flights SET available_capacity=available_capacity-1 WHERE flight_id='$fid';";  // update available seats
                               $transaction_query="INSERT INTO transactions(flight_id,passenger_id,amount)VALUES('$fid','$pid','$price')" ;//update transaction
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

      

?>
