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
		$clientID = $_SESSION["clientID"];
		$_SESSION["clientID"] = $clientID;
	}
	$_SESSION["location"]="checkout";
	
	if (isset($_POST["coupon_input"])){
		if ($_POST["coupon_input"]=="%discount30%"){
			$discount = 0.7;
		}else if ($_POST["coupon_input"] == ""){
			$discount = 1;
		}else{
			echo "<script>alert('Coupon code not exist.'); history.go(-1);</script>";
		}
	}
	if(isset($_SESSION["discount"])){
		$_SESSION["discount"] = $discount;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Checkout</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Wish shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/checkout.css">
<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
</head>
<body>

<div class="super_container">
	
	<!-- Header + Menu -->
	
	<?php require_once 'header.php';?>

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/checkout.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_container">
						<div class="home_content">
							<div class="home_title">Checkout</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="index.html">Home</a></li>
									<li><a href="index.html">Shopping Cart</a></li>
									<li>Shopping Cart</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Checkout -->

	<div class="checkout">
		<div class="container">
			<div class="row">

				<!-- Billing Details -->
				<?php echo '
				<div class="col-lg-6">
					<div class="billing">
						<div class="checkout_title">shipping details</div>
						<div class="checkout_form_container">';
						$record_ID = uniqid();
						echo '<form action="" method="post" id="checkout_form">
								<div class="d-flex flex-lg-row flex-column align-items-start justify-content-between">
									<input type="text" class="checkout_input checkout_input_50" name="shipping_fn" ';
									if (isset($_SESSION["ID"])){
										$ID = $_SESSION["ID"];
										$sql = "select first_name,last_name,ID,email,user_name from clients where ID = '$ID'";
										$result = mysqli_query($con,$sql);
										while($row = mysqli_fetch_array($result)) {
											$firstName = $row['first_name'];
											$last_name = $row['last_name'];
											$userName = $row['user_name'];
											$email = $row['email'];
										}
										$sql_shipping = "select clientID,address_usage,first_name,last_name,company_name,country,address,town,state,zip_code,phone_No From address where clientID='$ID' AND address_usage='shipping'";
										$result_shipping = mysqli_query($con,$sql_shipping);
										$num_shipping = mysqli_num_rows($result_shipping);
										if ($num_shipping != 0){
											while($row_shipping = mysqli_fetch_array($result_shipping)) {
												$shipping_fn = $row_shipping["first_name"];
												$shipping_ln = $row_shipping["last_name"];
												$shipping_cn = $row_shipping["company_name"];
												$country = $row_shipping["country"];
												$address = $row_shipping["address"];
												$town = $row_shipping["town"];
												$state = $row_shipping["state"];
												$zip_code = $row_shipping["zip_code"];
												$phone_No = $row_shipping["phone_No"];
											}
											echo 'value="'.$shipping_fn.'" required="required">
											<input type="text" class="checkout_input checkout_input_50" name="shipping_ln" value="'.$shipping_ln.'" required="required">';
										}else{
											echo 'placeholder="First Name" required="required">
											<input type="text" class="checkout_input checkout_input_50" name="shipping_ln" placeholder="Last Name" required="required">';
									}}else{
										echo 'placeholder="First Name" required="required">
											<input type="text" class="checkout_input checkout_input_50" name="shipping_ln" placeholder="Last Name" required="required">';
									}echo '
								</div>
								<input type="text" class="checkout_input" name="shipping_cn" ';
								if (isset($shipping_cn) && $shipping_cn != ""){
									echo 'value="'.$shipping_cn;
								}else{
									echo 'placeholder="Company Name';
								}
								echo '">
								<select name="Country" id="country" class="country_select checkout_input">';
								if (isset($country)){
									echo '<option selected = "selected">'.$country.'</option>';
								}echo '
									<option value="AF">Afghanistan</option>
									<option value="AL">Albania</option>
									<option value="DZ">Algeria</option>
									<option value="AS">American Samoa</option>
									<option value="AD">Andorra</option>
									<option value="AI">Anguilla</option>
									<option value="AQ">Antarctica</option>
									<option value="AG">Antigua And Barbuda</option>
									<option value="AR">Argentina</option>
									<option value="AM">Armenia</option>
									<option value="AW">Aruba</option>
									<option value="AU"';
									if (!isset($country)){
										echo ' selected = "selected"';
									}
									echo '>Australia</option>
									<option value="AT">Austria</option>
									<option value="AZ">Ayerbaijan</option>
									<option value="BS">Bahamas, The</option>
									<option value="BH">Bahrain</option>
									<option value="BD">Bangladesh</option>
									<option value="BB">Barbados</option>
									<option value="BY">Belarus</option>
									<option value="BZ">Belize</option>
									<option value="BE">Belgium</option>
									<option value="BJ">Benin</option>
									<option value="BM">Bermuda</option>
									<option value="BT">Bhutan</option>
									<option value="BO">Bolivia</option>
									<option value="BV">Bouvet Is</option>
									<option value="BA">Bosnia and Herzegovina</option>
									<option value="BW">Botswana</option>
									<option value="BR">Brazil</option>
									<option value="IO">British Indian Ocean Territory</option>
									<option value="BN">Brunei</option>
									<option value="BG">Bulgaria</option>
									<option value="BF">Burkina Faso</option>
									<option value="BI">Burundi</option>
									<option value="KH">Cambodia</option>
									<option value="CM">Cameroon</option>
									<option value="CA">Canada</option>
									<option value="CV">Cape Verde</option>
									<option value="KY">Cayman Is</option>
									<option value="CF">Central African Republic</option>
									<option value="TD">Chad</option>
									<option value="CL">Chile</option>
									<option value="CN">China</option>
									<option value="HK">China (Hong Kong S.A.R.)</option>
									<option value="MO">China (Macau S.A.R.)</option>
									<option value="TW">China (Taiwan T.W)</option>
									<option value="CX">Christmas Is</option>
									<option value="CC">Cocos (Keeling) Is</option>
									<option value="CO">Colombia</option>
									<option value="KM">Comoros</option>
									<option value="CK">Cook Islands</option>
									<option value="CR">Costa Rica</option>
									<option value="CI">Cote D’Ivoire (Ivory Coast)</option>
									<option value="HR">Croatia (Hrvatska)</option>
									<option value="CY">Cyprus</option>
									<option value="CZ">Czech Republic</option>
									<option value="CD">Democratic Republic of the Congo</option>
									<option value="DK">Denmark</option>
									<option value="DM">Dominica</option>
									<option value="DO">Dominican Republic</option>
									<option value="DJ">Djibouti</option>
									<option value="TP">East Timor</option>
									<option value="EC">Ecuador</option>
									<option value="EG">Egypt</option>
									<option value="SV">El Salvador</option>
									<option value="GQ">Equatorial Guinea</option>
									<option value="ER">Eritrea</option>
									<option value="EE">Estonia</option>
									<option value="ET">Ethiopia</option>
									<option value="FK">Falkland Is (Is Malvinas)</option>
									<option value="FO">Faroe Islands</option>
									<option value="FJ">Fiji Islands</option>
									<option value="FI">Finland</option>
									<option value="FR">France</option>
									<option value="GF">French Guiana</option>
									<option value="PF">French Polynesia</option>
									<option value="TF">French Southern Territories</option>
									<option value="MK">F.Y.R.O. Macedonia</option>
									<option value="GA">Gabon</option>
									<option value="GM">Gambia, The</option>
									<option value="GE">Georgia</option>
									<option value="DE">Germany</option>
									<option value="GH">Ghana</option>
									<option value="GI">Gibraltar</option>
									<option value="GR">Greece</option>
									<option value="GL">Greenland</option>
									<option value="GD">Grenada</option>
									<option value="GP">Guadeloupe</option>
									<option value="GU">Guam</option>
									<option value="GT">Guatemala</option>
									<option value="GN">Guinea</option>
									<option value="GW">Guinea-Bissau</option>
									<option value="GY">Guyana</option>
									<option value="HT">Haiti</option>
									<option value="HM">Heard and McDonald Is</option>
									<option value="HN">Honduras</option>
									<option value="HU">Hungary</option>
									<option value="IS">Iceland</option>
									<option value="IN">India</option>
									<option value="ID">Indonesia</option>
									<option value="IE">Ireland</option>
									<option value="IL">Israel</option>
									<option value="IT">Italy</option>
									<option value="JM">Jamaica</option>
									<option value="JP">Japan</option>
									<option value="JO">Jordan</option>
									<option value="KZ">Kayakhstan</option>
									<option value="KE">Kenya</option>
									<option value="KI">Kiribati</option>
									<option value="KR">Korea, South</option>
									<option value="KW">Kuwait</option>
									<option value="KG">Kyrgyzstan</option>
									<option value="LA">Laos</option>
									<option value="LV">Latvia</option>
									<option value="LB">Lebanon</option>
									<option value="LS">Lesotho</option>
									<option value="LR">Liberia</option>
									<option value="LI">Liechtenstein</option>
									<option value="LT">Lithuania</option>
									<option value="LU">Luxembourg</option>
									<option value="MG">Madagascar</option>
									<option value="MW">Malawi</option>
									<option value="MY">Malaysia</option>
									<option value="MV">Maldives</option>
									<option value="ML">Mali</option>
									<option value="MT">Malta</option>
									<option value="MH">Marshall Is</option>
									<option value="MR">Mauritania</option>
									<option value="MU">Mauritius</option>
									<option value="MQ">Martinique</option>
									<option value="YT">Mayotte</option>
									<option value="MX">Mexico</option>
									<option value="FM">Micronesia</option>
									<option value="MD">Moldova</option>
									<option value="MC">Monaco</option>
									<option value="MN">Mongolia</option>
									<option value="MS">Montserrat</option>
									<option value="MA">Morocco</option>
									<option value="MZ">Mozambique</option>
									<option value="MM">Myanmar</option>
									<option value="NA">Namibia</option>
									<option value="NR">Nauru</option>
									<option value="NP">Nepal</option>
									<option value="NL">Netherlands, The</option>
									<option value="AN">Netherlands Antilles</option>
									<option value="NC">New Caledonia</option>
									<option value="NZ">New Zealand</option>
									<option value="NI">Nicaragua</option>
									<option value="NE">Niger</option>
									<option value="NG">Nigeria</option>
									<option value="NU">Niue</option>
									<option value="NO">Norway</option>
									<option value="NF">Norfolk Island</option>
									<option value="MP">Northern Mariana Is</option>
									<option value="OM">Oman</option>
									<option value="PK">Pakistan</option>
									<option value="PW">Palau</option>
									<option value="PA">Panama</option>
									<option value="PG">Papua new Guinea</option>
									<option value="PY">Paraguay</option>
									<option value="PE">Peru</option>
									<option value="PH">Philippines</option>
									<option value="PN">Pitcairn Island</option>
									<option value="PL">Poland</option>
									<option value="PT">Portugal</option>
									<option value="PR">Puerto Rico</option>
									<option value="QA">Qatar</option>
									<option value="CG">Republic of the Congo</option>
									<option value="RE">Reunion</option>
									<option value="RO">Romania</option>
									<option value="RU">Russia</option>
									<option value="SH">Saint Helena</option>
									<option value="KN">Saint Kitts And Nevis</option>
									<option value="LC">Saint Lucia</option>
									<option value="PM">Saint Pierre and Miquelon</option>
									<option value="VC">Saint Vincent And The Grenadines</option>
									<option value="WS">Samoa</option>
									<option value="WM">San Marino</option>
									<option value="ST">Sao Tome and Principe</option>
									<option value="SA">Saudi Arabia</option>
									<option value="SN">Senegal</option>
									<option value="SC">Seychelles</option>
									<option value="SL">Sierra Leone</option>
									<option value="SG">Singapore</option>
									<option value="SK">Slovakia</option>
									<option value="SI">Slovenia</option>
									<option value="SB">Solomon Islands</option>
									<option value="SO">Somalia</option>
									<option value="ZA">South Africa</option>
									<option value="GS">South Georgia & The S. Sandwich Is</option>
									<option value="ES">Spain</option>
									<option value="LK">Sri Lanka</option>
									<option value="SR">Suriname</option>
									<option value="SJ">Svalbard And Jan Mayen Is</option>
									<option value="SZ">Swaziland</option>
									<option value="SE">Sweden</option>
									<option value="CH">Switzerland</option>
									<option value="SY">Syria</option>
									<option value="TJ">Tajikistan</option>
									<option value="TZ">Tanzania</option>
									<option value="TH">Thailand</option>
									<option value="TL">Timor-Leste</option>
									<option value="TG">Togo</option>
									<option value="TK">Tokelau</option>
									<option value="TO">Tonga</option>
									<option value="TT">Trinidad And Tobago</option>
									<option value="TN">Tunisia</option>
									<option value="TR">Turkey</option>
									<option value="TC">Turks And Caicos Is</option>
									<option value="TM">Turkmenistan</option>
									<option value="TV">Tuvalu</option>
									<option value="UG">Uganda</option>
									<option value="UA">Ukraine</option>
									<option value="AE">United Arab Emirates</option>
									<option value="GB">United Kingdom</option>
									<option value="US">United States</option>
									<option value="UM">United States Minor Outlying Is</option>
									<option value="UY">Uruguay</option>
									<option value="UZ">Uzbekistan</option>
									<option value="VU">Vanuatu</option>
									<option value="VA">Vatican City State (Holy See)</option>
									<option value="VE">Venezuela</option>
									<option value="VN">Vietnam</option>
									<option value="VG">Virgin Islands (British)</option>
									<option value="VI">Virgin Islands (US)</option>
									<option value="WF">Wallis And Futuna Islands</option>
									<option value="EH">Western Sahara</option>
									<option value="YE">Yemen</option>
									<option value="ZM">Zambia</option>
									<option value="ZW">Zimbabwe</option>
								</select>
								<input type="text" class="checkout_input" name="Address" ';
								if (isset($address)){
									echo 'value="'.$address;
								}else{
									echo 'placeholder="Address';
								}
								echo '" required="required">
								<input type="text" class="checkout_input" name="Town" ';
								if (isset($town)){
									echo 'value="'.$town;
								}else{
									echo 'placeholder="City';
								}
								echo '" required="required">
								<input type="text" class="checkout_input" name="State" ';
								if (isset($state)){
									echo 'value="'.$state;
								}else{
									echo 'placeholder="State';
								}
								echo '" required="required">
								<div class="d-flex flex-lg-row flex-column align-items-start justify-content-between">
									<input type="text" class="checkout_input checkout_input_50" name="Zipcode" ';
								if (isset($zip_code)){
									echo 'value="'.$zip_code;
								}else{
									echo 'placeholder="Zipcode';
								}
								echo '" required="required">
									<input type="text" class="checkout_input checkout_input_50" name="Phone_No" ';
								if (isset($phone_No)){
									echo 'value="'.$phone_No;
								}else{
									echo 'placeholder="Phone No';
								}
								echo '" required="required">
								</div>
								<textarea name="checkout_comment" id="checkout_comment" class="checkout_comment" placeholder="Leave a comment about your order"></textarea>
								<br/>
								<div class="billing_options">
									<div class="billing_account">
										<input type="checkbox" id="checkbox_account" name="regular_checkbox" class="regular_checkbox checkbox_account" checked="checked" onclick="checkboxOnclick()" value="billing" style="visibility:hidden;">
										<label for="checkbox_account"><img src="images/checked.png" alt="checkbox"></label>
										<span>Billing address is the same as delivery address</span>
									</div>
									<div class="billing_shipping">
										<input name="regular_checkbox_2" type="hidden" value="false">
										<input type="checkbox" id="checkbox_shipping" name="regular_checkbox_2" class="regular_checkbox checkbox_shipping" value="shipping" style="visibility:hidden;">
										<label for="checkbox_shipping"><img src="images/checked.png" alt="checkbox"></label>
										<span>Set as default shipping address</span>
									</div>
								</div>
						</div>
					</div>
				</div>

				<!-- Cart Details -->
				<div class="col-lg-6">
					<div class="cart_details">
						<div class="checkout_title">cart total</div>
						<div class="cart_total">
							<ul>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Product</div>
									<div class="cart_total_price ml-auto">Total</div>
								</li>';
								$price_total = 0;
								$date = date("Y-m-d");
								$_SESSION['record_ID'] = $record_ID;
								for($i=1;$i<100;++$i){
									if (isset($_POST["checkbox_".$i])){
										if ($_POST["checkbox_".$i] == "checked"){
											$productID = $_POST["ID_".$i];
											$productName = $_POST["name_".$i];
											$quantity = $_POST["quantity_".$i];
											if (isset($_POST["color_".$i])){
												$color = $_POST["color_".$i];
											}else{
												$color = "Fixed";
											}
											if (isset($_POST["size_".$i])){
												$size = $_POST["size_".$i];
											}else{
												$size = "Normal";
											}
											$price = $_POST["price_".$i];
											
											echo '<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">'.$productName.' x '.$color.' x '.$size.' x '.$quantity.'</div>
													<div class="cart_total_price ml-auto">$'.$quantity*$price.'</div>
												</li>';
											
											if (isset($_SESSION["ID"])){
												$sql_order = "INSERT INTO orders(orderID,clientID,productID,productName,quantity,color,size,price,discount,date,paymentStatus,note) VALUES ('".$record_ID."', '".$ID."', '".$productID."','".$productName."','".$quantity."','".$color."','".$size."','".$price."','".$discount."','".$date."','unpaid','') ";
												$result_order = mysqli_query($con,$sql_order);
												
												$sql_cart = "DELETE FROM cart WHERE productID = '".$productID."' AND clientID = '".$ID."' AND color = '".$color."' AND size = '".$size."'";
												$result_cart = mysqli_query($con,$sql_cart);
											}else if (isset($_SESSION["clientID"])){
												$sql_order = "INSERT INTO orders(orderID,clientID,productID,quantity,color,size,price,discount,date,paymentStatus,note) VALUES ('".$record_ID."', '".$clientID."', '".$productID."', '".$quantity."','".$color."','".$size."','".$price."','".$discount."','".$date."','unpaid','') ";
												$result_order = mysqli_query($con,$sql_order);
												
												$sql_cart = "DELETE FROM cart WHERE productID = '".$productID."' AND clientID = '".$clientID."' AND color = '".$color."' AND size = '".$size."'";
												$result_cart = mysqli_query($con,$sql_cart);
											}
											$price_total += ($quantity*$price);
									}}
								}
								if (isset($_GET['type']) && $_GET['type']=="shortcut"){
									$discount = 1;
									if (isset($_SESSION["ID"])){
										$sql_sc = "SELECT clientID, productID, productName, quantity, color, size, price FROM cart WHERE clientID = '$ID'";
										$result_sc = mysqli_query($con,$sql_sc);
										while($row = mysqli_fetch_array($result_sc)) {
											$productID = $row["productID"];
											$productName = $row["productName"];
											$quantity = $row["quantity"];
											if (isset($row["color"])){
												$color = $row["color"];
											}else{
												$color = "Fixed";
											}
											if (isset($row["size"])){
												$size = $row["size"];
											}else{
												$size = "Normal";
											}
											$price = $row["price"];
											
											echo '<li class="d-flex flex-row align-items-center justify-content-start">
											<div class="cart_total_title">'.$productName.' x '.$color.' x '.$size.' x '.$quantity.'</div>
											<div class="cart_total_price ml-auto">$'.$quantity*$price.'</div>
										</li>';
											$price_total += ($quantity*$price);
											$sql_order = "INSERT INTO orders(orderID,clientID,productID,productName,quantity,color,size,price,discount,date,paymentStatus,note) VALUES ('".$record_ID."', '".$ID."', '".$productID."','".$productName."','".$quantity."','".$color."','".$size."','".$price."','".$discount."','".$date."','unpaid','') ";
											$result_order = mysqli_query($con,$sql_order);
													
											$sql_cart = "DELETE FROM cart WHERE productID = '".$productID."' AND clientID = '".$ID."' AND color = '".$color."' AND size = '".$size."'";
											$result_cart = mysqli_query($con,$sql_cart);
										}
									}else if (isset($_SESSION["clientID"])){
										$sql_sc = "SELECT clientID, productID, productName, quantity, color, size, price FROM cart WHERE clientID = '$clientID'";
										$result_sc = mysqli_query($con,$sql_sc);
										while($row = mysqli_fetch_array($result_sc)) {
											$productID = $row["productID"];
											$productName = $row["productName"];
											$quantity = $row["quantity"];
											if (isset($row["color"])){
												$color = $row["color"];
											}else{
												$color = "Fixed";
											}
											if (isset($row["size"])){
												$size = $row["size"];
											}else{
												$size = "Normal";
											}
											$price = $row["price"];
											
											echo '<li class="d-flex flex-row align-items-center justify-content-start">
											<div class="cart_total_title">'.$productName.' x '.$color.' x '.$size.' x '.$quantity.'</div>
											<div class="cart_total_price ml-auto">$'.$quantity*$price.'</div>
										</li>';
											$price_total += ($quantity*$price);
											$sql_order = "INSERT INTO orders(orderID,clientID,productID,quantity,color,size,price,discount,date,paymentStatus,note) VALUES ('".$record_ID."', '".$clientID."', '".$productID."', '".$color."', '".$size."', '".$quantity."','".$price."','".$discount."','".$date."','unpaid','') ";
											$result_order = mysqli_query($con,$sql_order);
												
											$sql_cart = "DELETE FROM cart WHERE productID = '".$productID."' AND clientID = '".$clientID."' AND color = '".$color."' AND size = '".$size."'";
											$result_cart = mysqli_query($con,$sql_cart);
										}
									}
								}
								if ($price_total == 0){
									echo '<script>alert("Please pick at least one item.'.$$_POST["checkbox_1"].'");history.go(-1);</script>';
								}echo '
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Subtotal</div>
									<div class="cart_total_price ml-auto">AU$'.$price_total.'</div>
								</li>';
								if ($discount != 1){
									echo '<li class="d-flex flex-row align-items-center justify-content-start" style="color:#db2929;">
										<div class="cart_total_title">Discount</div>
										<div class="cart_total_price ml-auto">－AU$'.round((1-$discount)*$price_total,2).'</div>
									</li>';
								}
								echo '
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Shipping</div>
									<div class="cart_total_price ml-auto">AU$0.00</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Tax</div>
									<div class="cart_total_price ml-auto">AU$'.round($price_total*$discount*0.1,2).'</div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start total_row">
									<div class="cart_total_title">Total</div>
									<div class="cart_total_price ml-auto">AU$'.round(($price_total*$discount + $price_total*$discount*0.1),2).'</div>';
									$_SESSION["price_total"] = $price_total;
									echo '
								</li>
							</ul>
						</div>
						<div class="payment_options">
							<div>
								<input type="radio" id="radio_payment_1" name="regular_radio" class="regular_radio" value="cash">
								<label for="radio_payment_1">cash on delivery</label>
							</div>
							<div>
								<input type="radio" id="radio_payment_2" name="regular_radio" class="regular_radio" value="card" checked>
								<label for="radio_payment_2">pay with card</label>
								<div class="visa payment_option"><a href="#"><img src="images/visa.jpg" alt=""></a></div>
								<div class="master payment_option"><a href="#"><img src="images/master.jpg" alt=""></a></div>
							</div>
						</div>
							<input type="submit" id="billing_address_2" class="cart_total_button" value="Proceed to checkout" onclick="actionOnClick()"></button>
							<br/><br/><br/><br/>
							
							<div id="billing_address" class="checkout_form_container" style="display:none;">
								<div class="checkout_title">Billing Address</div>
								<br/><br/><br/>
								<div class="d-flex flex-lg-row flex-column align-items-start justify-content-between">
									<input type="text" class="checkout_input checkout_input_50" name="billing_fn" ';
									if (isset($_SESSION["ID"])){
										$sql_billing = "select clientID,address_usage,first_name,last_name,company_name,country,address,town,state,zip_code,phone_No From address where clientID='$ID' AND address_usage='billing'";
										$result_billing = mysqli_query($con,$sql_billing);
										$num_billing = mysqli_num_rows($result_billing);
										if ($num_billing != 0){
											while($row_billing = mysqli_fetch_array($result_billing)) {
												$billing_fn = $row_billing["first_name"];
												$billing_ln = $row_billing["last_name"];
												$billing_cn = $row_billing["company_name"];
												$country = $row_billing["country"];
												$address = $row_billing["address"];
												$town = $row_billing["town"];
												$state = $row_billing["state"];
												$zip_code = $row_billing["zip_code"];
												$phone_No = $row_billing["phone_No"];
											}
											echo 'value="'.$billing_fn.'" required="required">
											<input type="text" class="checkout_input checkout_input_50" name="billing_ln" value="'.$billing_ln.'" required="required">';
										}else{
											echo 'placeholder="First Name" required="required">
											<input type="text" class="checkout_input checkout_input_50" name="billing_ln" placeholder="Last Name" required="required">';
									}}else{
										echo 'placeholder="First Name" required="required">
											<input type="text" class="checkout_input checkout_input_50" name="billing_ln" placeholder="Last Name" required="required">';
									}echo '
								</div>
								<input type="text" class="checkout_input" name="billing_cn" ';
								if (isset($billing_cn) && $billing_cn != ""){
									echo 'value="'.$billing_cn;
								}else{
									echo 'placeholder="Company Name';
								}
								echo '">
								<input type="text" class="checkout_input" name="E-mail_2" ';
								if (isset($email)){
									echo 'value="'.$email;
								}else{
									echo 'placeholder="E-mail';
								}
								echo '" required="required">
								<select name="Country_2" id="country" class="country_select checkout_input">';
								if (isset($country)){
									echo '<option selected = "selected">'.$country.'</option>';
								}echo '
									<option value="AF">Afghanistan</option>
									<option value="AL">Albania</option>
									<option value="DZ">Algeria</option>
									<option value="AS">American Samoa</option>
									<option value="AD">Andorra</option>
									<option value="AI">Anguilla</option>
									<option value="AQ">Antarctica</option>
									<option value="AG">Antigua And Barbuda</option>
									<option value="AR">Argentina</option>
									<option value="AM">Armenia</option>
									<option value="AW">Aruba</option>
									<option value="AU"';
									if (!isset($country)){
										echo ' selected = "selected"';
									}
									echo '>Australia</option>
									<option value="AT">Austria</option>
									<option value="AZ">Ayerbaijan</option>
									<option value="BS">Bahamas, The</option>
									<option value="BH">Bahrain</option>
									<option value="BD">Bangladesh</option>
									<option value="BB">Barbados</option>
									<option value="BY">Belarus</option>
									<option value="BZ">Belize</option>
									<option value="BE">Belgium</option>
									<option value="BJ">Benin</option>
									<option value="BM">Bermuda</option>
									<option value="BT">Bhutan</option>
									<option value="BO">Bolivia</option>
									<option value="BV">Bouvet Is</option>
									<option value="BA">Bosnia and Herzegovina</option>
									<option value="BW">Botswana</option>
									<option value="BR">Brazil</option>
									<option value="IO">British Indian Ocean Territory</option>
									<option value="BN">Brunei</option>
									<option value="BG">Bulgaria</option>
									<option value="BF">Burkina Faso</option>
									<option value="BI">Burundi</option>
									<option value="KH">Cambodia</option>
									<option value="CM">Cameroon</option>
									<option value="CA">Canada</option>
									<option value="CV">Cape Verde</option>
									<option value="KY">Cayman Is</option>
									<option value="CF">Central African Republic</option>
									<option value="TD">Chad</option>
									<option value="CL">Chile</option>
									<option value="CN">China</option>
									<option value="HK">China (Hong Kong S.A.R.)</option>
									<option value="MO">China (Macau S.A.R.)</option>
									<option value="TW">China (Taiwan T.W)</option>
									<option value="CX">Christmas Is</option>
									<option value="CC">Cocos (Keeling) Is</option>
									<option value="CO">Colombia</option>
									<option value="KM">Comoros</option>
									<option value="CK">Cook Islands</option>
									<option value="CR">Costa Rica</option>
									<option value="CI">Cote D’Ivoire (Ivory Coast)</option>
									<option value="HR">Croatia (Hrvatska)</option>
									<option value="CY">Cyprus</option>
									<option value="CZ">Czech Republic</option>
									<option value="CD">Democratic Republic of the Congo</option>
									<option value="DK">Denmark</option>
									<option value="DM">Dominica</option>
									<option value="DO">Dominican Republic</option>
									<option value="DJ">Djibouti</option>
									<option value="TP">East Timor</option>
									<option value="EC">Ecuador</option>
									<option value="EG">Egypt</option>
									<option value="SV">El Salvador</option>
									<option value="GQ">Equatorial Guinea</option>
									<option value="ER">Eritrea</option>
									<option value="EE">Estonia</option>
									<option value="ET">Ethiopia</option>
									<option value="FK">Falkland Is (Is Malvinas)</option>
									<option value="FO">Faroe Islands</option>
									<option value="FJ">Fiji Islands</option>
									<option value="FI">Finland</option>
									<option value="FR">France</option>
									<option value="GF">French Guiana</option>
									<option value="PF">French Polynesia</option>
									<option value="TF">French Southern Territories</option>
									<option value="MK">F.Y.R.O. Macedonia</option>
									<option value="GA">Gabon</option>
									<option value="GM">Gambia, The</option>
									<option value="GE">Georgia</option>
									<option value="DE">Germany</option>
									<option value="GH">Ghana</option>
									<option value="GI">Gibraltar</option>
									<option value="GR">Greece</option>
									<option value="GL">Greenland</option>
									<option value="GD">Grenada</option>
									<option value="GP">Guadeloupe</option>
									<option value="GU">Guam</option>
									<option value="GT">Guatemala</option>
									<option value="GN">Guinea</option>
									<option value="GW">Guinea-Bissau</option>
									<option value="GY">Guyana</option>
									<option value="HT">Haiti</option>
									<option value="HM">Heard and McDonald Is</option>
									<option value="HN">Honduras</option>
									<option value="HU">Hungary</option>
									<option value="IS">Iceland</option>
									<option value="IN">India</option>
									<option value="ID">Indonesia</option>
									<option value="IE">Ireland</option>
									<option value="IL">Israel</option>
									<option value="IT">Italy</option>
									<option value="JM">Jamaica</option>
									<option value="JP">Japan</option>
									<option value="JO">Jordan</option>
									<option value="KZ">Kayakhstan</option>
									<option value="KE">Kenya</option>
									<option value="KI">Kiribati</option>
									<option value="KR">Korea, South</option>
									<option value="KW">Kuwait</option>
									<option value="KG">Kyrgyzstan</option>
									<option value="LA">Laos</option>
									<option value="LV">Latvia</option>
									<option value="LB">Lebanon</option>
									<option value="LS">Lesotho</option>
									<option value="LR">Liberia</option>
									<option value="LI">Liechtenstein</option>
									<option value="LT">Lithuania</option>
									<option value="LU">Luxembourg</option>
									<option value="MG">Madagascar</option>
									<option value="MW">Malawi</option>
									<option value="MY">Malaysia</option>
									<option value="MV">Maldives</option>
									<option value="ML">Mali</option>
									<option value="MT">Malta</option>
									<option value="MH">Marshall Is</option>
									<option value="MR">Mauritania</option>
									<option value="MU">Mauritius</option>
									<option value="MQ">Martinique</option>
									<option value="YT">Mayotte</option>
									<option value="MX">Mexico</option>
									<option value="FM">Micronesia</option>
									<option value="MD">Moldova</option>
									<option value="MC">Monaco</option>
									<option value="MN">Mongolia</option>
									<option value="MS">Montserrat</option>
									<option value="MA">Morocco</option>
									<option value="MZ">Mozambique</option>
									<option value="MM">Myanmar</option>
									<option value="NA">Namibia</option>
									<option value="NR">Nauru</option>
									<option value="NP">Nepal</option>
									<option value="NL">Netherlands, The</option>
									<option value="AN">Netherlands Antilles</option>
									<option value="NC">New Caledonia</option>
									<option value="NZ">New Zealand</option>
									<option value="NI">Nicaragua</option>
									<option value="NE">Niger</option>
									<option value="NG">Nigeria</option>
									<option value="NU">Niue</option>
									<option value="NO">Norway</option>
									<option value="NF">Norfolk Island</option>
									<option value="MP">Northern Mariana Is</option>
									<option value="OM">Oman</option>
									<option value="PK">Pakistan</option>
									<option value="PW">Palau</option>
									<option value="PA">Panama</option>
									<option value="PG">Papua new Guinea</option>
									<option value="PY">Paraguay</option>
									<option value="PE">Peru</option>
									<option value="PH">Philippines</option>
									<option value="PN">Pitcairn Island</option>
									<option value="PL">Poland</option>
									<option value="PT">Portugal</option>
									<option value="PR">Puerto Rico</option>
									<option value="QA">Qatar</option>
									<option value="CG">Republic of the Congo</option>
									<option value="RE">Reunion</option>
									<option value="RO">Romania</option>
									<option value="RU">Russia</option>
									<option value="SH">Saint Helena</option>
									<option value="KN">Saint Kitts And Nevis</option>
									<option value="LC">Saint Lucia</option>
									<option value="PM">Saint Pierre and Miquelon</option>
									<option value="VC">Saint Vincent And The Grenadines</option>
									<option value="WS">Samoa</option>
									<option value="WM">San Marino</option>
									<option value="ST">Sao Tome and Principe</option>
									<option value="SA">Saudi Arabia</option>
									<option value="SN">Senegal</option>
									<option value="SC">Seychelles</option>
									<option value="SL">Sierra Leone</option>
									<option value="SG">Singapore</option>
									<option value="SK">Slovakia</option>
									<option value="SI">Slovenia</option>
									<option value="SB">Solomon Islands</option>
									<option value="SO">Somalia</option>
									<option value="ZA">South Africa</option>
									<option value="GS">South Georgia & The S. Sandwich Is</option>
									<option value="ES">Spain</option>
									<option value="LK">Sri Lanka</option>
									<option value="SR">Suriname</option>
									<option value="SJ">Svalbard And Jan Mayen Is</option>
									<option value="SZ">Swaziland</option>
									<option value="SE">Sweden</option>
									<option value="CH">Switzerland</option>
									<option value="SY">Syria</option>
									<option value="TJ">Tajikistan</option>
									<option value="TZ">Tanzania</option>
									<option value="TH">Thailand</option>
									<option value="TL">Timor-Leste</option>
									<option value="TG">Togo</option>
									<option value="TK">Tokelau</option>
									<option value="TO">Tonga</option>
									<option value="TT">Trinidad And Tobago</option>
									<option value="TN">Tunisia</option>
									<option value="TR">Turkey</option>
									<option value="TC">Turks And Caicos Is</option>
									<option value="TM">Turkmenistan</option>
									<option value="TV">Tuvalu</option>
									<option value="UG">Uganda</option>
									<option value="UA">Ukraine</option>
									<option value="AE">United Arab Emirates</option>
									<option value="GB">United Kingdom</option>
									<option value="US">United States</option>
									<option value="UM">United States Minor Outlying Is</option>
									<option value="UY">Uruguay</option>
									<option value="UZ">Uzbekistan</option>
									<option value="VU">Vanuatu</option>
									<option value="VA">Vatican City State (Holy See)</option>
									<option value="VE">Venezuela</option>
									<option value="VN">Vietnam</option>
									<option value="VG">Virgin Islands (British)</option>
									<option value="VI">Virgin Islands (US)</option>
									<option value="WF">Wallis And Futuna Islands</option>
									<option value="EH">Western Sahara</option>
									<option value="YE">Yemen</option>
									<option value="ZM">Zambia</option>
									<option value="ZW">Zimbabwe</option>
								</select>
								<input type="text" class="checkout_input" name="Address_2" ';
								if (isset($address)){
									echo 'value="'.$address;
								}else{
									echo 'placeholder="Address';
								}
								echo '" required="required">
								<input type="text" class="checkout_input" name="Town_2" ';
								if (isset($town)){
									echo 'value="'.$town;
								}else{
									echo 'placeholder="City';
								}
								echo '" required="required">
								<input type="text" class="checkout_input" name="State_2" ';
								if (isset($state)){
									echo 'value="'.$state;
								}else{
									echo 'placeholder="State';
								}
								echo '" required="required">
								<div class="d-flex flex-lg-row flex-column align-items-start justify-content-between">
									<input type="text" class="checkout_input checkout_input_50" name="Zipcode_2" ';
								if (isset($zip_code)){
									echo 'value="'.$zip_code;
								}else{
									echo 'placeholder="Zipcode';
								}
								echo '" required="required">
									<input type="text" class="checkout_input checkout_input_50" name="Phone_No_2" ';
								if (isset($phone_No)){
									echo 'value="'.$phone_No;
								}else{
									echo 'placeholder="Phone No';
								}
								echo '" required="required">
								</div>
								<div class="billing_options">
									<div class="billing_account">
										<input name="regular_checkbox_1" type="hidden" value="false">
										<input type="checkbox" id="checkbox_billing" name="regular_checkbox_3" class="regular_checkbox checkbox_account" value="billing" style="visibility:hidden;">
										<label for="checkbox_billing"><img src="images/checked.png" alt="checkbox"></label>
										<span>Set as default billing address</span>
									</div>
								</div>
								<input type="submit" class="cart_total_button" value="Proceed to checkout" onclick="actionOnClick()"></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
			</div>
		</div>
	</div>';
	mysqli_close($con);
	?>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="newsletter_content">
			<div class="newsletter_image parallax-window" data-parallax="scroll" data-image-src="images/cart_nl.jpg" data-speed="0.8"></div>
			<div class="container">
				<div class="row options">

					<!-- Options Item -->
					<div class="col-lg-3">
						<div class="options_item d-flex flex-row align-items-center justify-content-start">
							<div class="option_image"><img src="images/option_1.png" alt=""></div>
							<div class="option_content">
								<div class="option_title">30 Days Returns</div>
								<div class="option_subtitle">No questions asked</div>
							</div>
						</div>
					</div>

					<!-- Options Item -->
					<div class="col-lg-3">
						<div class="options_item d-flex flex-row align-items-center justify-content-start">
							<div class="option_image"><img src="images/option_2.png" alt=""></div>
							<div class="option_content">
								<div class="option_title">Free Delivery</div>
								<div class="option_subtitle">On all orders</div>
							</div>
						</div>
					</div>

					<!-- Options Item -->
					<div class="col-lg-3">
						<div class="options_item d-flex flex-row align-items-center justify-content-start">
							<div class="option_image"><img src="images/option_3.png" alt=""></div>
							<div class="option_content">
								<div class="option_title">Secure Payments</div>
								<div class="option_subtitle">No need to worry</div>
							</div>
						</div>
					</div>

					<!-- Options Item -->
					<div class="col-lg-3">
						<div class="options_item d-flex flex-row align-items-center justify-content-start">
							<div class="option_image"><img src="images/option_4.png" alt=""></div>
							<div class="option_content">
								<div class="option_title">24/7 Support</div>
								<div class="option_subtitle">Just call us</div>
							</div>
						</div>
					</div>

				</div>
				<div class="row newsletter_row">
					<div class="col">
						<div class="section_title_container text-center">
							<div class="section_subtitle">only the best</div>
							<div class="section_title">subscribe for a 20% discount</div>
						</div>
					</div>
				</div>
				<div class="row newsletter_container">
					<div class="col-lg-10 offset-lg-1">
						<div class="newsletter_form_container">
							<form action="#">
								<input type="email" class="newsletter_input" required="required" placeholder="E-mail here">
								<button type="submit" class="newsletter_button">subscribe</button>
							</form>
						</div>
						<div class="newsletter_text">FashionCloset always gives you the best.</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="footer_logo"><a href="#">FashionCloset</a></div>
					<nav class="footer_nav">
						<ul>
							<li><a href="index.html">home</a></li>
							<li><a href="categories.html">clothes</a></li>
							<li><a href="categories.html">accessories</a></li>
							<li><a href="categories.html">shoes</a></li>
							<li><a href="contact.html">contact</a></li>
						</ul>
					</nav>
					<div class="footer_social">
						<ul>
							<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-reddit-alien" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/checkout_custom.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	var qcloud={};
	$('[_t_nav]').hover(function(){
		var _nav = $(this).attr('_t_nav');
		clearTimeout( qcloud[ _nav + '_timer' ] );
		qcloud[ _nav + '_timer' ] = setTimeout(function(){
		$('[_t_nav]').each(function(){
		$(this)[ _nav == $(this).attr('_t_nav') ? 'addClass':'removeClass' ]('nav-up-selected');
		});
		$('#'+_nav).stop(true,true).slideDown(200);
		}, 150);
	},function(){
		var _nav = $(this).attr('_t_nav');
		clearTimeout( qcloud[ _nav + '_timer' ] );
		qcloud[ _nav + '_timer' ] = setTimeout(function(){
		$('[_t_nav]').removeClass('nav-up-selected');
		$('#'+_nav).stop(true,true).slideUp(200);
		}, 150);
	});
});
</script>
<script type="text/javascript">
	function checkboxOnclick() {
		if(document.getElementById("checkbox_account").checked == true){
			document.getElementById("billing_address").setAttribute("style", "display: none;");
			document.getElementById("billing_address_2").setAttribute("style", "display: inline;");
		}else{
			document.getElementById("billing_address").setAttribute("style", "display: inline;");
			document.getElementById("billing_address_2").setAttribute("style", "display: none;");
		}
	}
	function actionOnClick() {
		var element = document.getElementById('checkout_form');
		element.action = 'app/payment.php?orderID=<?php echo $record_ID; ?>';
		element.submit();
	}
</script>
</body>
</html>