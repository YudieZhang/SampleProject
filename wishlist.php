<?php
	session_start();
	
	$con=mysqli_connect("localhost","root","","fashiondb");
	mysqli_query($con, "set names 'gdk'");
	
	if (isset($_SESSION["ID"])){
		$ID = $_SESSION["ID"];
		$_SESSION["ID"] = $ID;
		$first_name = $_SESSION["Firstname"];
		$_SESSION["Firstname"] = $first_name;
		$last_name = $_SESSION["Lastname"];
		$_SESSION["Lastname"] = $last_name;
	}else if (isset($_SESSION["clientID"])){
		$clientID = $_SESSION["clientID"];
		$_SESSION["clientID"] = $clientID;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>WishList</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Wish shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" href="plugins/pagination.css" />
<link rel="stylesheet" type="text/css" href="styles/categories.css">
<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/wishlist.css">
<link rel="stylesheet" type="text/css" href="styles/wishlist_responsive.css">
</head>
<body>

<div class="super_container">
	
	<!-- Header + Menu -->
	
	<?php require_once 'header.php';?>

	<!-- Products -->

	<div class="products">
		<div class="container">
		<div class="logo"><img src="images/heart_2.png" alt="heart"><h1><b>
		<?php
		if (isset($_SESSION["ID"])){
			$sql_name = "SELECT user_name,ID FROM clients WHERE ID='$ID'";
			$result_name = mysqli_query($con,$sql_name);
			while($row_name = mysqli_fetch_array($result_name)) {
				$name = $row_name["user_name"];
			}echo $name.'’s';
		}else{
			echo 'Your';
		}
		echo ' Wishlist</b></h1></div>
			<div class="row products_container">
				<div class="col">
					
					<!-- Products -->
					<div class="product_grid">';
					if (isset($_SESSION["ID"])){
						$sql = "SELECT clientID,productID,productName,imUrl,price FROM wishlist WHERE clientID='$ID'";
						$result = mysqli_query($con,$sql);
						$num = mysqli_num_rows($result);
						if ($num != 0){
							while($row = mysqli_fetch_array($result)) {
								$productID = $row["productID"];
								$product_name = $row["productName"];
								$imUrl = $row["imUrl"];
								$price = $row["price"];
								
								$ratings = 0;
								$rate_num = 0;
								$sql_ratings = "SELECT productID,rate FROM reviews WHERE productID='$productID'";
								$result_ratings = mysqli_query($con,$sql_ratings);
								$num_ratings = mysqli_num_rows($result_ratings);
								if($num_ratings != 0){
									while($row_ratings = mysqli_fetch_array($result_ratings)) {
										$ratings += intval($row_ratings["rate"]);
										$rate_num += 1;
									}
									$ratings = intval($ratings/$rate_num);
								}else{
									$ratings = 5;
								}
								
								echo '<!-- Product -->
							<div class="product">
							<dl class="show" style="width: 100%;">
								<div class="product_image" style="height: 150px;"><img src="'.$imUrl.'" alt="product_image"></div>
								<div class="rating rating_'.$ratings.'" data-rating="'.$ratings.'">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product_content clearfix">
									<div class="product_info" style="height: 120px;">
										<div class="product_name"><a href="product.php?id='.$productID.'" style="font-size: 14px;">'.$product_name.'</a></div>
										<div class="product_price">$'.$price.'</div>
									</div>
									<div class="product_options">
										<div class="product_fav product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">×</a></div>
									</div>
								</div>
							</dl>
							</div>';
						}}else{
							echo '<p>&emsp;&emsp;&emsp;Your wishlist is empty.</p>';
						}
					}else if (isset($_SESSION["clientID"])){
						$sql_temp = "SELECT clientID,productID,productName,imUrl,price FROM wishlist WHERE clientID='$clientID'";
						$result_temp = mysqli_query($con,$sql_temp);
						if ($result_temp!=""){
							while($row_temp = mysqli_fetch_array($result_temp)) {
								$productID = $row_temp["productID"];
								$product_name = $row_temp["productName"];
								$imUrl = $row_temp["imUrl"];
								$price = $row_temp["price"];
								
								$ratings = 0;
								$rate_num = 0;
								$sql_ratings = "SELECT productID,overall FROM reviews WHERE productID='$productID'";
								$result_ratings = mysqli_query($con,$sql_ratings);
								$num_ratings = mysqli_num_rows($result_ratings);
								if($num_ratings != 0){
								while($row_ratings = mysqli_fetch_array($result_ratings)) {
									$ratings += intval($row_ratings["overall"]);
									$rate_num += 1;
								}$ratings = $ratings/$rate_num;
								}else{
									$ratings = 5;
								}
								
								echo '<!-- Product -->
							<div class="product">
							<dl class="show" style="width: 100%;">
								<div class="product_image" style="height: 150px;"><img src="'.$imUrl.'" alt="product_image"></div>
								<div class="rating rating_'.$ratings.'" data-rating="'.$ratings.'">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product_content clearfix">
									<div class="product_info" style="height: 120px;">
										<div class="product_name"><a href="product.php?id='.$productID.'" style="font-size: 14px;">'.$product_name.'</a></div>
										<div class="product_price">$'.$price.'</div>
									</div>
									<div class="product_options">
										<div class="product_fav product_option"><a href="removeCartWL.php?itemID='.$productID.'" class="product_plus">×</a></div>
									</div>
								</div>
							</dl>
							</div>';
						}}else{
							echo '<p>&emsp;&emsp;&emsp;Your wishlist is empty.</p>';
						}
					}else{
						echo '<p>&emsp;&emsp;&emsp;Your wishlist is empty.</p>';
					}
					mysqli_close($con);
					?>
					</div>
				</div>
			</div>

			<br /><br /><br /><br /><br /><br />
			
			<div class="row">
				<div class="col">
					<div class="cart_control_bar d-flex flex-md-row flex-column align-items-start justify-content-start">
						<button class="clear_price_btn"><a href="removeCartWL.php?operation=clearWL" id="clear_btn">clear wishlist</a></button>
					</div>
				</div>
			</div>
			
			<div class="row page_num_container" style="position: relative;">
				<div class="col text-right" style="position: relative;">
					<div id="Pagination" class="pagination"></div>
					<form name="paginationoptions" method="post" action="searchList.php" style="margin-top:30px; position:absolute; right:20px;">
						<p>Show&nbsp;&nbsp;<input type="text" value="20" name="items_per_page" id="items_per_page" class="numeric" style="height:30px;width: 40px;border: solid 0.8px #3a3a3a;text-align: center;" />&nbsp;&nbsp;Items&emsp;<input type="button" id="setoptions" class="clear_price_btn" value="Change" style="height:38px; width:70px;" /></p>
					</form>
				</div>
			</div>

		</div>
		
		<!-- Sidebar Right -->

		<div class="sidebar_right clearfix">

			<!-- Promo 1 -->
			<div class="sidebar_promo_1 sidebar_promo d-flex flex-column align-items-center justify-content-center">
				<div class="sidebar_promo_image" style="background-image: url(images/sidebar_promo_1.jpg)"></div>
				<div class="sidebar_promo_content text-center">
					<div class="sidebar_promo_title">30%<span>off</span></div>
					<div class="sidebar_promo_subtitle">On all shoes</div>
					<div class="sidebar_promo_button"><a href="checkout.html">check out</a></div>
				</div>
			</div>

			<!-- Promo 2 -->
			<div class="sidebar_promo_2 sidebar_promo">
				<div class="sidebar_promo_image" style="background-image: url(images/sidebar_promo_2.jpg)"></div>
				<div class="sidebar_promo_content text-center">
					<div class="sidebar_promo_title">30%<span>off</span></div>
					<div class="sidebar_promo_subtitle">On all shoes</div>
					<div class="sidebar_promo_button"><a href="checkout.html">check out</a></div>
				</div>
			</div>
		</div>

	</div>

	<!-- Extra -->

	

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
					<div class="footer_logo"><a href="#">Wish</a></div>
					<nav class="footer_nav">
						<ul>
							<li><a href="index.html">home</a></li>
							<li><a href="categories.html">clothes</a></li>
							<li><a href="categories.html">accessories</a></li>
							<li><a href="categories.html">lingerie</a></li>
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
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/malihu-custom-scrollbar/jquery.mCustomScrollbar.js"></script>
<script src="plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="js/categories_custom.js"></script>
<script type="text/javascript" src="js/jquery.pagination.js"></script>
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
			var items_per_page = $("#items_per_page").val();
			var max_elem = Math.min((page_index+1) * items_per_page, length);
			
			$("#Searchresult").html("");
			for(var i=page_index*items_per_page;i<max_elem;i++){
				$("#Searchresult").append($("#hiddenresult .show:eq("+i+")").clone());
			}
			return false;
		}
	});
</script>
</body>
</html>