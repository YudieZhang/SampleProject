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
	if (isset($_SESSION["clientID"])){
		$ID = $_SESSION["clientID"];
		$_SESSION["clientID"] = $ID;
	}
	$_SESSION["location"]="shopping";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Categories</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Wish shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" href="plugins/pagination.css" />
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="styles/demo.css" />
<link rel="stylesheet" type="text/css" href="styles/checkout-rounded.css" />
<link rel="stylesheet" type="text/css" href="styles/categories.css">
<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/pictureViewer.css">
</head>
<body>

<div class="super_container">
	
	<!-- Header + Menu -->

	<?php require_once 'header.php';?>

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/clothes_4.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_container">
						<div class="home_content">
							<div class="home_title">
						<?php
							if (isset($_SESSION["categories"])){
								echo $_SESSION["categories"];
							}else{
								echo 'Search Results';
							}echo '</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="index.php">Home</a></li>';
									if (isset($_SESSION["subCategories_1"])) {
										echo "<li><a href='search.php?categories=".$_SESSION["subCategories_1"]."'>".$_SESSION["subCategories_1"]."</li>";
									}else{
										echo "<li>Search Results</li>";
									}if (isset($_SESSION["subCategories_2"])) {
										echo "<li><a href='search.php?categories=".$_SESSION["subCategories_2"]."'>".$_SESSION["subCategories_2"]."</li>";
									}if (isset($_SESSION["subCategories_3"])) {
										echo "<li><a href='search.php?categories=".$_SESSION["subCategories_3"]."'>".$_SESSION["subCategories_3"]."</li>";
									}echo '</ul>';
						?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Products -->

	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col-12">
		
					<!-- Sidebar Left -->

					<div class="sidebar_left clearfix">

						<?php echo '
						
						<!-- Color -->
						<div class="sidebar_section">
							<div class="sidebar_title">Sort By</div>
							<div class="sidebar_section_content sidebar_color_content mCustomScrollbar" data-mcs-theme="minimal-dark" style="height:95px;">
								<ul>
									<li><a href="searchList.php?sort=price">Price</a></li>
									<li><a href="searchList.php?sort=stars">Stars</a></li>
								</ul>
							</div>
						</div>

						<!-- Size -->
						<div class="sidebar_section">
							<div class="sidebar_title">Size</div>
							<div class="sidebar_section_content">
								<ul>
									<li><a href="searchList.php?size=S">Small S</a></li>
									<li><a href="searchList.php?size=M">Medium M</a></li>
									<li><a href="searchList.php?size=L">Large L</a></li>
									<li><a href="searchList.php?size=XL">Extra Large XL</a></li>
									<li><a href="searchList.php?size=2XL">Double Extra Large XL</a></li>
								</ul>
							</div>
						</div>

						<!-- Price -->
						<div class="sidebar_section">
							<div class="sidebar_title">Price</div>
							<div class="sidebar_section_content">
								<ul>
									<li><a href="searchList.php?price=under20">$0~$20</a></li>
									<li><a href="searchList.php?price=under50">$20~$50</a></li>
									<li><a href="searchList.php?price=under100">$50~$100</a></li>
									<li><a href="searchList.php?price=over100">Over $100</a></li>
								</ul>
							</div>
						</div>
						
						<div class="search" id="search" style="margin-left:250px;">
						<form action="search.php" method="post" style="margin-left:-100px;">
							<input type="search" class="search_input menu_mm" required="required" name="keyword">
							<button type="submit" id="search_button_menu" class="search_button menu_mm"><img class="menu_mm" src="images/magnifying-glass.svg" alt=""></button>
						</form>
						</div>

					</div>
				</div>

				<div class="col-12">
					<div class="product_sorting clearfix" id="result_num">';
					?>
					</div>
				</div>
			</div>

			<div class="row products_container" style="margin-top:160px;margin-bottom:200px;">
				<div class="col">
					
					<!-- Products -->

					<div class="product_grid" style="display: inline-block;">
					<div id="Searchresult">Results will be appeared in a minute...</div>
					<div id="hiddenresult" style="display:none;">

						<!-- Product -->
						<?php
						if(isset($_GET['keyword'])){
							ini_set('max_execution_time', 900000);
						exec("python match.py ".$_GET['keyword']);
						$sql_call = "SELECT * FROM result";
						$result_call = mysqli_query($con,$sql_call);
						$result_num = mysqli_num_rows($result_call);
						while($row_call = mysqli_fetch_array($result_call)){
							$productID = $row_call['productID'];
							$sql_vec = "SELECT * FROM products WHERE productID = '$productID'";
							$result_vec = mysqli_query($con,$sql_vec);
							$row_vec = mysqli_fetch_array($result_vec);
							
							$title = $row_vec['productName'];
							$price = $row_vec['price'];
							$ori_price = $row_vec['ori_price'];
							$img_first = $row_vec['img_first'];
							$img_after = $row_vec['img_after'];
							if ($img_after == ""){
								$img_after = $img_first;
							}
							$ratings = 0;
							$sum_rate = 0;
							$rate_num = 0;
							$sql_ratings = "SELECT productID,rate FROM reviews WHERE productID='$productID'";
							$result_ratings = mysqli_query($con,$sql_ratings);
							while($row_ratings = mysqli_fetch_array($result_ratings)) {
								$sum_rate += intval($row_ratings["rate"]);
								$rate_num += 1;
							}
							$ratings = intval($sum_rate/$rate_num);
							if ($ratings == 0){
								$ratings = 5;
							}
							echo '<div class="product">
								<dl class="show">
								<div class="product_image">
									<img src='.$img_first.' alt="product_image" style="width:120%;" class="img_first">
									<img src='.$img_after.' alt="product_image" style="width:120%;" class="img_after">
								</div>
								<div class="rating rating_'.$ratings.'" data-rating="'.$ratings.'">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product_content clearfix">
									<div class="product_info">
										<div class="product_name"><a href="product.php?id='.$productID.'">'.$title.'</a></div>
										<div class="product_price">AU$'.$price.'<div class="product_ori_price"> AU$'.$ori_price.'</div></div>
									</div>
									<div class="product_options">
										<!--<div class="product_buy product_option"><a href="addCartWL.php?ID='.$productID.'" class="product_add"><img src="images/shopping-bag-white.svg" alt=""></a></div>-->';
										if (isset($_SESSION["ID"])){
											$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
											$result_match = mysqli_query($con,$sql_match);
											$num = mysqli_num_rows($result_match);
											if($num==0){
												echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
											}else{
												echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
											}
										}else if(isset($_SESSION["clientID"])){
											$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
											$result_match = mysqli_query($con,$sql_match);
											$num = mysqli_num_rows($result_match);
											if($num==0){
												echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
											}else{
												echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
											}
										}else{
											echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
										}
										echo '
									</div>
								</div>
								</dl>
							</div>';
						}}else if(isset($_GET['sort'])){
							ini_set('max_execution_time', 900000);
							if ($_GET['sort']=='price'){
								$sql_call = "SELECT productID FROM result";
								$result_call = mysqli_query($con,$sql_call);
								$result_num = mysqli_num_rows($result_call);
								$ids = "(";
								while($row_call = mysqli_fetch_array($result_call)){
									$productID = $row_call['productID'];
									$ids += "'".$productID."',";
								}
								$ids -= ",";
								$ids += ")";
								$sql_price = "SELECT * FROM products WHERE productID IN $ids ORDER BY price DESC";
								$result_price = mysqli_query($con,$sql_price);
							}else if ($_GET['sort']=='stars'){
								$sql_call = "SELECT productID FROM result";
								$result_call = mysqli_query($con,$sql_call);
								$result_num = mysqli_num_rows($result_call);
								$rates = array();
								while($row_call = mysqli_fetch_array($result_call)){
									$ratings = 0;
									$rate_num = 0;
									$productID = $row_call['productID'];
									$sql_ratings = "SELECT productID,rate FROM reviews WHERE productID='$productID'";
									$result_ratings = mysqli_query($con,$sql_ratings);
									while($row_ratings = mysqli_fetch_array($result_ratings)) {
										$ratings += $row_ratings["rate"];
										$rate_num += 1;
									}
									$ratings = intval($ratings/$rate_num);
									$rates["'".$productID."'"]=$ratings;
								}
								arsort($rates);
							}
						foreach($rates as $key => $val){
							$productID = $key;
							$sql_vec = "SELECT * FROM products WHERE productID = '$productID'";
							$result_vec = mysqli_query($con,$sql_vec);
							$row_vec = mysqli_fetch_array($result_vec);
							
							$title = $row_vec['productName'];
							$price = $row_vec['price'];
							$ori_price = $row_vec['ori_price'];
							$img_first = $row_vec['img_first'];
							$img_after = $row_vec['img_after'];
							if ($img_after == ""){
								$img_after = $img_first;
							}
							$ratings = 0;
							$rate_num = 0;
							$sql_ratings = "SELECT productID,rate FROM reviews WHERE productID='$productID'";
							$result_ratings = mysqli_query($con,$sql_ratings);
							while($row_ratings = mysqli_fetch_array($result_ratings)) {
								$ratings += $row_ratings["rate"];
								$rate_num += 1;
							}
							$ratings = intval($ratings/$rate_num);
							echo '<div class="product">
								<dl class="show">
								<div class="product_image">
									<img src='.$img_first.' alt="product_image" style="width:120%;" class="img_first">
									<img src='.$img_after.' alt="product_image" style="width:120%;" class="img_after">
								</div>
								<div class="rating rating_'.$ratings.'" data-rating="'.$ratings.'">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product_content clearfix">
									<div class="product_info">
										<div class="product_name"><a href="product.php?id='.$productID.'">'.$title.'</a></div>
										<div class="product_price">AU$'.$price.'<div class="product_ori_price"> AU$'.$ori_price.'</div></div>
									</div>
									<div class="product_options">
										<!--<div class="product_buy product_option"><a href="addCartWL.php?ID='.$productID.'" class="product_add"><img src="images/shopping-bag-white.svg" alt=""></a></div>-->';
										if (isset($_SESSION["ID"])){
											$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
											$result_match = mysqli_query($con,$sql_match);
											$num = mysqli_num_rows($result_match);
											if($num==0){
												echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
											}else{
												echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
											}
										}else if(isset($_SESSION["clientID"])){
											$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
											$result_match = mysqli_query($con,$sql_match);
											$num = mysqli_num_rows($result_match);
											if($num==0){
												echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
											}else{
												echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
											}
										}else{
											echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
										}
										echo '
									</div>
								</div>
								</dl>
							</div>';
						}}if (isset($_GET['size'])){
							ini_set('max_execution_time', 900000);
							$sql_call = "SELECT productID FROM result";
							$result_call = mysqli_query($con,$sql_call);
							$result_num = 0;
							$sizes = array();
							while($row_call = mysqli_fetch_array($result_call)){
								$productID = $row_call['productID'];
								$sql_sizes = "SELECT productID,size FROM sizes WHERE productID='$productID'";
								$result_sizes = mysqli_query($con,$sql_sizes);
								while($row_sizes = mysqli_fetch_array($result_sizes)) {
									if ($_GET['size']=='S'&&$row_sizes['size']=='S'){
										array_push($sizes,$row_sizes['productID']);
									}else if ($_GET['size']=='M'&&$row_sizes['size']=='M'){
										array_push($sizes,$row_sizes['productID']);
									}else if ($_GET['size']=='L'&&$row_sizes['size']=='L'){
										array_push($sizes,$row_sizes['productID']);
									}else if ($_GET['size']=='XL'&&$row_sizes['size']=='XL'){
										array_push($sizes,$row_sizes['productID']);
									}else if ($_GET['size']=='2XL'&&$row_sizes['size']=='2XL'){
										array_push($sizes,$row_sizes['productID']);
									}
							}}
						foreach($sizes as $productID){
							$result_num += 1;
							$sql_vec = "SELECT * FROM products WHERE productID = '$productID'";
							$result_vec = mysqli_query($con,$sql_vec);
							$row_vec = mysqli_fetch_array($result_vec);
							
							$title = $row_vec['productName'];
							$price = $row_vec['price'];
							$ori_price = $row_vec['ori_price'];
							$img_first = $row_vec['img_first'];
							$img_after = $row_vec['img_after'];
							if ($img_after == ""){
								$img_after = $img_first;
							}
							$ratings = 0;
							$rate_num = 0;
							$sql_ratings = "SELECT productID,rate FROM reviews WHERE productID='$productID'";
							$result_ratings = mysqli_query($con,$sql_ratings);
							while($row_ratings = mysqli_fetch_array($result_ratings)) {
								$ratings += $row_ratings["rate"];
								$rate_num += 1;
							}
							$ratings = intval($ratings/$rate_num);
							echo '<div class="product">
								<dl class="show">
								<div class="product_image">
									<img src='.$img_first.' alt="product_image" style="width:120%;" class="img_first">
									<img src='.$img_after.' alt="product_image" style="width:120%;" class="img_after">
								</div>
								<div class="rating rating_'.$ratings.'" data-rating="'.$ratings.'">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product_content clearfix">
									<div class="product_info">
										<div class="product_name"><a href="product.php?id='.$productID.'">'.$title.'</a></div>
										<div class="product_price">AU$'.$price.'<div class="product_ori_price"> AU$'.$ori_price.'</div></div>
									</div>
									<div class="product_options">
										<!--<div class="product_buy product_option"><a href="addCartWL.php?ID='.$productID.'" class="product_add"><img src="images/shopping-bag-white.svg" alt=""></a></div>-->';
										if (isset($_SESSION["ID"])){
											$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
											$result_match = mysqli_query($con,$sql_match);
											$num = mysqli_num_rows($result_match);
											if($num==0){
												echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
											}else{
												echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
											}
										}else if(isset($_SESSION["clientID"])){
											$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
											$result_match = mysqli_query($con,$sql_match);
											$num = mysqli_num_rows($result_match);
											if($num==0){
												echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
											}else{
												echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
											}
										}else{
											echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
										}
										echo '
									</div>
								</div>
								</dl>
							</div>';
						}}if(isset($_GET['price'])){
							ini_set('max_execution_time', 900000);
						$sql_call = "SELECT * FROM result";
						$result_call = mysqli_query($con,$sql_call);
						$result_num = mysqli_num_rows($result_call);
						while($row_call = mysqli_fetch_array($result_call)){
							$productID = $row_call['productID'];
							$sql_vec = "SELECT * FROM products WHERE productID = '$productID'";
							$result_vec = mysqli_query($con,$sql_vec);
							$row_vec = mysqli_fetch_array($result_vec);
							
							$title = $row_vec['productName'];
							$price = $row_vec['price'];
							if (($_GET['price']=="under20" && $price<20) OR ($_GET['price']=="under50" && $price>=20 && $price<50) OR ($_GET['price']=="under100" && $price>=50 && $price<100) OR ($_GET['price']=="over100" && $price>=100)){
							$ori_price = $row_vec['ori_price'];
							$img_first = $row_vec['img_first'];
							$img_after = $row_vec['img_after'];
							if ($img_after == ""){
								$img_after = $img_first;
							}
							$ratings = 0;
							$sum_rate = 0;
							$rate_num = 0;
							$sql_ratings = "SELECT productID,rate FROM reviews WHERE productID='$productID'";
							$result_ratings = mysqli_query($con,$sql_ratings);
							while($row_ratings = mysqli_fetch_array($result_ratings)) {
								$sum_rate += intval($row_ratings["rate"]);
								$rate_num += 1;
							}
							$ratings = intval($sum_rate/$rate_num);
							if ($ratings == 0){
								$ratings = 5;
							}
							echo '<div class="product">
								<dl class="show">
								<div class="product_image">
									<img src='.$img_first.' alt="product_image" style="width:120%;" class="img_first">
									<img src='.$img_after.' alt="product_image" style="width:120%;" class="img_after">
								</div>
								<div class="rating rating_'.$ratings.'" data-rating="'.$ratings.'">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product_content clearfix">
									<div class="product_info">
										<div class="product_name"><a href="product.php?id='.$productID.'">'.$title.'</a></div>
										<div class="product_price">AU$'.$price.'<div class="product_ori_price"> AU$'.$ori_price.'</div></div>
									</div>
									<div class="product_options">
										<!--<div class="product_buy product_option"><a href="addCartWL.php?ID='.$productID.'" class="product_add"><img src="images/shopping-bag-white.svg" alt=""></a></div>-->';
										if (isset($_SESSION["ID"])){
											$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
											$result_match = mysqli_query($con,$sql_match);
											$num = mysqli_num_rows($result_match);
											if($num==0){
												echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
											}else{
												echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
											}
										}else if(isset($_SESSION["clientID"])){
											$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
											$result_match = mysqli_query($con,$sql_match);
											$num = mysqli_num_rows($result_match);
											if($num==0){
												echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
											}else{
												echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
											}
										}else{
											echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
										}
										echo '
									</div>
								</div>
								</dl>
							</div>';
						}}}if(isset($_GET['catg'])){
							ini_set('max_execution_time', 900000);
							$sql_call = "SELECT * FROM products";
							$result_call = mysqli_query($con,$sql_call);
							$result_num = 0;
							while($row_call = mysqli_fetch_array($result_call)){
								if (stripos(strval($row_call["categories"]),"'".$_GET['catg']."'")!=false){
									$result_num += 1;
									$productID = $row_call['productID'];
									$sql_vec = "SELECT * FROM products WHERE productID = '$productID'";
									$result_vec = mysqli_query($con,$sql_vec);
									$row_vec = mysqli_fetch_array($result_vec);
									
									$title = $row_vec['productName'];
									$price = $row_vec['price'];
									$ori_price = $row_vec['ori_price'];
									$img_first = $row_vec['img_first'];
									$img_after = $row_vec['img_after'];
									if ($img_after == ""){
										$img_after = $img_first;
									}
									$ratings = 0;
									$sum_rate = 0;
									$rate_num = 0;
									$sql_ratings = "SELECT productID,rate FROM reviews WHERE productID='$productID'";
									$result_ratings = mysqli_query($con,$sql_ratings);
									while($row_ratings = mysqli_fetch_array($result_ratings)) {
										$sum_rate += intval($row_ratings["rate"]);
										$rate_num += 1;
									}
									$ratings = intval($sum_rate/$rate_num);
									if ($ratings == 0){
										$ratings = 5;
									}
									echo '<div class="product">
										<dl class="show">
										<div class="product_image">
											<img src='.$img_first.' alt="product_image" style="width:120%;" class="img_first">
											<img src='.$img_after.' alt="product_image" style="width:120%;" class="img_after">
										</div>
										<div class="rating rating_'.$ratings.'" data-rating="'.$ratings.'">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<div class="product_content clearfix">
											<div class="product_info">
												<div class="product_name"><a href="product.php?id='.$productID.'">'.$title.'</a></div>
												<div class="product_price">AU$'.$price.'<div class="product_ori_price"> AU$'.$ori_price.'</div></div>
											</div>
											<div class="product_options">
												<!--<div class="product_buy product_option"><a href="addCartWL.php?ID='.$productID.'" class="product_add"><img src="images/shopping-bag-white.svg" alt=""></a></div>-->';
												if (isset($_SESSION["ID"])){
													$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
													$result_match = mysqli_query($con,$sql_match);
													$num = mysqli_num_rows($result_match);
													if($num==0){
														echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
													}else{
														echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
													}
												}else if(isset($_SESSION["clientID"])){
													$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
													$result_match = mysqli_query($con,$sql_match);
													$num = mysqli_num_rows($result_match);
													if($num==0){
														echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
													}else{
														echo '<div class="product_fav2 product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">-</a></div>';
													}
												}else{
													echo '<div class="product_fav product_option"><a href="addCartWL.php?itemID='.$productID.'" class="product_plus">+</a></div>';
												}
												echo '
											</div>
										</div>
										</dl>
									</div>';
										}
									}
								}
							?>

					</div>
				</div>
					
			</div>
			
			
			<div class="row page_num_container" style="position: relative;">
				<div class="col text-right" style="position:fixed; left:0px; bottom:80px; z-index:999;">
					<div id="Pagination" class="pagination"></div>
					<form name="paginationoptions" method="post" action="searchList.php" style="margin-top:30px; position:absolute; right:20px;">
						<p></p>
					</form>
				</div>
			</div>

		</div>
		
		<!-- Sidebar Right -->

		<div class="sidebar_right clearfix" style="margin-left:-20px;">

			<!-- Promo 1 -->
			<div class="sidebar_promo_1 sidebar_promo d-flex flex-column align-items-center justify-content-center">
				<div class="sidebar_promo_image" style="background-image: url(images/sidebar_promo_1.jpg)"></div>
				<div class="sidebar_promo_content text-center">
					<div class="sidebar_promo_title">30%<span>off</span></div>
					<div class="sidebar_promo_subtitle">On all shoes</div>
					<div class="sidebar_promo_button"><a href="checkout.php">check out</a></div>
				</div>
			</div>

			<!-- Promo 2 -->
			<div class="sidebar_promo_2 sidebar_promo">
				<div class="sidebar_promo_image" style="background-image: url(images/sidebar_promo_2.jpg)"></div>
				<div class="sidebar_promo_content text-center">
					<div class="sidebar_promo_title">30%<span>off</span></div>
					<div class="sidebar_promo_subtitle">On all shoes</div>
					<div class="sidebar_promo_button"><a href="checkout.php">check out</a></div>
				</div>
			</div>
		</div>

	</div>

	<!-- Extra -->

	

	<!-- Newsletter -->

	<div class="newsletter" style="margin-top:30px;">
		<div class="newsletter_content">
			<div class="newsletter_image" style="background-image:url(images/newsletter.jpg)"></div>
			<div class="container">
				<div class="row">
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
	<div class="dummy-fixed" style="z-index: 999;">
				<svg class="checkout__icon" width="30px" height="30px" viewBox="0 0 35 35">
					<path d="M33.623,8.004c-0.185-0.268-0.486-0.434-0.812-0.447L12.573,6.685c-0.581-0.025-1.066,0.423-1.091,1.001 c-0.025,0.578,0.423,1.065,1.001,1.091L31.35,9.589l-3.709,11.575H11.131L8.149,4.924c-0.065-0.355-0.31-0.652-0.646-0.785 L2.618,2.22C2.079,2.01,1.472,2.274,1.26,2.812s0.053,1.146 0.591,1.357l4.343,1.706L9.23,22.4c0.092,0.497,0.524,0.857,1.03,0.857 h0.504l-1.15,3.193c-0.096,0.268-0.057,0.565,0.108,0.798c0.163,0.232,0.429,0.37,0.713,0.37h0.807 c-0.5,0.556-0.807,1.288-0.807,2.093c0,1.732,1.409,3.141,3.14,3.141c1.732,0,3.141-1.408,3.141-3.141c0-0.805-0.307-1.537-0.807-2.093h6.847c-0.5,0.556-0.806,1.288-0.806,2.093c0,1.732,1.407,3.141,3.14,3.141 c1.731,0,3.14-1.408,3.14-3.141c0-0.805-0.307-1.537-0.806-2.093h0.98c0.482,0,0.872-0.391,0.872-0.872s-0.39-0.873-0.872-0.873 H11.675l0.942-2.617h15.786c0.455,0,0.857-0.294,0.996-0.727l4.362-13.608C33.862,8.612,33.811,8.272,33.623,8.004z M13.574,31.108c-0.769,0-1.395-0.626-1.395-1.396s0.626-1.396,1.395-1.396c0.77,0,1.396,0.626,1.396,1.396S14.344,31.108,13.574,31.108z M25.089,31.108c-0.771,0-1.396 0.626-1.396-1.396s0.626-1.396,1.396-1.396c0.77,0,1.396,0.626,1.396,1.396 S25.858,31.108,25.089,31.108z"/>
				</svg>
				<div class="checkout">
					<div class="checkout__order">
						<div class="checkout__order-inner">
							<table class="checkout__summary">
								<?php
									$total_price = 0.00;
									$count = 0;
									if (isset($_SESSION['ID'])){
									$sql_items = "SELECT clientID,productID,quantity,productName,imUrl,price FROM cart WHERE clientID='".$_SESSION['ID']."'";
									$result_items = mysqli_query($con,$sql_items);
									$num_items = mysqli_num_rows($result_items);
									if($num_cart!=0){
										echo '<thead>
											<tr><th>Item</th><th>QTY</th><th>&nbsp;&nbsp;&nbsp;Price&nbsp;&nbsp;&nbsp;</th><th>&nbsp;</th></tr>
										</thead>
										<tbody>';
										
										while($row_items = mysqli_fetch_array($result_items)) {
											$productID = $row_items["productID"];
											$quantity = $row_items["quantity"];
											$productName = $row_items["productName"];
											$price = $row_items["price"];
											$total_price += $price*$quantity;
											$count += $quantity;
											
											echo '<tr><td>'.$productName.'</td><td>'.$quantity.'</td><td>$'.$price*$quantity.'</td><td><button class="checkout__action"><a href="removeCartWL.php?ID='.$productID.'"><i class="icon fa fa-trash"></i></a></button></td></tr>';
									}}else{
										echo '<tr><td><p>Your cart is empty.</p></td></tr>';
									}}else if(isset($_SESSION["clientID"])){
										$sql_items = "SELECT clientID,productID,quantity,productName,imUrl,price FROM cart WHERE clientID='".$_SESSION['clientID']."'";
									$result_items = mysqli_query($con,$sql_items);
									$num_items = mysqli_num_rows($result_items);
									if($num_cart!=0){
										echo '<thead>
											<tr><th>Item</th><th>QTY</th><th>&nbsp;&nbsp;&nbsp;Price&nbsp;&nbsp;&nbsp;</th><th>&nbsp;</th></tr>
										</thead>
										<tbody>';
										
										while($row_items = mysqli_fetch_array($result_items)) {
											$productID = $row_items["productID"];
											$quantity = $row_items["quantity"];
											$productName = $row_items["productName"];
											$price = $row_items["price"];
											$total_price += $price*$quantity;
											$count += $quantity;
											
											echo '<tr><td>'.$productName.'</td><td>'.$quantity.'</td><td>$'.$price*$quantity.'</td><td><button class="checkout__action"><a href="removeCartWL.php?ID='.$productID.'"><i class="icon fa fa-trash"></i></a></button></td></tr>';
									}}else{
										echo '<tr><td><p>Your cart is empty.</p></td></tr>';
									}}else{
										echo '<tr><td><p>Your cart is empty.</p></td></tr>';
									}echo '
								</tbody>
							</table><!-- /checkout__summary -->
							<button class="checkout__close checkout__cancel" onclick="returnOnClick()"><i class="icon fa fa-fw fa-close"></i>Close</button>
						</div><!-- /checkout__order-inner -->
					</div><!-- /checkout__order -->
					<a class="checkout__button" href="#"><!-- Fallback location -->
						<span class="checkout__text">
							<span class="checkout__text-inner checkout__initial-text" onclick="appearOnClick()">Checkout</span>
							<span class="checkout__text-inner checkout__final-text" id="checkout_btn" onclick="appearOnClick()">$'.$total_price.'<i class="fa fa-fw fa-shopping-cart"></i></span>
						</span>
					</a>
				</div><!-- /checkout -->
				<div class="checkout__count">'.$count.'</div>
			</div>';
			mysqli_close($con);
			?>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.js"></script>
<script src="plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="js/categories_custom.js"></script>
<script type="text/javascript" src="js/jquery.pagination.js"></script>
<script src="js/classie.js"></script>
<script src="js/pictureViewer.js"></script>
<script type="text/javascript">
$(document).ready(function (){	
	$("#result_num").html("<?php echo $result_num;?> PRODUCTS FOUND");
});
</script>
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
<script>
$(function () {
	$('.product_options').on('click', '.product_buy', function () {
		var this_ = $(this);
		var images = this_.parents('.product_options').find('.product_buy');
		var imagesArr = new Array();
		$.each(images, function (i, image) {
			imagesArr.push($(image).children('img').attr('src'));
		});
		$.pictureViewer({
			images: imagesArr,
			initImageIndex: this_.index() + 1,
			scrollSwitch: false
		});
	});
});
</script>
		<script>
			(function() {
				var dummy = document.getElementById('dummy-grid');
				[].slice.call( document.querySelectorAll( '.checkout' ) ).forEach( function( el ) {
					var openCtrl = el.querySelector( '.checkout__button' ),
						closeCtrl = el.querySelector( '.checkout__cancel' );

					openCtrl.addEventListener( 'click', function(ev) {
						ev.preventDefault();
						classie.add( el, 'checkout--active' );
						classie.add( dummy, 'dummy-grid--highlight' );
					} );

					closeCtrl.addEventListener( 'click', function() {
						classie.remove( el, 'checkout--active' );
						classie.remove( dummy, 'dummy-grid--highlight' );
					} );
				} );
			})();
		</script>
<script type="text/javascript">
	$(function(){
		var length = $("#hiddenresult .show").length;
		var optInit = getOptionsFromForm();
		optInit["num_display_entries"] = "5";
		optInit["num_edge_entries"] = "2";
		$("#Pagination").pagination(length, optInit);
		
		$("#setoptions").click(function(){
			var opt = getOptionsFromForm();
			opt["num_display_entries"] = "5";
			opt["num_edge_entries"] = "2";
			$("#Pagination").pagination(length, opt);
		}); 	

		function getOptionsFromForm(){
			var opt = {callback: pageselectCallback};
			$("input:text").each(function(){
				opt[this.name] = this.className.match(/numeric/) ? parseInt(this.value) : this.value;
			});
			var htmlspecialchars ={ "&":"&amp;", "<":"&lt;", ">":"&gt;", '"':"&quot;"}
			return opt;
		}

		function pageselectCallback(page_index, jq){
			var items_per_page = 12;
			var max_elem = Math.min((page_index+1) * items_per_page, length);
			
			$("#Searchresult").html("");
			for(var i=page_index*items_per_page;i<max_elem;i++){
				$("#Searchresult").append($("#hiddenresult .show:eq("+i+")").clone());
			}
			return false;
		}
	});
</script>
<script>
	function appearOnClick() {
		document.getElementById("checkout_btn").setAttribute("onclick", "checkoutOnClick()");
	}
	function checkoutOnClick() {
		window.location.href="checkout.php?type=shortcut";
	}
	function returnOnClick() {
		document.getElementById("checkout_btn").setAttribute("onclick", "appearOnClick()");
	}
</script>
<!--[if IE]>
  	<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
<![endif]-->
</body>
</html>