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
	$_SESSION["location"]="product"
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Product</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Wish shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/product.css">
<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/stars.css">
<link rel="stylesheet" type="text/css" href="styles/alsoViewed.css">
<link rel="stylesheet" type="text/css" href="styles/img_style.css">
<link rel="stylesheet" href="styles/jquery.skidder.css">
<link rel="stylesheet" type="text/css" href="styles/preview.css">
<link rel="stylesheet" type="text/css" href="styles/roll.css">
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="styles/demo.css" />
<link rel="stylesheet" type="text/css" href="styles/checkout-rounded.css" />
</head>
<body>

<div class="super_container">
	
	<!-- Header + Menu -->
	
	<?php require_once 'header.php';?>

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/product.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_container">
						<div class="home_content">
							<div class="home_title">Women New</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="index.html">Home</a></li>
									<li>New</li>
									<li>Women New</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Product -->

	<div class="product" id="p_container">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="current_page">
						<ul>
							<li><a href="categories.html">Home</a></li>
							<li><a href="categories.html">New</a></li>
							<li>Women New</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row product_row">

				<!-- Product Image -->
				<div class="col-lg-7">
					<div class="product_image">
					<div class="slideshow">
				<?php
					$img_list = array();
					$productID = $_GET['id'];
					$sql_info = "SELECT productID,productName,price,ori_price,description,p_details FROM products WHERE productID='$productID'";
					$sql_imgs = "SELECT productID,imUrl FROM images WHERE productID='$productID'";
					$result_info = mysqli_query($con,$sql_info);
					$result_imgs = mysqli_query($con,$sql_imgs);
					$row_info = mysqli_fetch_array($result_info);
					while($row_imgs = mysqli_fetch_array($result_imgs)) {
						echo '<div class="slide"><img src='.$row_imgs["imUrl"].'></div>';
						array_push($img_list,$row_imgs["imUrl"]);
					}echo '</div>
					</div>
					</div>
				</div>';
				$i = 0;
				foreach ($img_list as &$image){
					echo '<div><img class="small_img_'.$i.'" src='.$image.'></div>';
					$i += 1;
					if ($i>=5){
						break;
					}
				}

				echo'
				<form action="addCartWL.php?ID='.$productID.'" method="post">
				<!-- Product Content -->
				<div class="col-lg-5" style="position: absolute; float: right; margin: -500px 0px 0px 700px; padding: 30px;">
					<div class="product_content">
						<div class="product_name" style="line-height: 30px;">'.$row_info["productName"].'</div>
						<div class="product_price">AU$'.$row_info["price"].'</div>
						<div class="product_ori_price">AU$'.$row_info["ori_price"].'</div>
						<div id="star_rate" style="padding-top: 10px;"></div>
						<!-- In Stock -->
						<div class="in_stock_container">
							<div class="in_stock in_stock_true"></div>
							<span>in stock</span>
						</div>
						<div class="option_containter">
						<!-- Product Quantity -->
						<div class="product_quantity_container">
							<span>Quantity</span>
							<div class="product_quantity clearfix">
								<input id="quantity_input" name="quantity" type="text" pattern="[0-9]*" value="1">
								<div class="quantity_buttons">
									<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-caret-up" aria-hidden="true"></i></div>
									<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
								</div>
							</div>
						</div>
						<!-- Product Color -->
						<div class="product_size_container">
							<span>Color&emsp;&nbsp;&nbsp;</span>
							<div class="product_size">
								<ul class="d-flex flex-row align-items-start justify-content-start" style="width:0px;">';
								$num_color = 0;
								$num_size = 0;
								$sql_colors = "SELECT * FROM colors WHERE productID='$productID'";
								$sql_sizes = "SELECT * FROM sizes WHERE productID='$productID'";
								$result_colors = mysqli_query($con,$sql_colors);
								$result_sizes = mysqli_query($con,$sql_sizes);
								while($row_colors = mysqli_fetch_array($result_colors)) {
									$value = $row_colors["color_title"];
									if ($num_color == 0){
										$num_color = $num_color + 1;
										if ($row_colors['color_style']!=""){
											echo '<li>
											<input type="radio" id="color_'.$num_color.'" name="color_radio" class="color_radio color_'.$num_color.'" value="'.$value.'" checked>
											<label for="color_'.$num_color.'" width="30" height=30" class="color_radio" style="'.$row_colors["color_style"].'">&nbsp;</label>
										</li>';
										}else if ($row_colors["color_option"]!=""){
											echo '<li>
											<input type="radio" id="color_'.$num_color.'" name="color_radio" class="color_radio color_'.$num_color.'" value="'.$value.'" checked>
											<label for="color_'.$num_color.'" width="30" height=30" class="color_radio" style="background: url('.$row_colors["color_option"].');">&nbsp;</label>
										</li>';
										}}else if($num_color==6){
											$num_color = $num_color + 1;
											if ($row_colors['color_style']!=""){
												$value = $row_colors["color_title"];
												echo '<li style="margin-top:55px;margin-left:-336px;">
												<input type="radio" id="color_'.$num_color.'" name="color_radio" class="color_radio color_'.$num_color.'" value="'.$value.'">
												<label for="color_'.$num_color.'" width="30" height=30" class="color_radio" style="'.$row_colors["color_style"].'">&nbsp;</label>
											</li>';
											}else if ($row_colors["color_option"]!=""){
												echo '<li style="margin-top:55px;margin-left:-336px;">
												<input type="radio" id="color_'.$num_color.'" name="color_radio" class="color_radio color_'.$num_color.'" value="'.$value.'">
												<label for="color_'.$num_color.'" width="30" height=30" class="color_radio" style="background: url('.$row_colors["color_option"].');">&nbsp;</label>
											</li>';
										}}else if($num_color>6){
											$num_color = $num_color + 1;
											if ($row_colors['color_style']!=""){
												$value = $row_colors["color_title"];
												echo '<li style="margin-top:55px;">
												<input type="radio" id="color_'.$num_color.'" name="color_radio" class="color_radio color_'.$num_color.'" value="'.$value.'">
												<label for="color_'.$num_color.'" width="30" height=30" class="color_radio" style="'.$row_colors["color_style"].'">&nbsp;</label>
											</li>';
											}else if ($row_colors["color_option"]!=""){
												echo '<li style="margin-top:55px;">
												<input type="radio" id="color_'.$num_color.'" name="color_radio" class="color_radio color_'.$num_color.'" value="'.$value.'">
												<label for="color_'.$num_color.'" width="30" height=30" class="color_radio" style="background: url('.$row_colors["color_option"].');">&nbsp;</label>
											</li>';
										}}else{
										$num_color = $num_color + 1;
										if ($row_colors['color_style']!=""){
											$value = $row_colors["color_title"];
											echo '<li>
											<input type="radio" id="color_'.$num_color.'" name="color_radio" class="color_radio color_'.$num_color.'" value="'.$value.'">
											<label for="color_'.$num_color.'" width="30" height=30" class="color_radio" style="'.$row_colors["color_style"].'">&nbsp;</label>
										</li>';
										}else if ($row_colors["color_option"]!=""){
											echo '<li>
											<input type="radio" id="color_'.$num_color.'" name="color_radio" class="color_radio color_'.$num_color.'" value="'.$value.'">
											<label for="color_'.$num_color.'" width="30" height=30" class="color_radio" style="background: url('.$row_colors["color_option"].');">&nbsp;</label>
										</li>';
										}}}
								echo '</ul>
							</div>
							</div>
						<!-- Product Size -->
						<div class="product_size_container" style="margin-top: 20px;">
							<span>Size&emsp;&emsp;&nbsp;</span>
							<div class="product_size">
								<ul class="d-flex flex-row align-items-start justify-content-start">';
								while($row_sizes = mysqli_fetch_array($result_sizes)) {
									$size = $row_sizes["size"];
									if ($num_size == 0){
										$num_size = $num_size + 1;
										echo '<li>
											<input type="radio" id="radio_'.$num_size.'" name="product_radio" value="'.$size.'" class="regular_radio radio_'.$num_size.'" checked>
											<label for="radio_'.$num_size.'">'.$size.'</label>
										</li>';
									}else{
										$num_size = $num_size + 1;
										echo '<li>
											<input type="radio" id="radio_'.$num_size.'" name="product_radio" value="'.$size.'" class="regular_radio radio_'.$num_size.'">
											<label for="radio_'.$num_size.'">'.$size.'</label>
										</li>';
									}}
								echo '</ul>
							</div>
							</div>
							<input type="submit" class="button cart_button" value="add to cart"></input>
							</div>
						</form>
							<!-- Product Description -->
							<details>
							<summary onclick="descOnClick()" class="product_desc"><span>PRODUCT DESCRIPTION</span></summary>
							<div class="scroll_main">
							<div class="scroll_wrap">
								<div class="scroll_cont">
									<div class="product_text">
										<p>'.$row_info["description"].'</p>
									</div>
									<div class="product_text">
										<p>'.$row_info["p_details"].'</p>
									</div>
								</div>
								<div class="scroll_bar">
									<div class="scroll_slider"></div>
								</div>
							</div> 
						</div>
					</details>';
					?>
					</div>
				</div>
			</div>
		</div>

			<!-- Reviews -->

			<?php
			$sql_reviews = "SELECT productID,reviewerID,nickname,avatar,rate,reviewText,reviewPics,time FROM reviews WHERE productID='$productID'";
			$result_reviews = mysqli_query($con,$sql_reviews);
			$num_reviews = mysqli_num_rows($result_reviews);
			if ($num_reviews != 0){
			echo '<div class="row" style="background: #FFFFFF; padding-bottom: 60px; margin-top: 100px;">
				<div class="col" style="margin-bottom: 200px;">
					<div class="reviews">
						<div class="slide-content">
							<div class="slide-title" style="text-transform:uppercase; margin-bottom: -60px;">Customers Reviews
							<br/><br/><br/><br/><br/><br/><br/>
							<div style="margin-top: -80px;">
							<div class="review_num" id="total_reviews"></div><div class="new-body-price" id="font_reviews">&emsp;Reviews</div>
							<div id="star_grade"></div>
							</div>
							<div>
							<div class="pics_num">Photos</div>
							<div class="slide-content">
							<div class="slide-item">
								<div class="slide-item-img">
									<div class="imghd">
										<a href="javascript:;" class="imgprev prev-bg"></a>
										<a href="javascript:;" class="imgnext next-bg"></a>
									</div>
									<div class="imgbd slide-item-body">
										<ul class="clearfix" style="overflow:visible;height:0px;">
											<div class="reviewPics"></div>
										</ul>
									</div>
								</div>
							</div>
						</div>
						</div>';}else{
							echo '<div class="row" style="background: #FFFFFF; padding-bottom: 60px; margin-top: 100px;">
				<div class="col" style="margin-bottom: 200px;">
					<div class="reviews">
						<div class="slide-content">
							<div class="slide-title" style="text-transform:uppercase; margin-bottom: -215px;">Customers Reviews
							<br/><br/><br/><br/><br/><br/><br/>';
						}
						echo '</div>
						<div class="reviews_container">
							<ul style="padding-top: 50px;">
								<!-- Review -->';
								if ($num_reviews != 0){
									$sum_rate = 0;
									$sum_num = 0;
									$pics_num = 0;
									$pics = Array();
									while($row_reviews = mysqli_fetch_array($result_reviews)) {
										$sum_rate += $row_reviews["rate"];
										$sum_num += 1;
										if ($row_reviews["reviewPics"] != ""){
											$pics_num += 1;
											array_push($pics,$row_reviews["reviewPics"]);
										}
										$reviewerID = $row_reviews["reviewerID"];
										if ($row_reviews["avatar"] == ''){
											$sql_avatar = "SELECT ID,avatar FROM clients WHERE ID='$reviewerID'";
											$result_avatar = mysqli_query($con,$sql_avatar);
											$avatar_result = mysqli_fetch_array($result_avatar);
											$avatar = $avatar_result["avatar"];
											if ($avatar == ""){
												$avatar = "images/avatar.png";
											}
										}else{
											$avatar = $row_reviews["avatar"];
										}
										echo '<li class=" review clearfix">
											<div class="review_image"><img src="'.$avatar.'" alt="avatar"></div>
											<div class="review_content">
												<div class="review_name"><a href="#">'.$row_reviews["nickname"].'</a></div>
												<div class="review_date">'.$row_reviews["time"].'</div>
												<div class="rating rating_'.$row_reviews["rate"].' review_rating" data-rating="'.$row_reviews["rate"].'">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="review_text">
													<p>'.utf8_decode($row_reviews["reviewText"]).'</p>
												</div>';
												if ($row_reviews["reviewPics"]!=""){
												echo '<img src="'.$row_reviews["reviewPics"].'" alt="Review Pic" height=120 width=95 class="js-lightBox" data-group="group-'.($sum_num+1).'" style="margin-right: 10px; margin-top: 10px; opacity:1; border-radius: 5px;">';
												}
											echo '</div>
										</li>';
									}
									$avg_rate = $sum_rate/$sum_num;
								}else{
									echo '<li class=" review clearfix">
											<div class="review_text">
											<p class="new-body-title" style="text-align:center; margin-top: -20px;" >&emsp;There is no customer review yet.&emsp;</p>
											<p class="new-body-title" style="text-align:center;">&emsp;Be the first one who purchase the item and share your thoughts with other customers.&emsp;</p>
										</div>
										</li>';
									$avg_rate = 5.0;
								}
								?>
							</ul>
						</div>
						</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Leave a Review -->

			<div class="row">
				<div class="col">
					<div class="review_form_container">
						<div class="review_form_title" style="text-shadow:5px 2px 6px #000;">&emsp;<img src="images/pen.png" style="width: 3%; opacity: 0.9;">Write a review</div>
						<div class="review_form_content" style="margin: 20px 0px 0px 20px;">
							<form action="postReviews.php?ID=<?php echo $productID;?>" method="post" id="review_form" class="review_form">
								<div class="rating-stars block" id="another-rating">
									<input type="number" readonly class="form-control rating-value" name="rating_stars_value" id="rating_stars_value" style="display:none;">
									<div class="rating-stars-container">
										<div class="rating-star">
											<i class="fa fa-star"></i>
										</div>
										<div class="rating-star">
											<i class="fa fa-star"></i>
										</div>
										<div class="rating-star">
											<i class="fa fa-star"></i>
										</div>
										<div class="rating-star">
											<i class="fa fa-star"></i>
										</div>
										<div class="rating-star">
											<i class="fa fa-star"></i>
										</div>
									</div>
								</div>
								<textarea class="review_form_text" name="review_form_text" placeholder="Message"></textarea>
								<input type="submit" class="review_form_button" value="leave a review"></input>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<!-- Recommendations -->
			
			<div class="slide-content">
				<div class="slide-title" style="text-transform:uppercase;">Customers Also Viewed</div>
				<div class="slide-item">
					<div class="slide-item-box">
						<div class="hd">
							<a href="javascript:;" class="prev prev-bg"></a>
							<a href="javascript:;" class="next next-bg"></a>
						</div>
						<div class="bd slide-item-body">
							<ul class="clearfix" style="overflow:visible;">
							<?php if ($_GET['id'] == "CuHxQMgmCcEmAPrwmpEn"){
								$ids = array("yYeW5Zm5sZmJBohZ1DCe","GydD0HCQaJEMIkeCUsfA","KvIzrUUDQwiM4zAge60g","02Z3WLEOIoMmucE62Ndj","LqUoyFj5uJhLR85LxZhr","uUuan5oaSxZHxWfqICJa","RmEeB4e0xSV9yGtX1gHK");
								foreach ($ids as $recommendationID){
									$sql_alsoViewed = "SELECT productID,productName,price,ori_price,img_first,img_after FROM products WHERE productID='".$recommendationID."'";
									$result_alsoViewed = mysqli_query($con,$sql_alsoViewed);
									while($row_alsoViewed = mysqli_fetch_array($result_alsoViewed)) {
										echo '<li>
										<a href="#">
											<div class="new-img">
												<img src="'.$row_alsoViewed["img_first"].'" alt="productImg" class="img_first">';
												if ($row_alsoViewed["img_after"] != ""){
													echo '<img src="'.$row_alsoViewed["img_after"].'" alt="productImg" class="img_after">';
												}else{
													echo '<img src="'.$row_alsoViewed["img_first"].'" alt="productImg" class="img_after">';
												}
										echo '</div>
											<div class="new-body">
												<p class="new-body-title">'.$row_alsoViewed["productName"].'</p>
												<p class="new-body-price" style="font-weight: 800;">$AU'.$row_alsoViewed["price"].'</p><p class="new-body-text">$AU'.$row_alsoViewed["ori_price"].'</p>
											</div>
										</a>
									</li>';
							}}}else if ($_GET['id'] == "ylHDgoDIbgaYwxz9eLAz"){
								$ids = array("Xsr1wLK8Qf7Jh0LpnuPz","tfiVoOJsNdGED25rp7uh","uUuan5oaSxZHxWfqICJa","N73B4p0pfLXZW7DWGwBm","IwF3eKFFoLPoThULdPOK","ZpzaxoDPemVoaCEK9aCA","VMMIvvSa3kzRwtkIhxXb");
								foreach ($ids as $recommendationID){
									$sql_alsoViewed = "SELECT productID,productName,price,ori_price,img_first,img_after FROM products WHERE productID='".$recommendationID."'";
									$result_alsoViewed = mysqli_query($con,$sql_alsoViewed);
									while($row_alsoViewed = mysqli_fetch_array($result_alsoViewed)) {
										echo '<li>
										<a href="#">
											<div class="new-img">
												<img src="'.$row_alsoViewed["img_first"].'" alt="productImg" class="img_first">';
												if ($row_alsoViewed["img_after"] != ""){
													echo '<img src="'.$row_alsoViewed["img_after"].'" alt="productImg" class="img_after">';
												}else{
													echo '<img src="'.$row_alsoViewed["img_first"].'" alt="productImg" class="img_after">';
												}
										echo '</div>
											<div class="new-body">
												<p class="new-body-title">'.$row_alsoViewed["productName"].'</p>
												<p class="new-body-price" style="font-weight: 800;">$AU'.$row_alsoViewed["price"].'</p><p class="new-body-text">$AU'.$row_alsoViewed["ori_price"].'</p>
											</div>
										</a>
									</li>';
							}}}else if ($_GET['id'] == "IwF3eKFFoLPoThULdPOK"){
								$ids = array("VMMIvvSa3kzRwtkIhxXb","ZpzaxoDPemVoaCEK9aCA","N73B4p0pfLXZW7DWGwBm","tfiVoOJsNdGED25rp7uh","uUuan5oaSxZHxWfqICJa","ylHDgoDIbgaYwxz9eLAz","Xsr1wLK8Qf7Jh0LpnuPz");
								foreach ($ids as $recommendationID){
									$sql_alsoViewed = "SELECT productID,productName,price,ori_price,img_first,img_after FROM products WHERE productID='".$recommendationID."'";
									$result_alsoViewed = mysqli_query($con,$sql_alsoViewed);
									while($row_alsoViewed = mysqli_fetch_array($result_alsoViewed)) {
										echo '<li>
										<a href="#">
											<div class="new-img">
												<img src="'.$row_alsoViewed["img_first"].'" alt="productImg" class="img_first">';
												if ($row_alsoViewed["img_after"] != ""){
													echo '<img src="'.$row_alsoViewed["img_after"].'" alt="productImg" class="img_after">';
												}else{
													echo '<img src="'.$row_alsoViewed["img_first"].'" alt="productImg" class="img_after">';
												}
										echo '</div>
											<div class="new-body">
												<p class="new-body-title">'.$row_alsoViewed["productName"].'</p>
												<p class="new-body-price" style="font-weight: 800;">$AU'.$row_alsoViewed["price"].'</p><p class="new-body-text">$AU'.$row_alsoViewed["ori_price"].'</p>
											</div>
										</a>
									</li>';
							}}}else{
							$sql_result = "SELECT * FROM recommendations WHERE productID='".$_GET['id']."'";
								$result_ids = mysqli_query($con,$sql_result);
								while($row_ids = mysqli_fetch_array($result_ids)){
									if ($row_ids['similarity']!="1"){
									$sql_alsoViewed = "SELECT productID,productName,price,ori_price,img_first,img_after FROM products WHERE productID='".$row_ids['recommendationID']."'";
									$result_alsoViewed = mysqli_query($con,$sql_alsoViewed);
									while($row_alsoViewed = mysqli_fetch_array($result_alsoViewed)) {
										echo '<li>
										<a href="#">
											<div class="new-img">
												<img src="'.$row_alsoViewed["img_first"].'" alt="productImg" class="img_first">';
												if ($row_alsoViewed["img_after"] != ""){
													echo '<img src="'.$row_alsoViewed["img_after"].'" alt="productImg" class="img_after">';
												}else{
													echo '<img src="'.$row_alsoViewed["img_first"].'" alt="productImg" class="img_after">';
												}
										echo '</div>
											<div class="new-body">
												<p class="new-body-title">'.$row_alsoViewed["productName"].'</p>
												<p class="new-body-price" style="font-weight: 800;">$AU'.$row_alsoViewed["price"].'</p><p class="new-body-text">$AU'.$row_alsoViewed["ori_price"].'</p>
											</div>
										</a>
									</li>';
							}}}}
							?>
							</ul>
						</div>
					</div>
				</div>
			</div>

	<!-- Newsletter -->

	<div class="newsletter">
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
						<div class="newsletter_text">New looks for autumn mood. Don't miss out our exclusive coupons.</div>
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

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/product_custom.js"></script>
<script type="text/javascript" src="js/jquery.rating-stars.min.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide.2.1.3.js"></script>
<script type="text/javascript" src="js/markingSystem.js"></script>
<script type="text/javascript" src="js/imagesloaded.js"></script>
<script type="text/javascript" src="js/smartresize.js"></script>
<script type="text/javascript" src="js/jquery.skidder.js"></script>
<script type="text/javascript" src='js/lightBox.js'></script>
<script type="text/javascript" src="js/scrollbar.js"></script>
<script src="js/classie.js"></script>
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
$(document).ready(function (){	
	$("#total_reviews").html("<?php echo $sum_num;?>");
	$(".pics_num").html("Photos(<?php echo $pics_num;?>)");
	$(".reviewPics").html("<?php foreach($pics as $pic){echo "<img src='".$pic."' height=150 width=117 class='js-lightBox' data-group='group-1' alt='Review Pic'>";} ?>");
});
</script>
<script type="text/javascript">
    var ratingOptions = {
        selectors: {
            starsSelector: '.rating-stars',
            starSelector: '.rating-star',
            starActiveClass: 'is--active',
            starHoverClass: 'is--hover',
            starNoHoverClass: 'is--no-hover',
            targetFormElementSelector: '.rating-value'
        }
    };

    $(".rating-stars").ratingStars(ratingOptions);
</script>
<script type="text/javascript">
new CusScrollBar({
  contentSelector: '.scroll_cont',
  barSelector: '.scroll_bar',
  sliderSelector: '.scroll_slider'
});
</script>
<script type="text/javascript">
	jQuery(".slide-item-box").slide({
		titCell: ".hd ul",
		mainCell: ".bd ul",
		autoPage: true,
		pnLoop: true,
		effect: "left",
		autoPlay: true,
		mouseOverStop: true,
		scroll: 1,
		vis: 4,
		delayTime: 700,
		trigger: "click"
	});
	jQuery(".slide-item-img").slide({
		titCell: ".imghd ul",
		mainCell: ".imgbd ul",
		autoPage: true,
		pnLoop: true,
		effect: "left",
		autoPlay: true,
		mouseOverStop: true,
		scroll: 6,
		vis: 6,
		delayTime: 700,
		trigger: "click"
	});
</script>
<script type="text/javascript">
$("#star_rate").markingSystem({
	num: 5,
	havePoint: true,
	haveGrade: true,
	modify: false,
	grade: <?php echo $avg_rate;?>,
	height: 20,
	width: 20,
});
$("#star_grade").markingSystem({
	num: 5,
	havePoint: true,
	haveGrade: true,
	modify: false,
	grade: <?php echo $avg_rate;?>,
	height: 30,
	width: 30,
});
$("#star_review").markingSystem({
	num: 5,
	havePoint: false,
	haveGrade: false,
	modify: true,
	height: 30,
	width: 30,
});
</script>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $.LightBox({speed:500})
});
</script>
<script type="text/javascript">
$('.slideshow').each( function() {
	  var $slideshow = $(this);
	  $slideshow.imagesLoaded( function() {
		$slideshow.skidder({
		  slideClass    : '.slide',
		  animationType : 'css',
		  scaleSlides   : true,
		  maxWidth : 1300,
		  maxHeight: 500,
		  paging        : true,
		  autoPaging    : true,
		  pagingWrapper : ".skidder-pager",
		  pagingElement : ".skidder-pager-dot",
		  swiping       : true,
		  leftaligned   : false,
		  cycle         : true,
		  jumpback      : false,
		  speed         : 400,
		  autoplay      : false,
		  autoplayResume: false,
		  interval      : 4000,
		  transition    : "slide",
		  afterSliding  : function() {},
		  afterInit     : function() {}
		});
	  });
});

$(window).smartresize(function(){
	  $('.slideshow').skidder('resize');
});
</script>
<script type="text/javascript">
var clickNumber =0;
function descOnClick() {
	if(clickNumber %2==0){
		document.getElementById("p_container").setAttribute("style", "padding-bottom: 600px;");
	}else{
		document.getElementById("p_container").setAttribute("style", "padding-bottom: 200px;");
	}
	clickNumber ++;
}
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
</body>
</html>