<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="assets/userloginStyle.css" >
</head>
<body>
<h1 class="header">ABC Flight Reservations</h1>
<section class="center">
    

    <form method="post">

        
        <h1 class="admin_header">User Login</h1><br>
        <div class="items">
            <input  type="email" name="email"  placeholder="Email" required>
        </div>
        <div class="items">
        <input  type="password" name="password"  placeholder="Password" required>

        </div>
        </div>
        <div class="items">
        <input  type="submit" value="login">

        </div>
        <div class="items">
        <a href="adminlogin.php">Login as admin</a><br><br>
        <a href="signup.php">Create an account?</a><br><br>
        <a href="forgot.php">Forgot Password?

        </div>
            
        
    </form>
</section>
    
</body>
</html>

<?php 

session_start();

    include "repository/dbConnection.php";

    $conn=dbConnection();




        if(isset($_POST['email'])& isset($_POST['password'])){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        //$sha1pass = sha1($password);

        if(!empty($email) && !empty($password) && !is_numeric($email))
        {

            //read from database
            $query = "select * from users where email = '$email' limit 1";
            $result = mysqli_query(dbConnection(), $query);

            if($result)
            {
                if( mysqli_num_rows($result) > 0)
                {

                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['password'] === $password )
                    {

                        $_SESSION['user_id'] = $user_data['user_id'];
                       
                        
                        header("Location: index.php");
                       
                       
                        
                    
                        echo "<script> alert('login Successfull'); </script>";


                        die;
                    }
                }
            }

            echo "wrong username or password!";
        }else
        {
            echo "wrong username or password!";
        }
    }

?>