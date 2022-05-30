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
     
      <title>Users</title>
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
          <li><a href="airlines.php" >Airlines</a></li>
          <li><a href="bookings.php" >Bookings</a> </li>
          <li> <a href="#" class="active">Users</a></li>
          <li><a href="transactions.php" >Transactions</a></li>
          <li><a  href="../signout.php">Log Out</a></li>
        </ul>
        </nav>

      </header>

</body>
</html> 
      
      
      <table>    
           <tr>
           <th>User ID</th>
           <th>Username</th>
           <th>Email </th>
           <th>Date of Birth</th>
           <th>Phone no.</th>
           <th>Passport</th>
           </tr>
      <?php

include "../repository/dbConnection.php";
$query="SELECT *FROM users";
$conn=dbConnection();
$result=mysqli_query($conn,$query);
if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) { 


            echo "

        <tr>
           <td>".$row['user_id']."</td>
           <td> ".$row['user_name']."</td>
           <td>".$row['email']."</td>
           <td>".$row['date_of_birth']."</td>
           <td>".$row['phone_no']."</td>
           <td>".$row['passport']."</td>           
           <td  align='center'><button class='button'><a  style='text-decoration:none' href='users.php?uid=".$row['user_id']."&uname=".$row['user_name']."&email=".$row['email']."&dob=".$row['date_of_birth']."&phn=".$row['phone_no']."&pass=".$row['passport']."'>Update</a></td>
           <td  align='center'><button class='button'><a style='text-decoration:none' href='users.php?deleteuser=".$row['user_id']."'>Delete</a></td>
           </tr>";

}}
?>
      </form>
</table>
<?php
if(isset($_GET['deleteuser'])){
    $user_id=$_GET['deleteuser'];
    if($conn){
          $query="DELETE FROM users where user_id='$user_id';";
          $update=mysqli_query($conn,$query);
          if($update){
               echo "('Deleted'); ";
             
          }
          else{
                echo "(' 404 error'); ";
          }
    }

}
if(isset($_GET['uid']) & isset($_GET['uname'])& isset($_GET['email'])& isset($_GET['dob']) & isset($_GET['phn']) & isset($_GET['pass']) ){
    echo "<fieldset>
    <legend><h1>Update User</h1></legend>
    <table >
    <a name='updateUser'></a>
    <form action='users.php' method='post'>
          <tr>
                <td><label for='uid'>User Id</label></td>
                <td><input type='text' id='uid' name='user_id' placeholder='User Id' VALUE=".$_GET['uid']." readonly required></td>
          </tr>
          <tr>
                <td><label for='uname'>Username</label></td>
                <td><input type='text' id='uname' name='user_name' placeholder='Username' VALUE=".$_GET['uname']." required></td>
          </tr>
          <tr>
                <td><label for='email'>Email</label></td>
                <td><input type='text' id='email' name='email' placeholder='Email' VALUE=".$_GET['email']." required></td>
          </tr>
          <tr>
                <td><label for='dob'>Date of birth</label></td>
                <td><input type='date' id='dob' name='date_of_birth' placeholder='Date of birth' VALUE=".$_GET['dob']." required></td>
          </tr>

          <tr>
          <td><label for='phn'>phone_no</label></td>
          <td><input type='number' id='phn' name='phone_no' placeholder='phone no' VALUE=".$_GET['phone_no']." required></td>
          </tr>

          <tr>
          <td><label for='pass'>Passport</label></td>
          <td><input type='pass' id='pass' name='passport' placeholder='passport' VALUE=".$_GET['pass']." required></td>
          </tr>
          
                 <td colspan='2'><a href='users.php'><input class='button' type='submit' name='updateInfo' value='Update'></a></td>
           </tr>
    </form>
    <tr>
                 <td colspan='2'><a href='users.php'><input class='button' type='submit' value='Cancel'></a></td>
          </tr>
    </table>
    </fieldset>";
}

if(isset($_POST['updateInfo'])){
    if(isset($_POST['user_id']) & isset($_POST['user_name'])& isset($_POST['password'])& isset($_POST['email']) & isset($_POST['date_of_birth']) & isset($_POST['phone_no'])& isset($_POST['passport']) ){
        $userid=$_POST['user_id'];
        $username= $_POST['user_name'];
        $password= $_POST['password'];
        $email= $_POST['email'];
        $date_of_birth = $_POST['date_of_birth'];
        $phone_no =$_POST['phone_no'];
        $passport= $_POST['passport'];

    if($conn){
          $sql="SELECT *FROM users  where user_id='$userid';";
          $result=mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)>=1) {
                $query="UPDATE  users  SET user_name='$username',password='$password',email='$email',date_of_birth='$date_of_birth',phone_no='$phone_no',passport=' $passport' where user_id= '$userid';" ; 
                $update=mysqli_query($conn,$query);
                if($update){
                      echo "('Updated');";
                }
                else{
                      echo "('error'); ";
                }
          }
          else{
                $query="INSERT INTO users `(`user_id`, `user_name`, `email`,`date_of_birth`, `phone_no`, `passport`)  VALUES ('$userid','$username','$email','$date_of_birth','$phone_no','$passport');"; 
                $update=mysqli_query($conn,$query);
                if($update){
                      echo "('Data Inserted'); ";
                }
                else{
                      echo "('error'); ";
                }
          }
    }
}}


class User{
    private $user_id;
    private $user_name;
    private $email;
    private $date_of_birth;
    private $phone_no;
    private $passport;

function __construct($user_id,$user_name,$email,$date_of_birth,$phone_no,$passport){
    $this->user_id=$user_id;
    $this->user_name=$user_name;
    $this->email=$email;
    $this->date_of_birth=$date_of_birth;
    $this->phone_no=$phone_no;
    $this->passport=$passport;
}
}
function UpdateUser(user $user){
    if($con){
          $sql="SELECT *FROM users where user_id='$user->user_id';";
          $result=mysqli_query($con,$sql);
          if(mysqli_num_rows($result)>=1) {
                 $query="UPDATE users SET user_id='$user->user_id',user_name='$user->user_name',email='$user->email',phone_no='$user->phone_no',passport='$user->passport';";  
                $update=mysqli_query($con,$query);
                if($verify){
                      return true;
                }
                else{
                      return false;
                }
          }
          else{
                $query="INSERT INTO users (user_name,password,email,date_of_birth,phone_no,passport)VALUES('$username','$password','$email','$date_of_birth','$phone_no','$passport')";
                $update=mysqli_query($con,$query);
                if($verify){
                      return true;
                }
                else{
                      return false;
                }
          }
    }
    

    return false;
}



 function DeleteUser(user $user){
    if($con){
          $query="DELETE FROM users where user_id='$user->user_id';";
          $update=mysqli_query($con,$query);
          if($verify){
                return true;
          }
          else{
                return false;
          }      

    }
    return false;      
}




/*if(isset($_POST["submit"]))
{

$userid=$_POST['user_id'];
$username= $_POST['user_name'];
$password= $_POST['password'];
$email= $_POST['email'];
$dob= $_POST['date_of_birth'];
$phone_no= $_POST['phone_no'];
$passport= $_POST['passport'];


$sql ="INSERT INTO users(user_name,password,email,date_of_birth,phone_no,passport)VALUES('$username','$password','$email','$date_of_birth','$phone_no','$passport')";
  
 if(mysqli_query(dbConnection(),$sql))
 {
     echo"<h1>TASK DONE </h1>";
 }
 

}*/
?>
</body>
</html>
