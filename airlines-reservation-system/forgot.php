<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="assets/forgotStyle.css" >
</head>
<body>
<h1 class="header">ABC Flight Reservations</h1>
<section class="center">
    

    <form method="post">

        
        <h1 class="admin_header">Forgot Password</h1><br>
        <div class="items">
            <input  type="email" name="email"  placeholder="Email" required>
        </div>
        <div class="items">
            <input  type="date" name="date_of_birth"  placeholder="Date of birth" required>
        </div>
        <div class="items">
        <input  type="password" name="password"  placeholder="Password" required>

        </div>
        <div class="items">
        <input  type="password" name="cpassword"  placeholder="Confirm Password" required>

        </div>
        </div>
        <div class="items">
        <input  type="submit" value="Submit">

        </div>
        <div class="items">
        <a href="userlogin.php">Back</a><br><br>
        
        

        </div>
            
        
    </form>
</section>
    
</body>
</html>

<?php
session_start();

include "repository/dbConnection.php";

$conn=dbConnection();

function email_exists($email,$conn)
{
    $row=mysqli_query($conn," SELECT user_id FROM users WHERE email='$email'");
    {
        if(mysqli_num_rows($row)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
$msg='';

if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $date=$_POST['date_of_birth'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];

    if(empty($email))
    {
        $msg="Please Enter your email";
    }
    else if($password!=$cpassword)
    {
        echo "Password do no match";
    }
    else if(email_exists($email,$conn))
    {
        $query="SELECT date_of_birth FROM users WHERE email='$email'";
        $result=mysqli_query($conn,$query);
        $retrive=mysqli_fetch_array($result);
        $DOB=$retrive['date_of_birth'];
        if($date==$DOB)
        {
            mysqli_query($conn,"UPDATE users SET password='$password' WHERE email='$email'");
            echo "Password Changed Successfully";
        }
        else
        {
            echo "Date of birth id wrong";
        }

    }
    else
    {
        echo "Email does no exists";

    }
    
}
?>