<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="assets/signupStyle.css" >

</head>
<body>
<h1 class="header">ABC Flight Reservations</h1>
<section class="center">
    

    <form method="post">

        
        <h1 class="signup_header">Signup</h1><br>
        <div class="items">
            <input  type="text" name="user_name"  placeholder="Username" required>
        </div>
        <div class="items">
        <input  type="password" name="password"  placeholder="Password" required>

        </div>
        <div class="items">
        <input  type="password" name="confirmpassword"  placeholder="Confirm Password" required>

        </div>
        <div class="items">
        <input  type="email" name="email"  placeholder="Email" required>

        </div>
        <div class="items">
        <input  type="date" name="date_of_birth"  placeholder="Date of birth" required>

        </div>
        <div class="items">
        <input  type="number" name="phone_no"  placeholder="Phone" required>

        </div>
        <div class="items">
        <input  type="text" name="passport"  placeholder="Passport" required>

        </div>
        <div class="items">
        <input  type="submit" value="Signup">

        </div>
        <div class="items">
        <a href="userlogin.php">Already have an account? Login here</a>

        </div>
            
        
    </form>
</section>
    
</body>
</html>

<?php 
session_start();

    include "repository/dbConnection.php";
    $conn=dbConnection();


    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name = mysqli_real_escape_string($conn,$_POST['user_name']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $cpassword=mysqli_real_escape_string($conn,$_POST['confirmpassword']);
        $email= mysqli_real_escape_string($conn,$_POST['email']);
        $phoneno=mysqli_real_escape_string($conn,$_POST['phone_no']);
        $dob=mysqli_real_escape_string($conn,$_POST['date_of_birth']);
        $passport=mysqli_real_escape_string($conn,$_POST['passport']);

        //$sha1pass= sha1($password);

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name)&& !empty($cpassword) && $password==$cpassword && !empty($email)&& !empty($phoneno)&& !empty($dob)&& !empty($passport))
        {

            //save to database

            $query = "insert into users (user_name,password,email,date_of_birth,phone_no,Passport) values ('$user_name','$password','$email','$dob','$phoneno','$passport')";

            if(mysqli_query(dbConnection(), $query)){

                echo "Sign up successfull";

            }
        }
        else
        {
            echo "Please Fill up the form correctly!";
        }
    }
?>