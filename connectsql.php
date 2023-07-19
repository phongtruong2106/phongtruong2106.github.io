<?php

include("lib.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=
	, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php 



	ini_set('display_errors', 1);



    ini_set('display_startup_errors', 1);



    error_reporting(E_ALL);


	$servername = "localhost";



	$database = "gijrkukxhosting_webck";



	$username = "gijrkukxhosting_phongth";



	$password = "21062002_Pt";



	$conn = mysqli_connect($servername, $username, $password, $database);



    if (!$conn) {



        die("Connection failed: " . mysqli_connect_error());



    }



    echo "Connected successfully";



		echo '<br />';







	$un = $_POST['username-log'];



	$pw = $_POST['password-log'];



	echo "abc";



	$sql = "SELECT * FROM `dangnhap` WHERE username = '$un' AND password= '$pw'";

 	$result = mysqli_query($conn, $sql);

	echo $sql;
	echo '<br />';

	$count = mysqli_num_rows($result);
	echo "count:" . $count;

	if($count == 0)
{
	
      echo 'Đăng nhập không thành công';

		

}




	else 



      echo 'Đăng nhập thành công';

 

?>

     <a href="logout.php" >Log out</a>
</body>
</html>






    