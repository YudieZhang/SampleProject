<?php
	session_start();
	if (isset($_SESSION["ID"])){
		$ID = $_SESSION["ID"];
		$_SESSION["ID"] = $ID;
		$first_name = $_SESSION["firstName"];
		$_SESSION["firstName"] = $first_name;
		$last_name = $_SESSION["lastName"];
		$_SESSION["lastName"] = $last_name;
	}
	$con=mysqli_connect("localhost","root","","fashiondb");
	mysqli_query($con, "set names 'gdk'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Account</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Wish shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/checkout.css">
<link rel="stylesheet" type="text/css" href="styles/checkout_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
<link href="styles/cropper.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles/ImgCropping.css">
</head>
<body>

<div class="super_container">
	
	<!-- Header + Menu -->
	
	<?php require_once 'header.php';?>

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/cart.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_container">
						<div class="home_content">
							<div class="home_title">My Account</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="index.php">Home</a></li>
									<li>Account</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Account Details -->

	<div class="checkout">
		<div class="container">
			<div class="row">

				<!-- Billing Details -->
				
				<div class="col-lg-6">
					<div class="billing">
							<div class="checkout_title">Avatar Settings</div>
							<br/><br/>
							<?php
							$sql_avatar = "SELECT avatar FROM clients WHERE ID = '".$_SESSION["ID"]."'";
							$result_avatar = mysqli_query($con,$sql_avatar);
							$row_avatar = mysqli_fetch_array($result_avatar);
							if ($row_avatar['avatar']==""){
								$base64_img = "images/avatar.png";
							}else{
								$base64_img = $row_avatar['avatar'];
								$base64_img = base64_decode($base64_img);
							}
							echo '<form action="info_update.php" method="post">
							<div style="width: 200px;height: 200px;border: solid 1px #555;padding: 5px;margin-top: 10px; border-radius:50%;">
									<img class="finalImg" width="100%" style="border-radius:50%;" src="'.$base64_img.'">
								</div>
								<input type="textarea" class="finalText" name="img" value="'.$base64_img.'" style="display:none;">
								<input type="submit" class="cart_total_button" width="50%" value="Save Changes" style="margin-left: 5%; margin-top: -4%; width: 30%; border-radius: 5px; position: absolute;"></input>
								</form>';
							?>
							<br/><br/><br/><br/>

							<!--Tailoring Start-->
							<div style="display: none" class="tailoring-container">
								<div class="black-cloth" onClick="closeTailor(this)"></div>
								<div class="tailoring-content">
										<div class="tailoring-content-one">
											<label title="Upload Avatar" for="chooseImg" class="l-btn choose-btn">
												<input type="file" accept="image/jpg,image/jpeg,image/png" name="file" id="chooseImg" class="hidden" onChange="selectImg(this)">
												Select from file...
											</label>
											<div class="close-tailoring"  onclick="closeTailor(this)">×</div>
										</div>
										<div class="tailoring-content-two">
											<div class="tailoring-box-parcel">
												<img id="tailoringImg">
											</div>
											<div class="preview-box-parcel">
												<p>Preview：</p>
												<div class="circular previewImg"></div>
											</div>
										</div>
										<div class="tailoring-content-three">
											<button class="l-btn cropper-reset-btn">Reset</button>
											<button class="l-btn cropper-rotate-btn">Rotate</button>
											<button class="l-btn cropper-scaleX-btn">Mirror</button>
											<button class="l-btn sureCut" id="sureCut">OK</button>
										</div>
									</div>
							</div>
						<?php echo '
								<form action="info_update.php" method="post" id="checkout_form">
								<div class="checkout_title">Account Information</div>
								<div class="checkout_form_container">
								<div class="d-flex flex-lg-row flex-column align-items-start justify-content-between">
									<input type="text" class="checkout_input checkout_input_50" name="Firstname" value="';
									if (isset($_SESSION["ID"])){
										$sql = "select ID,email,user_name from clients where ID = '$ID'";
										$result = mysqli_query($con,$sql);
										while($row = mysqli_fetch_array($result)) {
											$userName = $row['user_name'];
											$email = $row['email'];
										}
										$sql_address = "select clientID,address_usage,first_name,last_name,company_name,country,address,town,state,zip_code,phone_No From address where clientID='$ID'";
										$result_address = mysqli_query($con,$sql_address);
										$num_address = mysqli_num_rows($result_address);
										echo $first_name.'" required="required">
									<input type="text" class="checkout_input checkout_input_50" name="Lastname" value="'.$last_name.'" required="required">
								</div>
								<input type="text" class="checkout_input" name="Username" value="'.$userName.'" required="required">
								<input type="text" class="checkout_input" name="E-mail" value="'.$email.'" required="required">
								<input type="submit" class="cart_total_button" value="Save Changes"></input>
							</form>
							<br/><br/><br/><br/><br/>
								<div class="checkout_title">Change Password</div>
							<form action="info_update.php" method="post">
								<div class="checkout_form_container">
								<input type="password" class="checkout_input" placeholder="Password" name="Password" required="required">
								<input type="password" class="checkout_input" placeholder="Confirm PW" name="Confirm_PW"  required="required">
								</div>
								<input type="submit" class="cart_total_button" value="Save Changes"></input>
							</form>
						</div>
					</div>
				</div>

				<!-- Cart Details -->
				<div class="col-lg-6">
					<div class="cart_details">
						<div class="checkout_title">Address Settings</div>
							<div class="cart_total">
							<form action="info_update.php" method="post">
								<div class="d-flex flex-lg-row flex-column align-items-start justify-content-between">
									<input type="text" class="checkout_input checkout_input_50" name="shipping_fn" ';
									if ($num_address != 0){
										while($row_address = mysqli_fetch_array($result_address)) {
											if ($row_address["address_usage"]=="shipping"){
												$shipping_fn = $row_address["first_name"];
												$shipping_ln = $row_address["last_name"];
												$shipping_cn = $row_address["company_name"];
												$country = $row_address["country"];
												$address = $row_address["address"];
												$town = $row_address["town"];
												$state = $row_address["state"];
												$zip_code = $row_address["zip_code"];
												$phone_No = $row_address["phone_No"];
											}
										}
									}
									if (isset($shipping_fn)){
										echo 'value="'.$shipping_fn.'" required="required">
										<input type="text" class="checkout_input checkout_input_50" name="shipping_ln" value="'.$shipping_ln.'" required="required">';
									}else{
										echo 'placeholder="First Name" required="required">
										<input type="text" class="checkout_input checkout_input_50" name="shipping_ln" placeholder="Last Name" required="required">';
									}echo '
								</div>
								<input type="text" class="checkout_input" name="shipping_cn" ';
								if (isset($shipping_cn)&&$shipping_cn!=""){
									echo 'value="'.$shipping_cn;
								}else{
									echo 'placeholder="Company Name';
								}
								echo '">
								<select name="Country" id="country" class="country_select checkout_input">';
								if (isset($country)){
									echo '<option selected = "selected">'.$country.'</option>';
								}echo '
									<option value="Afghanistan">Afghanistan</option>
									<option value="Albania">Albania</option>
									<option value="Algeria">Algeria</option>
									<option value="American Samoa">American Samoa</option>
									<option value="Andorra">Andorra</option>
									<option value="Anguilla">Anguilla</option>
									<option value="Antarctica">Antarctica</option>
									<option value="Antigua And Barbuda">Antigua And Barbuda</option>
									<option value="Argentina">Argentina</option>
									<option value="Armenia">Armenia</option>
									<option value="Aruba">Aruba</option>
									<option value="Australia"';
									if (!isset($country)){
										echo ' selected = "selected"';
									}
									echo '>Australia</option>
									<option value="Austria">Austria</option>
									<option value="Ayerbaijan">Ayerbaijan</option>
									<option value="Bahamas, The">Bahamas, The</option>
									<option value="Bahrain">Bahrain</option>
									<option value="Bangladesh">Bangladesh</option>
									<option value="Barbados">Barbados</option>
									<option value="Belarus">Belarus</option>
									<option value="Belize">Belize</option>
									<option value="Belgium">Belgium</option>
									<option value="Benin">Benin</option>
									<option value="Bermuda">Bermuda</option>
									<option value="Bhutan">Bhutan</option>
									<option value="Bolivia">Bolivia</option>
									<option value="Bouvet Is">Bouvet Is</option>
									<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
									<option value="Botswana">Botswana</option>
									<option value="Brazil">Brazil</option>
									<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
									<option value="Brunei">Brunei</option>
									<option value="Bulgaria">Bulgaria</option>
									<option value="Burkina Faso">Burkina Faso</option>
									<option value="Burundi">Burundi</option>
									<option value="Cambodia">Cambodia</option>
									<option value="Cameroon">Cameroon</option>
									<option value="Canada">Canada</option>
									<option value="Cape Verde">Cape Verde</option>
									<option value="Cayman Is">Cayman Is</option>
									<option value="Central African Republic">Central African Republic</option>
									<option value="Chad">Chad</option>
									<option value="Chile">Chile</option>
									<option value="China">China</option>
									<option value="China (Hong Kong S.A.R.)">China (Hong Kong S.A.R.)</option>
									<option value="China (Macau S.A.R.)">China (Macau S.A.R.)</option>
									<option value="China (Taiwan T.W)">China (Taiwan T.W)</option>
									<option value="Christmas Is">Christmas Is</option>
									<option value="Cocos (Keeling) Is">Cocos (Keeling) Is</option>
									<option value="Colombia">Colombia</option>
									<option value="Comoros">Comoros</option>
									<option value="Cook Islands">Cook Islands</option>
									<option value="Costa Rica">Costa Rica</option>
									<option value="Cote D’Ivoire (Ivory Coast)">Cote D’Ivoire (Ivory Coast)</option>
									<option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
									<option value="Cyprus">Cyprus</option>
									<option value="Czech Republic">Czech Republic</option>
									<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
									<option value="Denmark">Denmark</option>
									<option value="Dominica">Dominica</option>
									<option value="Dominican Republic">Dominican Republic</option>
									<option value="Djibouti">Djibouti</option>
									<option value="East Timor">East Timor</option>
									<option value="Ecuador">Ecuador</option>
									<option value="Egypt">Egypt</option>
									<option value="El Salvador">El Salvador</option>
									<option value="Equatorial Guinea">Equatorial Guinea</option>
									<option value="Eritrea">Eritrea</option>
									<option value="Estonia">Estonia</option>
									<option value="Ethiopia">Ethiopia</option>
									<option value="Falkland Is (Is Malvinas)">Falkland Is (Is Malvinas)</option>
									<option value="Faroe Islands">Faroe Islands</option>
									<option value="Fiji Islands">Fiji Islands</option>
									<option value="Finland">Finland</option>
									<option value="France">France</option>
									<option value="French Guiana">French Guiana</option>
									<option value="French Polynesia">French Polynesia</option>
									<option value="French Southern Territories">French Southern Territories</option>
									<option value="F.Y.R.O. Macedonia">F.Y.R.O. Macedonia</option>
									<option value="Gabon">Gabon</option>
									<option value="Gambia, The">Gambia, The</option>
									<option value="Georgia">Georgia</option>
									<option value="Germany">Germany</option>
									<option value="Ghana">Ghana</option>
									<option value="Gibraltar">Gibraltar</option>
									<option value="Greece">Greece</option>
									<option value="Greenland">Greenland</option>
									<option value="Grenada">Grenada</option>
									<option value="Guadeloupe">Guadeloupe</option>
									<option value="Guam">Guam</option>
									<option value="Guatemala">Guatemala</option>
									<option value="Guinea">Guinea</option>
									<option value="Guinea-Bissau">Guinea-Bissau</option>
									<option value="Guyana">Guyana</option>
									<option value="Haiti">Haiti</option>
									<option value="Heard and McDonald Is">Heard and McDonald Is</option>
									<option value="Honduras">Honduras</option>
									<option value="Hungary">Hungary</option>
									<option value="Iceland">Iceland</option>
									<option value="India">India</option>
									<option value="Indonesia">Indonesia</option>
									<option value="Ireland">Ireland</option>
									<option value="Israel">Israel</option>
									<option value="Italy">Italy</option>
									<option value="Jamaica">Jamaica</option>
									<option value="Japan">Japan</option>
									<option value="Jordan">Jordan</option>
									<option value="Kayakhstan">Kayakhstan</option>
									<option value="Kenya">Kenya</option>
									<option value="Kiribati">Kiribati</option>
									<option value="Korea, South">Korea, South</option>
									<option value="Kuwait">Kuwait</option>
									<option value="Kyrgyzstan">Kyrgyzstan</option>
									<option value="Laos">Laos</option>
									<option value="Latvia">Latvia</option>
									<option value="Lebanon">Lebanon</option>
									<option value="Lesotho">Lesotho</option>
									<option value="Liberia">Liberia</option>
									<option value="Liechtenstein">Liechtenstein</option>
									<option value="Lithuania">Lithuania</option>
									<option value="Luxembourg">Luxembourg</option>
									<option value="Madagascar">Madagascar</option>
									<option value="Malawi">Malawi</option>
									<option value="Malaysia">Malaysia</option>
									<option value="Maldives">Maldives</option>
									<option value="Mali">Mali</option>
									<option value="Malta">Malta</option>
									<option value="Marshall Is">Marshall Is</option>
									<option value="Mauritania">Mauritania</option>
									<option value="Mauritius">Mauritius</option>
									<option value="Martinique">Martinique</option>
									<option value="Mayotte">Mayotte</option>
									<option value="Mexico">Mexico</option>
									<option value="Micronesia">Micronesia</option>
									<option value="Moldova">Moldova</option>
									<option value="Monaco">Monaco</option>
									<option value="Mongolia">Mongolia</option>
									<option value="Montserrat">Montserrat</option>
									<option value="Morocco">Morocco</option>
									<option value="Mozambique">Mozambique</option>
									<option value="Myanmar">Myanmar</option>
									<option value="Namibia">Namibia</option>
									<option value="Nauru">Nauru</option>
									<option value="Nepal">Nepal</option>
									<option value="Netherlands, The">Netherlands, The</option>
									<option value="Netherlands Antilles">Netherlands Antilles</option>
									<option value="New Caledonia">New Caledonia</option>
									<option value="New Zealand">New Zealand</option>
									<option value="Nicaragua">Nicaragua</option>
									<option value="Niger">Niger</option>
									<option value="Nigeria">Nigeria</option>
									<option value="Niue">Niue</option>
									<option value="Norway">Norway</option>
									<option value="Norfolk Island">Norfolk Island</option>
									<option value="Northern Mariana Is">Northern Mariana Is</option>
									<option value="Oman">Oman</option>
									<option value="Pakistan">Pakistan</option>
									<option value="Palau">Palau</option>
									<option value="Panama">Panama</option>
									<option value="Papua new Guinea">Papua new Guinea</option>
									<option value="Paraguay">Paraguay</option>
									<option value="Peru">Peru</option>
									<option value="Philippines">Philippines</option>
									<option value="Pitcairn Island">Pitcairn Island</option>
									<option value="Poland">Poland</option>
									<option value="Portugal">Portugal</option>
									<option value="Puerto Rico">Puerto Rico</option>
									<option value="Qatar">Qatar</option>
									<option value="Republic of the Congo">Republic of the Congo</option>
									<option value="Reunion">Reunion</option>
									<option value="Romania">Romania</option>
									<option value="Russia">Russia</option>
									<option value="Saint Helena">Saint Helena</option>
									<option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
									<option value="Saint Lucia">Saint Lucia</option>
									<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
									<option value="Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option>
									<option value="Samoa">Samoa</option>
									<option value="San Marino">San Marino</option>
									<option value="Sao Tome and Principe">Sao Tome and Principe</option>
									<option value="Saudi Arabia">Saudi Arabia</option>
									<option value="Senegal">Senegal</option>
									<option value="Seychelles">Seychelles</option>
									<option value="Sierra Leone">Sierra Leone</option>
									<option value="Singapore">Singapore</option>
									<option value="Slovakia">Slovakia</option>
									<option value="Slovenia">Slovenia</option>
									<option value="Solomon Islands">Solomon Islands</option>
									<option value="Somalia">Somalia</option>
									<option value="South Africa">South Africa</option>
									<option value="South Georgia & The S. Sandwich Is">South Georgia & The S. Sandwich Is</option>
									<option value="Spain">Spain</option>
									<option value="Sri Lanka">Sri Lanka</option>
									<option value="Suriname">Suriname</option>
									<option value="Svalbard And Jan Mayen Is">Svalbard And Jan Mayen Is</option>
									<option value="Swaziland">Swaziland</option>
									<option value="Sweden">Sweden</option>
									<option value="Switzerland">Switzerland</option>
									<option value="Syria">Syria</option>
									<option value="Tajikistan">Tajikistan</option>
									<option value="Tanzania">Tanzania</option>
									<option value="Thailand">Thailand</option>
									<option value="Timor-Leste">Timor-Leste</option>
									<option value="Togo">Togo</option>
									<option value="Tokelau">Tokelau</option>
									<option value="Tonga">Tonga</option>
									<option value="Trinidad And Tobago">Trinidad And Tobago</option>
									<option value="Tunisia">Tunisia</option>
									<option value="Turkey">Turkey</option>
									<option value="Turks And Caicos Is">Turks And Caicos Is</option>
									<option value="Turkmenistan">Turkmenistan</option>
									<option value="Tuvalu">Tuvalu</option>
									<option value="Uganda">Uganda</option>
									<option value="Ukraine">Ukraine</option>
									<option value="United Arab Emirates">United Arab Emirates</option>
									<option value="United Kingdom">United Kingdom</option>
									<option value="United States">United States</option>
									<option value="United States Minor Outlying Is">United States Minor Outlying Is</option>
									<option value="Uruguay">Uruguay</option>
									<option value="Uzbekistan">Uzbekistan</option>
									<option value="Vanuatu">Vanuatu</option>
									<option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
									<option value="Venezuela">Venezuela</option>
									<option value="Vietnam">Vietnam</option>
									<option value="Virgin Islands (British)">Virgin Islands (British)</option>
									<option value="Virgin Islands (US)">Virgin Islands (US)</option>
									<option value="Wallis And Futuna Islands">Wallis And Futuna Islands</option>
									<option value="Western Sahara">Western Sahara</option>
									<option value="Yemen">Yemen</option>
									<option value="Zambia">Zambia</option>
									<option value="Zimbabw">Zimbabw</option>
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
								<div class="billing_options">
									<div class="billing_account">
										<input name="regular_checkbox_1" type="hidden" value="false">
										<input type="checkbox" id="checkbox_account" name="regular_checkbox_1" class="regular_checkbox checkbox_account" value="billing" style="visibility:hidden;">
										<label for="checkbox_account"><img src="images/checked.png" alt="checkbox"></label>
										<span>Set as default billing address</span>
									</div>
									<div class="billing_shipping">
										<input name="regular_checkbox_2" type="hidden" value="false">
										<input type="checkbox" id="checkbox_shipping" name="regular_checkbox_2" class="regular_checkbox checkbox_shipping" value="shipping" style="visibility:hidden;">
										<label for="checkbox_shipping"><img src="images/checked.png" alt="checkbox"></label>
										<span>Set as default shipping address</span>
									</div>
								</div>
								<input type="submit" class="cart_total_button" value="Save Changes"></input>
								</form>
								<br/><br/>
								
								<div class="billing_options">
									<div class="billing_shipping">
										<details>
											<summary><span>Ship to a different address</span></summary>
											<br/><br/>
											<form action="info_update.php" method="post">
											<div class="d-flex flex-lg-row flex-column align-items-start justify-content-between">
												<input type="text" class="checkout_input checkout_input_50" name="shipping_fn_2" placeholder="First Name" required="required">
												<input type="text" class="checkout_input checkout_input_50" name="shipping_ln_2" placeholder="Last Name" required="required">
											</div>
											<input type="text" class="checkout_input" name="shipping_cn_2" placeholder="Company Name">
											<select name="Country_2" id="country" class="country_select checkout_input">
											<option value="Afghanistan">Afghanistan</option>
											<option value="Albania">Albania</option>
											<option value="Algeria">Algeria</option>
											<option value="American Samoa">American Samoa</option>
											<option value="Andorra">Andorra</option>
											<option value="Anguilla">Anguilla</option>
											<option value="Antarctica">Antarctica</option>
											<option value="Antigua And Barbuda">Antigua And Barbuda</option>
											<option value="Argentina">Argentina</option>
											<option value="Armenia">Armenia</option>
											<option value="Aruba">Aruba</option>
											<option value="Australia" selected = "selected">Australia</option>
											<option value="Austria">Austria</option>
											<option value="Ayerbaijan">Ayerbaijan</option>
											<option value="Bahamas, The">Bahamas, The</option>
											<option value="Bahrain">Bahrain</option>
											<option value="Bangladesh">Bangladesh</option>
											<option value="Barbados">Barbados</option>
											<option value="Belarus">Belarus</option>
											<option value="Belize">Belize</option>
											<option value="Belgium">Belgium</option>
											<option value="Benin">Benin</option>
											<option value="Bermuda">Bermuda</option>
											<option value="Bhutan">Bhutan</option>
											<option value="Bolivia">Bolivia</option>
											<option value="Bouvet Is">Bouvet Is</option>
											<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
											<option value="Botswana">Botswana</option>
											<option value="Brazil">Brazil</option>
											<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
											<option value="Brunei">Brunei</option>
											<option value="Bulgaria">Bulgaria</option>
											<option value="Burkina Faso">Burkina Faso</option>
											<option value="Burundi">Burundi</option>
											<option value="Cambodia">Cambodia</option>
											<option value="Cameroon">Cameroon</option>
											<option value="Canada">Canada</option>
											<option value="Cape Verde">Cape Verde</option>
											<option value="Cayman Is">Cayman Is</option>
											<option value="Central African Republic">Central African Republic</option>
											<option value="Chad">Chad</option>
											<option value="Chile">Chile</option>
											<option value="China">China</option>
											<option value="China (Hong Kong S.A.R.)">China (Hong Kong S.A.R.)</option>
											<option value="China (Macau S.A.R.)">China (Macau S.A.R.)</option>
											<option value="China (Taiwan T.W)">China (Taiwan T.W)</option>
											<option value="Christmas Is">Christmas Is</option>
											<option value="Cocos (Keeling) Is">Cocos (Keeling) Is</option>
											<option value="Colombia">Colombia</option>
											<option value="Comoros">Comoros</option>
											<option value="Cook Islands">Cook Islands</option>
											<option value="Costa Rica">Costa Rica</option>
											<option value="Cote D’Ivoire (Ivory Coast)">Cote D’Ivoire (Ivory Coast)</option>
											<option value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>
											<option value="Cyprus">Cyprus</option>
											<option value="Czech Republic">Czech Republic</option>
											<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
											<option value="Denmark">Denmark</option>
											<option value="Dominica">Dominica</option>
											<option value="Dominican Republic">Dominican Republic</option>
											<option value="Djibouti">Djibouti</option>
											<option value="East Timor">East Timor</option>
											<option value="Ecuador">Ecuador</option>
											<option value="Egypt">Egypt</option>
											<option value="El Salvador">El Salvador</option>
											<option value="Equatorial Guinea">Equatorial Guinea</option>
											<option value="Eritrea">Eritrea</option>
											<option value="Estonia">Estonia</option>
											<option value="Ethiopia">Ethiopia</option>
											<option value="Falkland Is (Is Malvinas)">Falkland Is (Is Malvinas)</option>
											<option value="Faroe Islands">Faroe Islands</option>
											<option value="Fiji Islands">Fiji Islands</option>
											<option value="Finland">Finland</option>
											<option value="France">France</option>
											<option value="French Guiana">French Guiana</option>
											<option value="French Polynesia">French Polynesia</option>
											<option value="French Southern Territories">French Southern Territories</option>
											<option value="F.Y.R.O. Macedonia">F.Y.R.O. Macedonia</option>
											<option value="Gabon">Gabon</option>
											<option value="Gambia, The">Gambia, The</option>
											<option value="Georgia">Georgia</option>
											<option value="Germany">Germany</option>
											<option value="Ghana">Ghana</option>
											<option value="Gibraltar">Gibraltar</option>
											<option value="Greece">Greece</option>
											<option value="Greenland">Greenland</option>
											<option value="Grenada">Grenada</option>
											<option value="Guadeloupe">Guadeloupe</option>
											<option value="Guam">Guam</option>
											<option value="Guatemala">Guatemala</option>
											<option value="Guinea">Guinea</option>
											<option value="Guinea-Bissau">Guinea-Bissau</option>
											<option value="Guyana">Guyana</option>
											<option value="Haiti">Haiti</option>
											<option value="Heard and McDonald Is">Heard and McDonald Is</option>
											<option value="Honduras">Honduras</option>
											<option value="Hungary">Hungary</option>
											<option value="Iceland">Iceland</option>
											<option value="India">India</option>
											<option value="Indonesia">Indonesia</option>
											<option value="Ireland">Ireland</option>
											<option value="Israel">Israel</option>
											<option value="Italy">Italy</option>
											<option value="Jamaica">Jamaica</option>
											<option value="Japan">Japan</option>
											<option value="Jordan">Jordan</option>
											<option value="Kayakhstan">Kayakhstan</option>
											<option value="Kenya">Kenya</option>
											<option value="Kiribati">Kiribati</option>
											<option value="Korea, South">Korea, South</option>
											<option value="Kuwait">Kuwait</option>
											<option value="Kyrgyzstan">Kyrgyzstan</option>
											<option value="Laos">Laos</option>
											<option value="Latvia">Latvia</option>
											<option value="Lebanon">Lebanon</option>
											<option value="Lesotho">Lesotho</option>
											<option value="Liberia">Liberia</option>
											<option value="Liechtenstein">Liechtenstein</option>
											<option value="Lithuania">Lithuania</option>
											<option value="Luxembourg">Luxembourg</option>
											<option value="Madagascar">Madagascar</option>
											<option value="Malawi">Malawi</option>
											<option value="Malaysia">Malaysia</option>
											<option value="Maldives">Maldives</option>
											<option value="Mali">Mali</option>
											<option value="Malta">Malta</option>
											<option value="Marshall Is">Marshall Is</option>
											<option value="Mauritania">Mauritania</option>
											<option value="Mauritius">Mauritius</option>
											<option value="Martinique">Martinique</option>
											<option value="Mayotte">Mayotte</option>
											<option value="Mexico">Mexico</option>
											<option value="Micronesia">Micronesia</option>
											<option value="Moldova">Moldova</option>
											<option value="Monaco">Monaco</option>
											<option value="Mongolia">Mongolia</option>
											<option value="Montserrat">Montserrat</option>
											<option value="Morocco">Morocco</option>
											<option value="Mozambique">Mozambique</option>
											<option value="Myanmar">Myanmar</option>
											<option value="Namibia">Namibia</option>
											<option value="Nauru">Nauru</option>
											<option value="Nepal">Nepal</option>
											<option value="Netherlands, The">Netherlands, The</option>
											<option value="Netherlands Antilles">Netherlands Antilles</option>
											<option value="New Caledonia">New Caledonia</option>
											<option value="New Zealand">New Zealand</option>
											<option value="Nicaragua">Nicaragua</option>
											<option value="Niger">Niger</option>
											<option value="Nigeria">Nigeria</option>
											<option value="Niue">Niue</option>
											<option value="Norway">Norway</option>
											<option value="Norfolk Island">Norfolk Island</option>
											<option value="Northern Mariana Is">Northern Mariana Is</option>
											<option value="Oman">Oman</option>
											<option value="Pakistan">Pakistan</option>
											<option value="Palau">Palau</option>
											<option value="Panama">Panama</option>
											<option value="Papua new Guinea">Papua new Guinea</option>
											<option value="Paraguay">Paraguay</option>
											<option value="Peru">Peru</option>
											<option value="Philippines">Philippines</option>
											<option value="Pitcairn Island">Pitcairn Island</option>
											<option value="Poland">Poland</option>
											<option value="Portugal">Portugal</option>
											<option value="Puerto Rico">Puerto Rico</option>
											<option value="Qatar">Qatar</option>
											<option value="Republic of the Congo">Republic of the Congo</option>
											<option value="Reunion">Reunion</option>
											<option value="Romania">Romania</option>
											<option value="Russia">Russia</option>
											<option value="Saint Helena">Saint Helena</option>
											<option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
											<option value="Saint Lucia">Saint Lucia</option>
											<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
											<option value="Saint Vincent And The Grenadines">Saint Vincent And The Grenadines</option>
											<option value="Samoa">Samoa</option>
											<option value="San Marino">San Marino</option>
											<option value="Sao Tome and Principe">Sao Tome and Principe</option>
											<option value="Saudi Arabia">Saudi Arabia</option>
											<option value="Senegal">Senegal</option>
											<option value="Seychelles">Seychelles</option>
											<option value="Sierra Leone">Sierra Leone</option>
											<option value="Singapore">Singapore</option>
											<option value="Slovakia">Slovakia</option>
											<option value="Slovenia">Slovenia</option>
											<option value="Solomon Islands">Solomon Islands</option>
											<option value="Somalia">Somalia</option>
											<option value="South Africa">South Africa</option>
											<option value="South Georgia & The S. Sandwich Is">South Georgia & The S. Sandwich Is</option>
											<option value="Spain">Spain</option>
											<option value="Sri Lanka">Sri Lanka</option>
											<option value="Suriname">Suriname</option>
											<option value="Svalbard And Jan Mayen Is">Svalbard And Jan Mayen Is</option>
											<option value="Swaziland">Swaziland</option>
											<option value="Sweden">Sweden</option>
											<option value="Switzerland">Switzerland</option>
											<option value="Syria">Syria</option>
											<option value="Tajikistan">Tajikistan</option>
											<option value="Tanzania">Tanzania</option>
											<option value="Thailand">Thailand</option>
											<option value="Timor-Leste">Timor-Leste</option>
											<option value="Togo">Togo</option>
											<option value="Tokelau">Tokelau</option>
											<option value="Tonga">Tonga</option>
											<option value="Trinidad And Tobago">Trinidad And Tobago</option>
											<option value="Tunisia">Tunisia</option>
											<option value="Turkey">Turkey</option>
											<option value="Turks And Caicos Is">Turks And Caicos Is</option>
											<option value="Turkmenistan">Turkmenistan</option>
											<option value="Tuvalu">Tuvalu</option>
											<option value="Uganda">Uganda</option>
											<option value="Ukraine">Ukraine</option>
											<option value="United Arab Emirates">United Arab Emirates</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="United States">United States</option>
											<option value="United States Minor Outlying Is">United States Minor Outlying Is</option>
											<option value="Uruguay">Uruguay</option>
											<option value="Uzbekistan">Uzbekistan</option>
											<option value="Vanuatu">Vanuatu</option>
											<option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
											<option value="Venezuela">Venezuela</option>
											<option value="Vietnam">Vietnam</option>
											<option value="Virgin Islands (British)">Virgin Islands (British)</option>
											<option value="Virgin Islands (US)">Virgin Islands (US)</option>
											<option value="Wallis And Futuna Islands">Wallis And Futuna Islands</option>
											<option value="Western Sahara">Western Sahara</option>
											<option value="Yemen">Yemen</option>
											<option value="Zambia">Zambia</option>
											<option value="Zimbabw">Zimbabw</option>
											</select>
											<input type="text" class="checkout_input" name="Address_2" placeholder="Address" required="required">
											<input type="text" class="checkout_input" name="Town_2" placeholder="City" required="required">
											<input type="text" class="checkout_input" name="State_2" placeholder="State" required="required">
											<div class="d-flex flex-lg-row flex-column align-items-start justify-content-between">
												<input type="text" class="checkout_input checkout_input_50" name="Zipcode_2" placeholder="Zipcode" required="required">
												<input type="text" class="checkout_input checkout_input_50" name="Phone_No_2" placeholder="Phone No" required="required">
											</div>
											<input type="submit" class="cart_total_button" value="Save Changes"></input>
											</form>
											</details>
										</div>
									</div>
									<br/><br/><br/><br/>
									<div class="checkout_title">My Orders</div>';
								$sql_orders = "select clientID,orderID,productID,productName,quantity,price,discount,date,paymentStatus from orders where clientID = '$ID' GROUP BY orderID";
								$result_orders = mysqli_query($con,$sql_orders);
								$num_rows = mysqli_num_rows($result_orders);
								if($num_rows){
									$orderID=0;
									while($row_orders = mysqli_fetch_array($result_orders)){
										$price_total = round($row_orders['price']*$row_orders['quantity'],2);
										if ($num_rows != 0){
											$num_rows = $num_rows-1;
										if ($orderID==0){
											$total_price = 0;
										echo '<div class="cart_total">
											<div class="cart_title">'.$row_orders["date"].'</div>
											<ul>
												<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">Order ID</div>
													<div class="cart_total_price ml-auto">AU$'.$row_orders["orderID"].'</div>
												</li>
												<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">'.$row_orders['productName'].'×'.$row_orders['quantity'].'</div>
													<div class="cart_total_price ml-auto">AU$'.$price_total.'</div>
												</li>';
											$total_price += $price_total;
											$orderID=$row_orders["orderID"];
										}else if ($orderID==$row_orders["orderID"]){
											echo '<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">'.$row_orders['productName'].'×'.$row_orders['quantity'].'</div>
													<div class="cart_total_price ml-auto">AU$'.$price_total.'</div>
												</li>';
												$total_price += $price_total;
										}else{
											if ($row_orders['discount'] != 1){
											echo '<li class="d-flex flex-row align-items-center justify-content-start" style="color:#db2929;">
												<div class="cart_total_title">Discount</div>
												<div class="cart_total_price ml-auto">－AU$'.round((1-$row_orders['discount'])*$total_price,2).'</div>
											</li>';
											}
												echo '<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">Shipping</div>
													<div class="cart_total_price ml-auto">AU$0.00</div>
												</li>
												<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">Total</div>
													<div class="cart_total_price ml-auto">AU$';
													if ($row_orders['discount'] != 1){
													echo round($total_price*$row_orders['discount'],2);
												}else{
													echo $total_price;
												}
													echo '</div>
												</li>
												<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">Payment Status</div>
													<div class="cart_total_price ml-auto">'.$row_orders['paymentStatus'].'</div>
												</li>
											</ul>
										</div>';
										$total_price = 0;
										echo '<div class="cart_total">
											<div class="cart_title">'.$row_orders["date"].'</div>
											<ul>
												<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">Order ID</div>
													<div class="cart_total_price ml-auto">AU$'.$row_orders["orderID"].'</div>
												</li>
												<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">'.$row_orders['productName'].'×'.$row_orders['quantity'].'</div>
													<div class="cart_total_price ml-auto">AU$'.$price_total.'</div>
												</li>';
										$total_price += $price_total;
										$orderID=$row_orders["orderID"];
										}
									}if($num_rows == 0){
										if ($row_orders['discount'] != 1){
											echo '<li class="d-flex flex-row align-items-center justify-content-start" style="color:#db2929;">
												<div class="cart_total_title">Discount</div>
												<div class="cart_total_price ml-auto">－AU$'.round((1-$row_orders['discount'])*$total_price,2).'</div>
											</li>';
										}
										echo '<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">Shipping</div>
													<div class="cart_total_price ml-auto">AU$0.00</div>
												</li>
												<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">Total</div>
													<div class="cart_total_price ml-auto">AU$';
												if ($row_orders['discount'] != 1){
													echo round($total_price*$row_orders['discount'],2);
												}else{
													echo $total_price;
												}
													echo '</div>
												</li>
												<li class="d-flex flex-row align-items-center justify-content-start">
													<div class="cart_total_title">Payment Status</div>
													<div class="cart_total_price ml-auto">'.$row_orders['paymentStatus'].'</div>
												</li>
											</ul>
										</div>
										<form action="logout.php" method="post">
											<input type="submit" name="submit" class="cart_total_button" value="Logout" style="width:50%;"></input>
										</form>';
									}}
								}else{
									
									echo '<br/><br/><br/>
										  <p>&emsp;You have placed no orders.</p>
										<form action="logout.php" method="post">
											<input type="submit" name="submit" class="cart_total_button" value="Logout" style="width:50%;"></input>
										</form>';
								}echo '
								
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>';}
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
						<div class="newsletter_text">Integer ut imperdiet erat. Quisque ultricies lectus tellus, eu tristique magna pharetra nec. Fusce vel lorem libero. Integer ex mi, facilisis sed nisi ut, vestib ulum ultrices nulla. Aliquam egestas tempor leo.</div>
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
					<div class="footer_logo"><a href="#">Fashion Closet</a></div>
					<nav class="footer_nav">
						<ul>
							<li><a href="index.php">home</a></li>
							<li><a href="categories.php">clothes</a></li>
							<li><a href="categories.php">accessories</a></li>
							<li><a href="categories.php">shoes</a></li>
							<li><a href="contact.php">contact</a></li>
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/cropper.min.js"></script>
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
    (window.onresize = function () {
        var win_height = $(window).height();
        var win_width = $(window).width();
        if (win_width <= 768){
            $(".tailoring-content").css({
                "top": (win_height - $(".tailoring-content").outerHeight())/2,
                "left": 0
            });
        }else{
            $(".tailoring-content").css({
                "top": (win_height - $(".tailoring-content").outerHeight())/2,
                "left": (win_width - $(".tailoring-content").outerWidth())/2
            });
        }
    })();

    $(".finalImg").on("click",function () {
        $(".tailoring-container").toggle();
    });
    function selectImg(file) {
        if (!file.files || !file.files[0]){
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            var replaceSrc = evt.target.result;
            $('#tailoringImg').cropper('replace', replaceSrc,false);
        }
        reader.readAsDataURL(file.files[0]);
    }
    $('#tailoringImg').cropper({
        aspectRatio: 1/1,
        preview: '.previewImg',
        guides: false,
        autoCropArea: 0.5,
        movable: false,
        dragCrop: true,
        movable: true,
        resizable: true,
        zoomable: true,
        mouseWheelZoom: true,
        touchDragZoom: true,
        rotatable: true,
        crop: function(e) {
        }
    });
    //Rotate
    $(".cropper-rotate-btn").on("click",function () {
        $('#tailoringImg').cropper("rotate", 45);
    });
    //Reset
    $(".cropper-reset-btn").on("click",function () {
        $('#tailoringImg').cropper("reset");
    });
    //Mirror
    var flagX = true;
    $(".cropper-scaleX-btn").on("click",function () {
        if(flagX){
            $('#tailoringImg').cropper("scaleX", -1);
            flagX = false;
        }else{
            $('#tailoringImg').cropper("scaleX", 1);
            flagX = true;
        }
        flagX != flagX;
    });

    //After cut
    $("#sureCut").on("click",function () {
        if ($("#tailoringImg").attr("src") == null ){
            return false;
        }else{
            var cas = $('#tailoringImg').cropper('getCroppedCanvas');
            var base64url = cas.toDataURL('image/png');
            $(".finalImg").prop("src",base64url);
			$(".finalText").prop("value",base64url);
			
            closeTailor();
        }
    });
    function closeTailor() {
        $(".tailoring-container").toggle();
    }
</script>
</body>
</html>