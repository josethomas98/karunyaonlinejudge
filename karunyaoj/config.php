<?php

//echo ("connecting");
$host = "127.0.0.1";
//$port = getenv("MYSQL_SERVICE_PORT");
$user ="sdadmin";
$pass = "Admin-4321";
$db =   "karunya";

$con=mysqli_connect($host,$user,$pass,$db);

if(!$con)
{
	print("Not Connected<br>".mysql_error());

}
else
{
//	echo("Connected");
}






?>
