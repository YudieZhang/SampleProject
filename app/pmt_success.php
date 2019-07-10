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
}
$orderID = $_SESSION["orderID"];

if (isset($_SESSION["ID"])){
	$ID = $_SESSION["ID"];
	$_SESSION["ID"] = $ID;
	$first_name = $_SESSION["firstName"];
	$_SESSION["firstName"] = $first_name;
	$last_name = $_SESSION["lastName"];
	$_SESSION["lastName"] = $last_name;
}else if (isset($_SESSION["clientID"])){
	$clientID = $_SESSION["clientID"];
	$_SESSION["clientID"] = $clientID;
}

$sql_paid = "UPDATE orders SET paymentStatus = 'paid' WHERE orderID = '$orderID'";
$result_paid = mysqli_query($con,$sql_paid);

	if (isset($_POST["shipping_fn"])){
		$shipping_fn = $_POST["shipping_fn"];
		$shipping_ln = $_POST["shipping_ln"];
		$shipping_cn = $_POST["shipping_cn"];
		$country = $_POST["Country"];
		$address = $_POST["Address"];
		$town = $_POST["Town"];
		$state = $_POST["State"];
		$zipcode = $_POST["Zipcode"];
		$phone_No = $_POST["Phone_No"];
		$regular_checkbox_1 = $_POST["regular_checkbox_1"];
		$regular_checkbox_2 = $_POST["regular_checkbox_2"];
		if (isset($_POST["regular_checkbox_3"])){
			$regular_checkbox_3 = $_POST["regular_checkbox_3"];
		}
		
		if($regular_checkbox_1 == "billing"){
			$addressID = uniqid();
			$sql_usage_2 = "SELECT clientID, address_usage FROM address WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'billing'";
			$result_usage_2 = mysqli_query($con,$sql_usage_2);
			$num_2 = mysqli_num_rows($result_usage_2);
			if ($num_2!=0){
				while($row = mysqli_fetch_array($result_usage_2)) {
					$sql_modify_2 = "UPDATE address SET address_usage = 'other' WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'billing'";
					$result_modify_2 = mysqli_query($con,$sql_modify_2);
				}
			}
			$sql_billing = "INSERT INTO address(clientID,addressID,address_usage,first_name,last_name,company_name,country,address,town,state,zip_code,phone_No) VALUES ('".$_SESSION["ID"]."', '".$addressID."', 'billing', '".$shipping_fn."','".$shipping_ln."','".$shipping_cn."', '".$country."', '".$address."', '".$town."', '".$state."', '".$zipcode."', '".$phone_No."') ";
			$result_billing = mysqli_query($con,$sql_billing);
		}
		if($regular_checkbox_2 == "shipping"){
			$addressID = uniqid();
			$sql_usage_1 = "SELECT clientID, address_usage FROM address WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'shipping'";
			$result_usage_1 = mysqli_query($con,$sql_usage_1);
			$num_1 = mysqli_num_rows($result_usage_1);
			if ($num_1!=0){
				while($row = mysqli_fetch_array($result_usage_1)) {
					$sql_modify_1 = "UPDATE address SET address_usage = 'other' WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'shipping'";
					$result_modify_1 = mysqli_query($con,$sql_modify_1);
				}
			}
			$sql_shipping = "INSERT INTO address(clientID,addressID,address_usage,first_name,last_name,company_name,country,address,town,state,zip_code,phone_No) VALUES ('".$_SESSION["ID"]."', '".$addressID."', 'shipping', '".$shipping_fn."','".$shipping_ln."', '".$shipping_cn."', '".$country."', '".$address."', '".$town."', '".$state."', '".$zipcode."', '".$phone_No."') ";
			$result_shipping = mysqli_query($con,$sql_shipping);
		}
		if(isset($regular_checkbox_3) && $regular_checkbox_3 == "billing"){
			$addressID = uniqid();
			$sql_usage_3 = "SELECT clientID, address_usage FROM address WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'billing'";
			$result_usage_3 = mysqli_query($con,$sql_usage_3);
			$num_3 = mysqli_num_rows($result_usage_3);
			if ($num_3!=0){
				while($row = mysqli_fetch_array($result_usage_3)) {
					$sql_modify_3 = "UPDATE address SET address_usage = 'other' WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'billing'";
					$result_modify_3 = mysqli_query($con,$sql_modify_3);
				}
			}
			$sql_billing = "INSERT INTO address(clientID,addressID,address_usage,first_name,last_name,company_name,country,address,town,state,zip_code,phone_No) VALUES ('".$_SESSION["ID"]."', '".$addressID."', 'billing', '".$shipping_fn."','".$shipping_ln."','".$shipping_cn."', '".$country."', '".$address."', '".$town."', '".$state."', '".$zipcode."', '".$phone_No."') ";
			$result_billing = mysqli_query($con,$sql_billing);
		}
	}

/*
//send an email
$email_body = '<p>Dear client,</p>
				   <p>Thank you for using MyHotel.</p>
				   <p>You have been charged $' . $payment_show . '.</p>
				   <p>Your payment reference is:' . $record_ID . '.</p>
				   <p>If you did not authorise this charge, please call xx-xxxx-xxxx immediately.</p>
				   <p>Do not reply this email. </p>';
$email_alert = "<script type='text/javascript'>alert('Oops...Sorry, there seems to be some technical issues so we did not send the payment notification email.');</script>";
require_once 'sendEmail.php';*/

//generate the confirm page.
 header("Location: ../success.php");
?>