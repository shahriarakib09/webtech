<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="assets/adminloginStyle.css" >
</head>
<body>
<h1 class="header">ABC Flight Reservations</h1>
<section class="center">
    

    <form method="post">

        
        <h1 class="admin_header">Admin Login</h1><br>
        <div class="items">
            <input  type="text" name="admin_name"  placeholder="Username" required>
        </div>
        <div class="items">
        <input  type="password" name="admin_password"  placeholder="Password" required>

        </div>
        </div>
        <div class="items">
        <input  type="submit" value="login">

        </div>
        <div class="items">
        <a href="userlogin.php">Login as a User</a>

        </div>
            
        
    </form>
</section>
    
</body>
</html>

<?php 
session_start();
include("repository/dbConnection.php");



//if($_SERVER['REQUEST_METHOD'] == "POST")

    if(isset($_POST['admin_name'])& isset($_POST['admin_password'])){
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];
    //$sha1pass = sha1($password);

    if(!empty($admin_name) && !empty($admin_password) && !is_numeric($admin_name))
    
    {

        //read from database
        $query = "select * from admins where admin_name = '$admin_name' and admin_password='$admin_password';";
        $result = mysqli_query(dbConnection(), $query);
        if(mysqli_num_rows($result)==1)
        {
                    session_start();
                    $_SESSION['admin_id'] = $admin_name;

                    
                    header("Location: admin/homepage.php");
                    die;
                    
                }
                else{echo "wrong username or password!";}
            }
        else{echo "wrong username or password!";}
    }

        
    
    


?>
