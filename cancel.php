<!DOCTYPE html>
<html lang="en">
<head>
<title>Payment Cancelled</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Wish shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
</head>
<body>

<div class="super_container">
	
	<!-- Header -->

	<header class="header">
		<div class="header_inner d-flex flex-row align-items-center justify-content-start">
			<div class="logo"><a href="#">FashionCloset</a></div>
			<nav class="main_nav">
				<ul>
					<div class="dropdown">
						<span><li><a href="index.html">Home</a></li></span>
					</div>
					<div class="dropdown">
						<span><li><a href="categories.html">Clothes</a></li></span>
						<div class="dropdown-content">
							<div class="dropdown-left">
							<ul>
								<li class="dropdown-title">Categories</li>
								<div class="option_1">
									<li><a href="#">Dresses</a></li>
									<div class="dropdown-option_1">
										<li><a href="#">Casual Dresses</a></li>
										<li><a href="#">Work Dresses</a></li>
									</div>
								</div>
								<div class="option_2">
									<li><a href="#">Tops</a></li>
									<div class="dropdown-option_2">
										<li><a href="#">Long Sleeve</a></li>
										<li><a href="#">Short Sleeve</a></li>
										<li><a href="#">T-Shirts</a></li>
									</div>
								</div>
								<div class="option_3">
									<li><a href="#">Bottoms</a></li>
									<div class="dropdown-option_3">
										<li><a href="#">Skirts</a></li>
										<li><a href="#">Shorts</a></li>
										<li><a href="#">Pants & Leggings</a></li>
										<li><a href="#">Jeans</a></li>
									</div>
								</div>
								<div class="option_4">
									<li><a href="#">Ourterwear</a></li>
									<div class="dropdown-option_4">
										<li><a href="#">Jackets</a></li>
										<li><a href="#">Coats</a></li>
									</div>
								</div>
							</ul>
							</div>
							<div class="dropdown-right">
							<img src="images/extra_1.jpg" alt="clothes">
							</div>
						</div>
					</div>
					<div class="dropdown">
						<span><li><a href="categories.html">Accessories</a></li></span>
						<div class="dropdown-content">
						<div class="dropdown-left">
							<ul>
								<li class="dropdown-title">Categories</li>
								<li><a href="#">Jewellery</a></li>
								<li><a href="#">Hair and Hats</a></li>
								<li><a href="#">Sunglasses</a></li>
								<li><a href="#">Scarves</a></li>
								<li><a href="#">Bags</a></li>
								<li><a href="#">Socks and Gloves</a></li>
							</ul>
						</div>
						<div class="dropdown-right">
							<img src="images/extra_2.jpg" alt="accessories">
						</div>
						</div>
					</div>
					<div class="dropdown">
						<span><li><a href="categories.html">Shoes</a></li></span>
						<div class="dropdown-content">
						<div class="dropdown-left">
							<ul>
								<li class="dropdown-title">Categories</li>
								<li><a href="#">Heels</a></li>
								<li><a href="#">Boots</a></li>
								<li><a href="#">Sandals</a></li>
								<li><a href="#">Slides</a></li>
								<li><a href="#">Sneakers</a></li>
								<li><a href="#">Flats</a></li>
								<li><a href="#">Work Shoes</a></li>
							</ul>
						</div>
						<div class="dropdown-right">
							<img src="images/promo_3.jpg" alt="shoes">
						</div>
						</div>
					</div>
					<div class="dropdown">
						<span><li><a href="categories.html">Contact</a></li></span>
					</div>
				</ul>
			</nav>
			<div class="header_content ml-auto">
				<div class="search header_search">
					<form action="#">
						<input type="search" class="search_input" required="required">
						<button type="submit" id="search_button" class="search_button"><img src="images/magnifying-glass.svg" alt=""></button>
					</form>
				</div>
				<div class="shopping">
					<!-- Cart -->
					<a href="#">
						<div class="cart">
							<img src="images/shopping-bag.svg" alt="">
							<div class="cart_num_container">
								<div class="cart_num_inner">
									<div class="cart_num">1</div>
								</div>
							</div>
						</div>
					</a>
					<!-- Star -->
					<a href="#">
						<div class="star">
							<img src="images/star.svg" alt="">
							<div class="star_num_container">
								<div class="star_num_inner">
									<div class="star_num">0</div>
								</div>
							</div>
						</div>
					</a>
					<!-- Avatar -->
					<a href="#">
						<div class="avatar">
							<img src="images/avatar.svg" alt="">
						</div>
					</a>
				</div>
			</div>

			<div class="burger_container d-flex flex-column align-items-center justify-content-around menu_mm"><div></div><div></div><div></div></div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="logo menu_mm"><a href="#">FashionCloset</a></div>
		<div class="search">
			<form action="#">
				<input type="search" class="search_input menu_mm" required="required">
				<button type="submit" id="search_button" class="search_button menu_mm"><img class="menu_mm" src="images/magnifying-glass.svg" alt=""></button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="index.html">Home</a></li>
				<li class="menu_mm"><a href="#">Clothes</a></li>
				<li class="menu_mm"><a href="#">Accessories</a></li>
				<li class="menu_mm"><a href="#">Shoes</a></li>
				<li class="menu_mm"><a href="#">Contact</a></li>
			</ul>
		</nav>
	</div>
	
	<div class="contact">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="review_form_container">
						<img src="images/failed_icon.png" style="margin: -40% 0 -40% -36%; width: 130%;"><div class="review_form_title" style="margin-top: -26%; margin-left: 30%; font-size: -webkit-xxx-large;">Payment Cancelled.</div>
						<div class="review_form_title" style="font-size: 20px; margin-top: 20px; margin-left: 29%; text-transform: unset;">If there are technical problems, please contact us.</div>
						<div id="redirect" class="review_form_title" style="font-size: 20px; margin-top: 20px; margin-left: 29%; text-transform: unset;">Returning to homepage in <b style="color:#f45342;">3</b></div>
						<script language="JavaScript" type="text/javascript">
							function setTime2(){
								document.getElementById("redirect").innerHTML = "Returning to homepage in <b style='color:#f45342;'>2</b>";
							}
							function setTime1(){
								document.getElementById("redirect").innerHTML = "Returning to homepage in <b style='color:#f45342;'>1</b>";
							}
							function setTime0(){
								window.location.href='index.php';
							}
							window.setTimeout(setTime2,1000);
							window.setTimeout(setTime1,2000);
							window.setTimeout(setTime0,3000);
						</script>
						<br/><br/><br/><br/><br/><br/><br/>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="newsletter_content">
			<div class="newsletter_image" style="background-image:url(images/newsletter.jpg)"></div>
			<div class="container">
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
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="js/contact_custom.js"></script>
</body>
</html>