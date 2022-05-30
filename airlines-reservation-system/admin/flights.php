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
      <title>Flights</title>
</head>
<body>
      <header>
            <a name="top"></a>
      <nav>
        <div class="logo"> Brand</div>
          <input type="checkbox" id="click">
          <label for="click" class="menu-btn"><i class="fa fa-bars"></i></label>
        <ul>
          <li><a href="homepage.php" >Home</a></li>
          <li><a href="#" class="active">Flights</a></li>
          <li><a href="airlines.php">Airlines</a></li>
          <li><a href="bookings.php" >Bookings</a> </li>
          <li> <a href="users.php" >Users</a></li>
          <li><a href="transactions.php">Transactions</a></li>
          <li><a  href="../signout.php">Log Out</a></li>
        </ul>
        </nav>
      </header>
      <form ><input type='submit' class='button' name='insertFlight' value='Insert New Flight'></form>
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
           <th>Capacity</th>
           <th>Available Seats</th>
           <th>Status</th>
           </tr>
      <?php

include "../repository/dbConnection.php";
$query="SELECT *FROM flights";
$conn=dbConnection();
$result=mysqli_query($conn,$query);
if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) { 


            echo "

        <tr>
           <td>".$row['flight_id']."</td>
           <td>".$row['airline_id']."</td>
           <td> ".$row['departure']."</td>
           <td>".$row['arrival']."</td>
           <td>".$row['dtime']."</td>
           <td>".$row['atime']."</td>
           <td>$".$row['eprice']."</td>
           <td>$".$row['bprice']."</td>
           <td>".$row['total_capacity']."</td>
           <td>".$row['available_capacity']."</td>
           <td>".$row['status']."</td>
           <td  align='center'><button class='button'><a  style='text-decoration:none' href='flights.php?fid=".$row['flight_id']."&aid=".$row['airline_id']."&dep=".$row['departure']."&arr=".$row['arrival']."&dt=".$row['dtime']."&at=".$row['atime']."&tcap=".$row['total_capacity']."&acap=".$row['available_capacity']."&st=".$row['status']."&epr=".$row['eprice']."&bpr=".$row['bprice']."'>Update</a></td>
           <td  align='center'><button class='button'><a style='text-decoration:none' href='flights.php?deleteFlight=".$row['flight_id']."'>Delete</a></td>
           </tr>";

}}
          
      ?>
      </form>
</table>
<?php
 if(isset($_GET['deleteFlight'])){
      $fid=$_GET['deleteFlight'];
      if($conn){
            $query="DELETE FROM flights where flight_id='$fid';";
            $update=mysqli_query($conn,$query);
            if($update){
                  header("refresh:1;");
               
            }
            else{
                  echo "<script> alert(' 404 error'); </script>";
            }
      }

}
if(isset($_GET['fid']) & isset($_GET['aid'])& isset($_GET['dep'])& isset($_GET['arr']) & isset($_GET['dt']) & isset($_GET['at'])& isset($_GET['st']) & isset($_GET['tcap']) & isset($_GET['epr']) & isset($_GET['bpr']) ){
      echo "<fieldset>
      <legend><h1>Update Flight</h1></legend>
      <table >
      <a name='updateFlight'></a>
      <form action='flights.php' method='post'>
            <tr>
                  <td><label for='flight_id'>Flight Id</label></td>
                  <td><input type='text' id='flight_id' name='flight_id' placeholder='Flight Id' VALUE=".$_GET['fid']." readonly required></td>
            </tr>
            <tr>
                  <td><label for='airline_id'>Airline Id</label></td>
                  <td><input type='number' id='airline_id' name='airline_id' placeholder='Airline Id' VALUE=".$_GET['aid']." required></td>
            </tr>
            <tr>
                  <td><label for='departure'>Departure</label></td>
                  <td><input type='text' id='departure' name='departure' placeholder='Departure' VALUE=".$_GET['dep']." required></td>
            </tr>
            <tr>
                  <td><label for='arrival'>Arrival</label></td>
                  <td><input type='text' id='arrival' name='arrival' placeholder='Arrival' VALUE=".$_GET['arr']." required></td>
            </tr>
            <tr>
            <td><label for='dtime'>Departure Time</label></td>
            <td><input type='datetime-local' id='dtime' name='dtime' placeholder='Departure Time' VALUE=".$_GET['dt']." required></td>
            </tr>
            <tr>
                  <td><label for='atime'>Arrival Time</label></td>
                  <td><input type='datetime-local' id='atime' name='atime' placeholder='Arrival Time' VALUE=".$_GET['at']." required></td>
            </tr>
            <tr>
                  <td><label for='eprice'>Econ Price</label></td>
                  <td><input type='number' id='eprice' name='eprice' placeholder='Econ Price' VALUE=".$_GET['epr']." required></td>
            </tr>
            <tr>
                  <td><label for='bprice'>Buss Price</label></td>
                  <td><input type='number' id='bprice' name='bprice' placeholder='Bus Price' VALUE=".$_GET['bpr']." required></td>
             </tr>
                      
            <tr>
                  <td><label for='capacity'>Capacity</label></td>
                  <td><input type='number' id='capacity' name='capacity' placeholder='capacity' VALUE=".$_GET['tcap']." required></td>
            </tr>
            <tr>
                  <td><label for='status'>Status</label></td>
                  <td><input type='text' id='status' name='status' placeholder='status' VALUE=".$_GET['st']." required></td>
            </tr>
             <tr>
                   <td colspan='2'><a href='flights.php'><input class='button' type='submit' name='updateInfo' value='Update'></a></td>
             </tr>
      </form>
      <tr>
                   <td colspan='2'><a href='flights.php'><input class='button' type='submit' value='Cancel'></a></td>
            </tr>
      </table>
      </fieldset>";
  }

if(isset($_POST['updateInfo'])){
      if(isset($_POST['flight_id']) & isset($_POST['airline_id'])& isset($_POST['departure'])& isset($_POST['arrival']) & isset($_POST['dtime']) & isset($_POST['atime'])& isset($_POST['status']) & isset($_POST['capacity']) & isset($_POST['eprice']) & isset($_POST['bprice'])){
            $flight_id=$_POST['flight_id'];
            $airline_id=$_POST['airline_id'];
            $departure=$_POST['departure'];
            $arrival=$_POST['arrival'];
            $dtime=$_POST['dtime'];
            $atime=$_POST['atime'];
            $eprice=$_POST['eprice'];
            $bprice=$_POST['bprice'];
            $capacity=$_POST['capacity'];
            $status=$_POST['status'];
      if($conn){
            $sql="SELECT *FROM flights  where flight_id='$flight_id';";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>=1) {
                  $query="UPDATE flights SET airline_id='$airline_id',departure='$departure',arrival='$arrival',dtime='$dtime',atime='$atime',total_capacity='$capacity',eprice='$eprice',bprice='$bprice', status='$status'  where flight_id='$flight_id';";   // update if already exist
                  $update=mysqli_query($conn,$query);
                  if($update){
                        echo "<script> alert('Updated'); </script>";
                  }
                  else{
                        echo "<script> alert('404 error'); </script>";
                  }
            }
            else{
                  $query="INSERT INTO flights (flight_id,airline_id,departure,arrival,dtime, atime,total_capacity,available_capacity,eprice,bprice, status)  VALUES ('$flight_id','$airline_id','$departure','$arrival','$dtime','$atime','$capacity',$capacity,'$eprice','$bprice','$status');";  
                  $update=mysqli_query($conn,$query);
                  if($update){
                        echo "<script> alert('Data Inserted'); </script>";
                  }
                  else{
                        echo "<script> alert('error'); </script>";
                  }
            }
      }
}}





if(isset($_GET['insertFlight'])){
      echo "<fieldset>
      <legend><h1>Add New Flight</h1></legend>
      <table >
      <a name='addnewFlight'></a>
      <form action='flights.php' method='post'>
            <tr>
                  <td><label for='flight_id'>Flight Id</label></td>
                  <td><input type='text' id='flight_id' name='flight_id' placeholder='Flight Id' required></td>
            </tr>
            <tr>
                  <td><label for='airline_id'>Airline Id</label></td>
                  <td><input type='number' id='airline_id' name='airline_id' placeholder='Airline Id' required></td>
            </tr>
            <tr>
                  <td><label for='departure'>Departure</label></td>
                  <td><input type='text' id='departure' name='departure' placeholder='Departure' required></td>
            </tr>
            <tr>
                  <td><label for='arrival'>Arrival</label></td>
                  <td><input type='text' id='arrival' name='arrival' placeholder='Arrival'  required></td>
            </tr>
            <tr>
            <td><label for='dtime'>Departure Time</label></td>
            <td><input type='datetime-local' id='dtime' name='dtime' placeholder='Departure Time'  required></td>
            </tr>
            <tr>
                  <td><label for='atime'>Arrival Time</label></td>
                  <td><input type='datetime-local' id='atime' name='atime' placeholder='Arrival Time' required></td>
            </tr>
            <tr>
                  <td><label for='capacity'>Capacity</label></td>
                  <td><input type='number' id='capacity' name='capacity' placeholder='capacity'  required></td>
            </tr>
            <tr>
            <td><label for='eprice'>Econ Price</label></td>
            <td><input type='number' id='eprice' name='eprice' placeholder='Econ Price'  required></td>
      </tr>
      <tr>
            <td><label for='bprice'>Buss Price</label></td>
            <td><input type='number' id='bprice' name='bprice' placeholder='Bus Price'  required></td>
       </tr>
            <tr>
                  <td><label for='status'>Status</label></td>
                  <td><input type='text' id='status' name='status' placeholder='status'  required></td>
            </tr>
             <tr>
                   <td colspan='2'><a href='flights.php'><input class='button' type='submit' name='insertNewFlight' value='Insert'></a></td>
             </tr>
      </form>
      <tr>
                   <td colspan='2'><a href='flights.php'><input class='button' type='submit' value='Cancel'></a></td>
            </tr>
      </table>
      </fieldset>";
}
      if(isset($_POST['insertNewFlight'])){
            if(isset($_POST['flight_id']) & isset($_POST['airline_id'])& isset($_POST['departure'])& isset($_POST['arrival']) & isset($_POST['dtime']) & isset($_POST['atime'])& isset($_POST['status']) & isset($_POST['capacity']) ){
                  $flight_id=$_POST['flight_id'];
                  $airline_id=$_POST['airline_id'];
                  $departure=$_POST['departure'];
                  $arrival=$_POST['arrival'];
                  $dtime=$_POST['dtime'];
                  $atime=$_POST['atime'];
                  $capacity=$_POST['capacity'];
                  $eprice=$_POST['eprice'];
                  $bprice=$_POST['bprice'];
                  $status=$_POST['status'];
                  if($conn){
                     $sql="SELECT *FROM flights  where flight_id='$flight_id';";
                     $result=mysqli_query($conn,$sql);
                     if(mysqli_num_rows($result)>=1) {
                        $query="UPDATE flights SET departure='$departure',arrival='$arrival',dtime='$dtime',atime='$atime',total_capacity='$capacity',eprice='$eprice',bprice='$bprice' status='$status'  where flight_id='$flight_id';";  // update if already exist
                        $update=mysqli_query($conn,$query);
                        if($update){
                              echo "<script> alert('Updated'); </script>";
                        }
                        else{
                              echo "<script> alert('error'); </script>";
                        }
                     }
                      else{
                        $query="INSERT INTO flights (flight_id,airline_id,departure,arrival,dtime, atime,total_capacity,available_capacity,eprice,bprice ,status)  VALUES ('$flight_id','$airline_id','$departure','$arrival','$dtime','$atime','$capacity',$capacity,'$eprice','$bprice','$status');";  
                        $update=mysqli_query($conn,$query);
                        if($update){
                              header("refresh:1;");
                        }
                        else{
                              echo "<script> alert(' oops error'); </script>";
                        }
                  }
            }


      }

      }



?> 
</body>
</html>

