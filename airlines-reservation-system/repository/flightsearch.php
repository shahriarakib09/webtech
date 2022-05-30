<?php
include "dbConnection.php";
$conn=dbConnection();

$departure=$_REQUEST["departure"];
$destination=$_REQUEST["destination"];
$d_airport="";
$a_airport="";
$sql="SELECT iata FROM airports where airport_name='$departure';"; // get departure airport iata
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result); {
            
            $d_airport=$row['iata'];
      }}
      $sql="SELECT iata FROM airports where airport_name='$destination';"; // get destination airport iata
      $result=mysqli_query($conn,$sql);
      if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result); {
            
            $a_airport=$row['iata'];
      }}
      // get all availabe flights
           echo "
           <table>    
           <tr>
           <th>Flight ID</th>
           <th>Airline ID</th>
           <th> Departure </th>
           <th>Arrival</th>
           <th>Departure Time</th>
           <th>Arrival Time</th>
           <th>Econ Price</th>
           <th>Buss Price</th>
           <th>Available Seats</th>
           <th>Book</th>
           </tr>";
$query="SELECT flight_id,airline_id,departure,arrival,dtime,atime,eprice,bprice,available_capacity FROM flights where departure='$d_airport' and arrival='$a_airport';";
$result=mysqli_query($conn,$query);
if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) { 
            echo "
           <tr>
           <td id='fid'>".$row['flight_id']."</td>
           <td id='aid'>".$row['airline_id']."</td>
           <td id='dep'> ".$row['departure']."</td>
           <td id='arr'>".$row['arrival']."</td>
           <td id='dt'>".$row['dtime']."</td>
           <td id='at'>".$row['atime']."</td>
           <td id='ep'>$".$row['eprice']."</td>
           <td id='bp'>$".$row['bprice']."</td>
           <td id='acap'>".$row['available_capacity']."</td>
           <td  align='center'><button class='button' id='book_flight' value='Book' onclick='flightbooking()'>Book</button>
           </tr>";
      }
}
   echo "</form></table>"; 


   //<a  style='text-decoration:none' href='bookflight.php?fid=".$row['flight_id']."&dep=".$row['departure']."&arr=".$row['arrival']."&dt=".$row['dtime']."&at=".$row['atime']."&epr=".$row['eprice']."&bpr=".$row['bprice']."'>Book</a></td>
   ?>