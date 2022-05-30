<?php
session_start();
if(isset($_SESSION['admin_id'])){}
else {
  header("location:../adminlogin.php");
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
          <li><a href="homepage.php" >Home</a></li>
          <li><a href="flights.php" >Flights</a></li>
          <li><a href="#" class="active">Airlines</a></li>
          <li><a href="bookings.php" >Bookings</a> </li>
          <li> <a href="users.php" >Users</a></li>
          <li><a href="transactions.php">Transactions</a></li>
          <li><a  href="../signout.php">Log Out</a></li>
        </ul>
        </nav>

      </header>
      <form ><input type='submit' class='button' name='insertAirlines' value='Insert New Airlines'></form>
      <table>    
           <tr>
           <th>Airline ID</th>
           <th>Airline Name</th>
           <th>Contact Info</th>
           <th>Flights</th>
           </tr>

<?php
      include "../repository/dbConnection.php";
$query="SELECT *FROM airlines";
$conn=dbConnection();
$result=mysqli_query($conn,$query);
if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) { 


            echo "

            <tr>
           <td>".$row['airline_id']."</td>
           <td>".$row['airline_name']."</td>
           <td> ".$row['contact_info']."</td>
           <td  align='center'><button class='button'><a style='text-decoration:none' href='airlines.php?deleteAirlines=".$row['airline_id']."'>Delete</a></td>
           <td  align='center'><button class='button'><a style='text-decoration:none' href='airlines.php?viewFlights=".$row['airline_id']."&aname=".$row['airline_name']."'>View Flights</a></td>
           </tr>";

}}

if(isset($_GET['deleteAirlines'])){

   $aid=$_GET['deleteAirlines'];
  $query="DELETE from airlines WHERE airline_id='$aid';";
  $sql="UPDATE flights set status='cancelled' where airline_id='$aid';";
  if($conn){
    $verify1=mysqli_query($conn,$query);
    $verify2=mysqli_query($conn,$sql);
    if($verify1 & $verify2){
      header("refresh:1;");
    }
  }
}
if(isset($_GET['viewFlights'])){
  $aid=$_GET['viewFlights'];
  $aname=$_GET['aname'];
  $query="SELECT *FROM flights WHERE airline_id='$aid';";
  $conn=dbConnection();
  $result=mysqli_query($conn,$query);
  if (mysqli_num_rows($result) > 0) {

        echo "
      
       
        <table>  
        <tr >
        <td colspan='13'><h1>".$aname." Flights<h1></td>
        <tr>  
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
        <th colspan='2'>Operations</td>
        </tr>
        ";

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
             </tr></table>";

             
  }}

}
?>
</form>
</table>
<?php
if(isset($_GET['insertAirlines'])){

  echo "<fieldset>
  <legend><h1>Add New Flight</h1></legend>
  <table >
  <a name='addnewairlines'></a>
  <form action='airlines.php' method='post'>
        <tr>
              <td><label for='airline_id'>Airline Id..</label></td>
              <td><input type='number' id='airline_id' name='airline_id' placeholder='Airline Id' required></td>
        </tr>
  <tr>
        <td><label for='airline_name'>Airline Name</label></td>
        <td><input type='text' id='airline_name' name='airline_name' placeholder='Airline Name..'  required></td>
   </tr>
        <tr>
              <td><label for='contact'>Contact Info</label></td>
              <td><input type='text' id='contact' name='contact' placeholder='Contact Info..'  required></td>
        </tr>
         <tr>
               <td colspan='2'><a href='flights.php'><input class='button' type='submit' name='insertNewAirline' value='Insert'></a></td>
         </tr>
  </form>
  <tr>
               <td colspan='2'><a href='flights.php'><input class='button' type='submit' value='Cancel'></a></td>
        </tr>
  </table>
  </fieldset>";

}
if(isset($_POST['insertNewAirline'])){
  if(isset($_POST['airline_id'])& isset($_POST['airline_name'])& isset($_POST['contact'])){
    $aid=$_POST['airline_id'];
    $aname=$_POST['airline_name'];
    $contact=$_POST['contact'];
    if($conn){
      $sql="SELECT *FROM airlines  where airline_id='$aid';";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)>=1) {
        $query="UPDATE airlines SET airline_name='$aname',contact_info='$contact'  where airline_id='$aid';";  // update if already exist
        $update=mysqli_query($conn,$query);
        if($update){
              echo "<script> alert('Updated'); </script>";
        }
        else{
              echo "<script> alert('error'); </script>";
        }
     }
      else{
        $query="INSERT INTO airlines (airline_id,airline_name,contact_info)  VALUES ('$aid','$aname','$contact');";  
        $update=mysqli_query($conn,$query);
        if($update){
              header("refresh:1;");
        }
        else{
              echo "<script> alert(' oops error'); </script>";
        }

    }

  }
}}

          
      ?>
      </form>
</table>

</body>
</html>