<?php

	$host 	= "127.0.0.1";
	$dbuser = "root";
	$dbpass	= "";
	$dbname	= "airline-reservation-system";

	function dbConnection(){

		global $host;
		global $dbuser;
		global $dbpass;
		global $dbname;

		return mysqli_connect($host, $dbuser, $dbpass, $dbname);
	}

?>