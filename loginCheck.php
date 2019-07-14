<?php
session_start();
$userName = $_POST["userName"]; 
$_SESSION["userName"] = $userName;
$password = $_POST["password"]; 
$_SESSION["password"] = $password;

$con=mysqli_connect("localhost","root","","fashiondb");
mysqli_query($con, "set names 'gdk'");

$sql = "select ID,first_name,last_name,email,user_name,password from clients where user_name = '$userName' OR email = '$userName'";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);
if($num){
	while($row = mysqli_fetch_array($result)) {
		if ($row['password'] == $password){
			session_unset();
			$_SESSION["ID"] = $row['ID'];
			$_SESSION["firstName"] = $row['first_name'];
			$_SESSION["lastName"] = $row['last_name'];
			echo "<script>window.location.href='index.php';</script>";
		}else{
			echo "<script>alert('The password is not correct. Please try again.'); history.go(-1);</script>";
		}
	}
}else{
	echo "<script>alert('The account is not exist.'); history.go(-1);</script>";
}
?> 