<?php

session_start();
unset($_SESSION['admin_id']);
unset($_SESSION['user_id']);
session_destroy();
header("refresh:1; url=index.php")

?>