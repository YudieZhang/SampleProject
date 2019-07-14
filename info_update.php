<?php
	session_start();
	
	$ID = $_SESSION["ID"];
	$_SESSION["ID"] = $ID;
	$firstName = $_SESSION["firstName"];
	$_SESSION["firstName"] = $firstName;
	$lastName = $_SESSION["lastName"];
	$_SESSION["lastName"] = $lastName;
	
	$con=mysqli_connect("localhost","root","","fashiondb");
	mysqli_query($con, "set names 'gdk'");
	
	if (isset($_POST["firstName"])){
		$first_name = $_POST["firstName"];
		$last_name = $_POST["lastName"];
		$username = $_POST["Username"];
		$email = $_POST["E-mail"];
		
		$sql = "UPDATE clients SET first_name = '".$first_name."', last_name = '".$last_name."',user_name = '".$username."',email = '".$email."' WHERE ID = '".$_SESSION["ID"]."' ";
		$result = mysqli_query($con,$sql);
		
		$_SESSION["firstName"] = $first_name;
		$_SESSION["lastName"] = $last_name;
		
		echo "<script>alert('The account information has been saved.window.location.href='account.php';');</script>";
	}else if (isset($_POST["Password"])){
		$password = $_POST["Password"];
		$confirm_PW = $_POST["Confirm_PW"];
		
		if($password == $confirm_PW){
			$sql = "UPDATE clients SET password = '".$password."' WHERE ID = '".$_SESSION["ID"]."' ";
			$result = mysqli_query($con,$sql);
			echo "<script>alert('The account information has been saved.');window.location.href='account.php';</script>";
		}else{
			echo "<script>alert('Please make sure your passwords match.'); history.go(-1);</script>";
		}
	}else if (isset($_POST["shipping_fn"])){
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
		
		if($regular_checkbox_1 == "false" && $regular_checkbox_2 == "false"){
			echo "<script>alert('Please choose the address type.'); history.go(-1);</script>";
		}else{
			if($regular_checkbox_1 == "billing"){
				$addressID = uniqid();
				$sql_usage_1 = "SELECT clientID, address_usage FROM address WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'billing'";
				$result_usage_1 = mysqli_query($con,$sql_usage_1);
				$num_1 = mysqli_num_rows($result_usage_1);
				if ($num_1!=0){
					while($row = mysqli_fetch_array($result_usage_1)) {
						$sql_modify_1 = "UPDATE address SET address_usage = 'other' WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'billing'";
						$result_modify_1 = mysqli_query($con,$sql_modify_1);
					}
				}
				$sql_billing = "INSERT INTO address(clientID,addressID,address_usage,first_name,last_name,company_name,country,address,town,state,zip_code,phone_No) VALUES ('".$_SESSION["ID"]."', '".$addressID."', 'billing', '".$shipping_fn."','".$shipping_ln."','".$shipping_cn."', '".$country."', '".$address."', '".$town."', '".$state."', '".$zipcode."', '".$phone_No."') ";
				$result_billing = mysqli_query($con,$sql_billing);
			}
			if($regular_checkbox_2 == "shipping"){
				$addressID = uniqid();
				$sql_usage_2 = "SELECT clientID, address_usage FROM address WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'shipping'";
				$result_usage_2 = mysqli_query($con,$sql_usage_2);
				$num_2 = mysqli_num_rows($result_usage_2);
				if ($num_2!=0){
					while($row = mysqli_fetch_array($result_usage_2)) {
						$sql_modify_2 = "UPDATE address SET address_usage = 'other' WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'shipping'";
						$result_modify_2 = mysqli_query($con,$sql_modify_2);
					}
				}
				$sql_shipping = "INSERT INTO address(clientID,addressID,address_usage,first_name,last_name,company_name,country,address,town,state,zip_code,phone_No) VALUES ('".$_SESSION["ID"]."', '".$addressID."', 'shipping', '".$shipping_fn."','".$shipping_ln."', '".$shipping_cn."', '".$country."', '".$address."', '".$town."', '".$state."', '".$zipcode."', '".$phone_No."') ";
				$result_shipping = mysqli_query($con,$sql_shipping);
			}
			echo "<script>alert('The address has been saved.');</script>";
			echo "<script>window.location.href='account.php';</script>";
		}
	}else if (isset($_POST["shipping_fn_2"])){
		$shipping_fn_2 = $_POST["shipping_fn_2"];
		$shipping_ln_2 = $_POST["shipping_ln_2"];
		$shipping_cn_2 = $_POST["shipping_cn_2"];
		$country_2 = $_POST["Country_2"];
		$address_2 = $_POST["Address_2"];
		$town_2 = $_POST["Town_2"];
		$state_2 = $_POST["State_2"];
		$zipcode_2 = $_POST["Zipcode_2"];
		$phone_No_2 = $_POST["Phone_No_2"];
		
		$addressID = uniqid();
		$sql_usage_3 = "SELECT clientID, address_usage FROM address WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'shipping'";
		$result_usage_3 = mysqli_query($con,$sql_usage_3);
		$num_3 = mysqli_num_rows($result_usage_3);
		if ($num_3!=0){
			while($row = mysqli_fetch_array($result_usage_3)) {
				$sql_modify_3 = "UPDATE address SET address_usage = 'other' WHERE clientID = '".$_SESSION["ID"]."' AND address_usage = 'shipping'";
				$result_modify_3 = mysqli_query($con,$sql_modify_3);
			}
		}
		$sql_shipping_3 = "INSERT INTO address (clientID,addressID,address_usage,first_name,last_name,company_name,country,address,town,state,zip_code,phone_No) VALUES ('".$_SESSION["ID"]."', '".$addressID."', 'shipping', '".$shipping_fn_2."','".$shipping_ln_2."', '".$shipping_cn_2."', '".$country_2."', '".$address_2."', '".$town_2."', '".$state_2."', '".$zipcode_2."', '".$phone_No_2."') ";
		$result_shipping_3 = mysqli_query($con,$sql_shipping_3);
		echo "<script>alert('The address has been saved.');</script>";
		echo "<script>window.location.href='account.php';</script>";
	}else if (isset($_POST["img"])){
		$img = $_POST["img"];
		$img = base64_encode($img);
		$_SESSION["avatar"] = $img;
		
		$sql_avatar = "UPDATE clients SET avatar = '".$img."' WHERE ID = '".$_SESSION["ID"]."' ";
		$result_avatar = mysqli_query($con,$sql_avatar);
		echo "<script>alert('Your avatar has been successfully uploaded.');window.location.href='account.php';</script>";
	}
	mysqli_close($con);
?>