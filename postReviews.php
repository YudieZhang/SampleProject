<?php
	session_start();
	
	$con=mysqli_connect("localhost","root","","fashiondb");
	mysqli_query($con, "set names 'gdk'");
	
	if (isset($_SESSION["ID"])){
		$ID = $_SESSION["ID"];
		$_SESSION["ID"] = $ID;
		$first_name = $_SESSION["firstName"];
		$_SESSION["firstName"] = $first_name;
		$last_name = $_SESSION["lastName"];
		$_SESSION["lastName"] = $last_name;
	}else if (isset($_SESSION["clientID"])){
		$ID = $_SESSION["clientID"];
		$_SESSION["clientID"] = $ID;
	}
	
	$reviewID = uniqid();
	$productID = $_GET["ID"];
	$rating = $_POST["rating_stars_value"];
	$review = $_POST["review_form_text"];
	$time = date("Y-m-d h:i:sa");
	
	$sql_nn = "SELECT ID,user_name FROM clients WHERE ID='$ID'";
	$result_nn = mysqli_query($con,$sql_nn);
	$fetch_result = mysqli_fetch_array($result_nn);
	$nickname = $fetch_result["user_name"];
	
	$sql = "SELECT clientID,productID,paymentStatus FROM orders WHERE clientID='$ID' AND productID='$productID' AND paymentStatus='paid'";
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	if ($num != 0){
		$sql_review = "INSERT INTO reviews (reviewID,productID,reviewerID,nickname,avatar,rate,reviewText,reviewPics,time) VALUES ('$reviewID','$productID','$ID','$nickname','images/avatar_2.jpg','$rating','$review','','".strval($time)."')";
		$result_review = mysqli_query($con,$sql_review);
		mysqli_close($con);
		echo "<script>alert('Thank you for posting your review.'); history.go(-1);</script>";
	}else{
		echo "<script>alert('Sorry, please write a review after purchasing the product.'); history.go(-1);</script>";
	}
?>