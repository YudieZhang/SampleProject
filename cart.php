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
	$_SESSION["location"]="cart";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Cart</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Wish shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link media="screen" rel="stylesheet" href="styles/menu.css"/>
<link rel="stylesheet" type="text/css" href="styles/chechout.css">
<link rel="stylesheet" type="text/css" href="styles/chechout_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/cart.css">
<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
</head>
<body>


<div class="super_container">
	
	<!-- Header -->
	<header class="header">
		<div class="header_inner d-flex flex-row align-items-center justify-content-start">
			<div class="logo"><a href="index.php">FashionCloset</a></div>
			<nav class="main_nav">
			<ul>
			<div class="navigation-up">
				<div class="navigation-inner">
					<div class="navigation-v3">
						<ul style="width:650px;margin-left:29px;">
							<div class="dropdown" _t_nav="new">
								<span><li><a href="searchList.php?catg=NEW" style="margin-right:-5px;">New</a></li></span>
							</div>
							<div class="dropdown" _t_nav="sale">
								<span><li><a href="searchList.php?catg=SALE" style="margin-right:-5px;">Sale</a></li></span>
							</div>
							<div class="dropdown" _t_nav="women">
								<span><li><a href="searchList.php?catg=Women" style="margin-right:-5px;">Women</a></li></span>
							</div>
							<div class="dropdown" _t_nav="men">
								<span><li><a href="searchList.php?catg=Men" style="margin-right:-5px;">Men</a></li></span>
							</div>
							<div class="dropdown" _t_nav="activewear">
								<span><li><a href="searchList.php?catg=Activewear" style="margin-right:-5px;">Activewear</a></li></span>
							</div>
							<div class="dropdown" _t_nav="accessories">
								<span><li><a href="searchList.php?catg=Accessories" style="margin-right:-5px;">Accessories</a></li></span>
							</div>
							<div class="dropdown" _t_nav="contact">
								<span><li><a href="contact.php">Contact</a></li></span>
							</div>
						</ul>
					</div>
				</div>
			</div>
			<div class="navigation-down" style="width:1400px;">
				<div id="new" class="nav-down-menu menu-1" style="display: none;" _t_nav="new">
					<div class="navigation-down-inner">
						<dl style="margin-left: 25px;">
							<dt>Women New</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Tops%20New">Tops New</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute2" href="searchList.php?catg=Dresses%20New">Dresses New</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Bottoms%20New">Bottoms New</a>
							</dd>
							<br/>
							<dt>Swimwear New</dt>
							<dd>
								<a hotrep="hp.header.product.storage1" href="searchList.php?catg=Bikinis%20New">Bikinis New</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.storage2" href="searchList.php?catg=One-pieces%20New%20Arrivals">One-pieces New Arrivals</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.storage4" href="searchList.php?catg=Cover%20Ups%20New%20Arrivals">Cover Ups New Arrivals</a>
							</dd>
							<br/>
							<dt>Men New</dt>
							<dt>Activewear New</dt>
							<dt>Accessories New</dt>
						</dl>
						<dl>
							<dt>Shop By</dt>
							<dd>
								<a hotrep="hp.header.product.monitoring1" href="searchList.php?catg=Teddy%20Coats">Teddy Coats</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring2" href="searchList.php?catg=Fluffy%20Hoddies">Fluffy Hoddies</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Denim%20Jacket">Denim Jacket</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=V%20Neck%20Sweaters">V Neck Sweaters</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=New%20Smocked%20Bikinis">New Smocked Bikinis</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Top%20Rated">Top Rated</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Premium%20Collection">Premium Collection</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Top%20Recommendations">Top Recommendations</a>
							</dd>
						</dl>
						<dl>
							<dt>Trending</dt>
							<dd>
								<a hotrep="hp.header.product.analysis1" href="searchList.php?catg=Animal%20Print">Animal Print</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Leopard%20Blouse">Leopard Blouse</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Teddy%20Collection">Teddy Collection</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Neon%20Collection">Neon Collection</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Camo%20Series">Camo Series</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Long%20Sleeve%20Tops">Long Sleeve Tops</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Fluffy%20Coats">Fluffy Coats</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Plaid%20Pants">Plaid Pants</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Bikini%20Set">Bikini Set</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Just%20Arrived:%20Up%20to%2050%%20Off">Just Arrived: Up to 50% Off</a>
							</dd>
						</dl>
						<dl style="margin-left: -20px;">
							<dd>
								<img src="images/new.jpg" style="width:500px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
					</div>
				</div>
				<div id="sale" class="nav-down-menu menu-1" style="display: none;" _t_nav="sale">
					<div class="navigation-down-inner">
						<dl style="margin-left: 30px;">
							<dt>Women</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Tops%20Sale">Tops Sale</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute2" href="searchList.php?catg=Dresses%20Sale">Dresses Sale</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Bottoms%20Sale">Bottoms Sale</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Plus%20Size%20Sale">Plus Size Sale</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Intimates%20Sale">Intimates Sale</a>
							</dd>
							<br/>
							<dt>Swimwear</dt>
							<dd>
								<a hotrep="hp.header.product.storage1" href="searchList.php?catg=Bikinis%20Sale">Bikinis Sale</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.storage2" href="searchList.php?catg=One-pieces%20Sale">One-pieces Sale</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.storage4" href="searchList.php?catg=Cover%20Ups%20Sale">Cover Ups Sale</a>
							</dd>
						</dl>
						<dl style="margin-left: 40px;">
							<dt>Men</dt>
							<dd>
								<a hotrep="hp.header.product.monitoring1" href="searchList.php?catg=Tops%20Sale">Tops Sale</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring2" href="searchList.php?catg=Bottoms%20Sale">Bottoms Sale</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Underwear%20Sale">Underwear Sale</a>
							</dd>
							<br/>
							<dt>Activewear</dt>
							<dd>
								<a hotrep="hp.header.product.monitoring1" href="searchList.php?catg=Tops%20Sale">Tops Sale</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring2" href="searchList.php?catg=Bottoms%20Sale">Bottoms Sale</a>
							</dd>
							<br/>
							<dt>Accessories</dt>
							<dd>
								<a hotrep="hp.header.product.monitoring1" href="searchList.php?catg=Jewelery%20Sale">Jewelery Sale</a>
							</dd>
						</dl>
						<dl style="margin-left: 40px;">
							<dt>All Deals</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Sale%20Under%20AU$3.99">Sale Under AU$3.99</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Sale%20Under%20AU$14.99">Sale Under AU$14.99</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Sale%20Under%20AU$21.99">Sale Under AU$21.99</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Sale%20Under%20AU$24.99">Sale Under AU$24.99</a>
							</dd>
							<br/>
							<dt>The Last Call Sale</dt>
						</dl>
						<dl style="margin-left: -10px;">
							<dd>
								<img src="images/sale.jpg" style="width:500px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
					</div>
				</div>
				<div id="women" class="nav-down-menu menu-1" style="display: none;" _t_nav="women">
					<div class="navigation-down-inner">
						<dl style="margin-left: 20px;">
							<dt>Tops</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Jackets%20&%20Coats">Jackets & Coats</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute2" href="searchList.php?catg=Sweaters">Sweaters</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Sweatshirts">Sweatshirts</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Blouse">Blouse</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Two-pieces%20Outfits">Two-pieces Outfits</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Tank%20Tops">Tank Tops</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Tees">Tees</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Bodysuit">Bodysuit</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Blazers">Blazers</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Waistcoat">Waistcoat</a>
							</dd>
						</dl>
						<dl style="margin-left: 30px;">
							<dt>Dresses</dt>
							<dd>
								<a hotrep="hp.header.product.monitoring1" href="searchList.php?catg=Sweaters%20Dresses">Sweaters Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring2" href="searchList.php?catg=Long%20Sleeve%20Dresses">Long Sleeve Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Casual%20Dresses">Casual Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Midi%20Dresses">Midi Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Mini%20Dresses">Mini Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Maxi%20Dresses">Maxi Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Bodycon%20Dresses">Bodycon Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Print%20Dresses">Print Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Summer%20Dresses">Summer Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Bohemian%20Dresses">Bohemian Dresses</a>
							</dd>
						</dl>
						<dl style="margin-left: 30px;">
							<dt>Bottoms</dt>
							<dd>
								<a hotrep="hp.header.product.analysis1" href="searchList.php?catg=Jumpsuits%20&%20Rompers">Jumpsuits & Rompers</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Pants">Pants</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Jeans">Jeans</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Leggings">Leggings</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Skirts">Skirts</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.analysis2" href="searchList.php?catg=Shorts">Shorts</a>
							</dd>
							<br/>
							<dt>Intimates</dt>
							<dd>
								<a hotrep="hp.header.product.analysis1" href="searchList.php?catg=Lingerie">Lingerie</a>
							</dd>
							<br/>
							<dt>Plus Size</dt>
						</dl>
						<dl>
							<dd>
								<img src="images/women_1.jpg" style="width:250px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
						<dl>
							<dd>
								<img src="images/women_2.jpg" style="width:250px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
					</div>
				</div>
				<div id="men" class="nav-down-menu menu-1" style="display: none;" _t_nav="men">
					<div class="navigation-down-inner">
						<dl style="margin-left: 25px;">
							<dt>Tops</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Hoddies%20&%20Sweatshirts">Hoddies & Sweatshirts</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute2" href="searchList.php?catg=Sweaters%20&%20Cardigans">Sweaters & Cardigans</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Jackets%20&%20Coats">Jackets & Coats</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Tees%20&%20Tanks">Tees & Tanks</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Shirts">Shirts</a>
							</dd>
							<br/>
							<dt>Bottoms</dt>
							<dd>
								<a hotrep="hp.header.product.storage1" href="searchList.php?catg=Pants">Pants</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.storage2" href="searchList.php?catg=Jeans">Jeans</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.storage4" href="searchList.php?catg=Shorts">Shorts</a>
							</dd>
							<br/>
							<dt>Swimwear</dt>
							<dt>Underwear</dt>
							<dt>Accessories</dt>
						</dl>
						<dl>
							<dt>Trending</dt>
							<dd>
								<a hotrep="hp.header.product.monitoring1" href="searchList.php?catg=Solid%20Color%20Tops">Solid Color Tops</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring2" href="searchList.php?catg=Army%20Green%20Jackets">Army Green Jackets</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Color%20Block%20Tops">Color Block Tops</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Graphic%20Sweatshirts">Graphic Sweatshirts</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Denim%20Jackets">Denim Jackets</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Casual%20Hoddies">Casual Hoddies</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Jogger%20Pants">Jogger Pants</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Fluffy">Fluffy</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Ripped%20Jeans">Ripped Jeans</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Chinese%20Character%20Print">Chinese Character Print</a>
							</dd>
						</dl>
						<dl>
							<dd>
								<img src="images/men_1.png" style="width:300px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
						<dl>
							<dd>
								<img src="images/men_2.jpg" style="width:200px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
						<dl>
							<dd>
								<img src="images/men_3.jpg" style="width:200px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
					</div>
				</div>
				<div id="activewear" class="nav-down-menu menu-1" style="display: none;" _t_nav="activewear">
					<div class="navigation-down-inner">
						<dl style="margin-left: 5px;">
							<dt>Activewear Tops</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Hoddies%20&%20Jackets">Hoddies & Jackets</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Sports%20Bras">Sports Bras</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Tees%20&%20Tanks">Tees & Tanks</a>
							</dd>
							<br/>
							<dt>Activewear Bottoms</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Pants">Pants</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Leggings">Leggings</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Gym%20Sets">Gym Sets</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Shorts">Shorts</a>
							</dd>
							<br/>
							<dt>Activewear Accessories</dt>
						</dl>
						<dl style="margin-left: -60px;">
							<dt>Activewear Trending</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Gym%20Jogger%20Pants">Gym Jogger Pants</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Teddy%20Hoddies">Teddy Hoddies</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Crop%20Hoddies">Crop Hoddies</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Striped%20Bottoms">Striped Bottoms</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Color%20Block%20Sports">Color Block Sports</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Drop%20Shoulder%20Sweatshirts">Drop Shoulder Sweatshirts</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Padded%20Sports%20Bras">Padded Sports Bras</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Gym%20Yoga">Gym Yoga</a>
							</dd>
						</dl>
						<dl style="margin-left: -30px;">
							<dt>Bikinis</dt>
							<br/>
							<dt>One-pieces Swimwear</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Padded%20One-pieces">Padded One-pieces</a>
							</dd>
							<br/>
							<dt>Cover Ups Swimwear</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Beach%20Dresses">Beach Dresses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute2" href="searchList.php?catg=Beach%20Tops">Beach Tops</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Beach%20Bottoms">Beach Bottoms</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Beach%20Accessories">Beach Accessories</a>
							</dd>
							<br/>
							<dt>Kids Swimwear</dt>
						</dl>
						<dl style="margin-left: -30px;">
							<dt>Swimwear Trending</dt>
							<dd>
								<a hotrep="hp.header.product.monitoring1" href="searchList.php?catg=High%20Cut%20Bikinis">High Cut Bikinis</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring2" href="searchList.php?catg=Bandeau%20Bikinis">Bandeau Bikinis</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Thong%20Bikinis">Thong Bikinis</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Smocked%20Bikinis">Smocked Bikinis</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Underwire%20Bikinis">Underwire Bikinis</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Printed%20Bikinis">Printed Bikinis</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Tie%20Dye%20Bikinis">Tie Dye Bikinis</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=high%20Waisted%20Swimwear">high Waisted Swimwear</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=New%20Bikinis%20Trend">New Bikinis Trend</a>
							</dd>
						</dl>
						<dl style="margin-left: -30px;">
							<dd>
								<img src="images/activewear.jpg" style="width:300px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
						<dl>
					</div>
				</div>
				<div id="accessories" class="nav-down-menu menu-1" style="display: none;" _t_nav="accessories">
					<div class="navigation-down-inner">
						<dl style="margin-left: 22px;">
							<dt>Jewelery</dt>
							<dd>
								<a hotrep="hp.header.product.compute1" href="searchList.php?catg=Earrings">Earrings</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute2" href="searchList.php?catg=Necklaces">Necklaces</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute3" href="searchList.php?catg=Body%20Jewelery">Body Jewelery</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute2" href="searchList.php?catg=Rings">Rings</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute2" href="searchList.php?catg=Bracelets">Bracelets</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.compute2" href="searchList.php?catg=Brooches%20&%20pins">Brooches & pins</a>
							</dd>
							<br/>
							<dt>Sunglasses</dt>
							<br/>
							<dt>Bags</dt>
							<dd>
								<a hotrep="hp.header.product.storage1" href="searchList.php?catg=Shoulder%20Bags">Shoulder Bags</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.storage2" href="searchList.php?catg=Crossbody%20Bags">Crossbody Bags</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.storage4" href="searchList.php?catg=Backpacks">Backpacks</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.storage4" href="searchList.php?catg=Clutches">Clutches</a>
							</dd>
						</dl>
						<dl style="margin-left: -20px;">
							<dt>Shoes</dt>
							<dd>
								<a hotrep="hp.header.product.monitoring1" href="searchList.php?catg=Sandals">Sandals</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring2" href="searchList.php?catg=Sneakers">Sneakers</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Boots">Boots</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Flats">Flats</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Pumps">Pumps</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Wedges">Wedges</a>
							</dd>
						</dl>
						<dl style="margin-left: -10px;">
							<dt style="margin-bottom: 0px; padding-bottom: 0px;">Beauty</dt>
							<br/>
							<dt style="margin-bottom: 0px; padding-bottom: 0px;">Hats</dt>
							<br/>
							<dt style="margin-bottom: 0px; padding-bottom: 0px;">Scarves & Gloves</dt>
							<br/>
							<dt style="margin-bottom: 0px; padding-bottom: 0px;">Socks & Tights</dt>
							<br/>
							<dt style="margin-bottom: 0px; padding-bottom: 0px;">Belts</dt>
							<br/>
							<dt style="margin-bottom: 0px; padding-bottom: 0px;">Hair Accessories</dt>
							<br/>
							<dt style="margin-bottom: 0px; padding-bottom: 0px;">Tech Accessories</dt>
							<br/>
							<dt style="margin-bottom: 0px; padding-bottom: 0px;">Home</dt>
						</dl>
						<dl style="margin-left: -20px;">
							<dt>Trending</dt>
							<dd>
								<a hotrep="hp.header.product.monitoring1" href="searchList.php?catg=Winter%20Scarves">Winter Scarves</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring2" href="searchList.php?catg=Beanie%20Hats">Beanie Hats</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Choker%20Necklace">Choker Necklace</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Black%20Sunglasses">Black Sunglasses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Body%20Chain">Body Chain</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Cat%20Eye%20Sunglasses">Cat Eye Sunglasses</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Tote%20Bags">Tote Bags</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Stud%20Earrings">Stud Earrings</a>
							</dd>
							<dd>
								<a hotrep="hp.header.product.monitoring3" href="searchList.php?catg=Makeup%20Brushes">Makeup Brushes</a>
							</dd>
						</dl>
						<dl style="margin-left: -15px;">
							<dd>
								<img src="images/accessories_1.jpg" style="width:250px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
						<dl>
							<dd>
								<img src="images/accessories_2.jpg" style="width:250px; float:right; margin-right:-60px;" Dalt="clothes">
							</dd>
						</dl>
					</div>
				</div>
			</div>
			</ul>
			</nav>
			<?php echo '
			<div class="header_content ml-auto">
				<div class="search header_search">
					<form action="#">
						<input type="search" class="search_input" required="required">
						<button type="submit" id="search_button" class="search_button"><img src="images/magnifying-glass.svg" alt=""></button>
					</form>
				</div>
				<div class="shopping">
					<!-- Cart -->
					<a href="cart.php">
						<div class="cart">
							<img src="images/shopping-bag.svg" alt="">
							<div class="cart_num_container">
								<div class="cart_num_inner">
									<div class="cart_num">';
									if (isset($_SESSION["ID"])){
										$quantity_cart = 0;
										$quantity_wish = 0;
										
										$sql_cart = "SELECT `clientID`,`quantity` FROM cart WHERE clientID = '".$_SESSION['ID']."'";
										$sql_wish = "SELECT `clientID`,`productID` FROM wishlist WHERE clientID = '".$_SESSION['ID']."'";
										$result_cart = mysqli_query($con,$sql_cart);
										$result_wish = mysqli_query($con,$sql_wish);
										$num_cart = mysqli_num_rows($result_cart);
										if($num_cart!=0){
											while($row_cart = mysqli_fetch_array($result_cart)){
												$quantity_cart += intval($row_cart['quantity']);
											}
											echo $quantity_cart;
									}else{
										echo '0';
									}}else if(isset($_SESSION["clientID"])){
										$quantity_cart = 0;
										$quantity_wish = 0;
										
										$sql_cart = "SELECT `clientID`,`quantity` FROM cart WHERE clientID = '".$_SESSION['clientID']."'";
										$sql_wish = "SELECT `clientID`,`productID` FROM wishlist WHERE clientID = '".$_SESSION['clientID']."'";
										$result_cart = mysqli_query($con,$sql_cart);
										$result_wish = mysqli_query($con,$sql_wish);
										$num_cart = mysqli_num_rows($result_cart);
										if($num_cart!=0){
											while($row_cart = mysqli_fetch_array($result_cart)){
												$quantity_cart += intval($row_cart['quantity']);
											}
											echo $quantity_cart;
										}else{
										echo '0';
									}}else{
										echo '0';
									}echo '</div>
								</div>
							</div>
						</div>
					</a>
					<!-- Star -->
					<a href="wishlist.php">
						<div class="star">
							<img src="images/star.svg" alt="">
							<div class="star_num_container">
								<div class="star_num_inner">
									<div class="star_num">';
									if (isset($_SESSION["ID"])){
										$num_wish = mysqli_num_rows($result_wish);
										if($num_wish!=0){
											echo $num_wish;
									}else{
										echo '0';
									}}else{
										echo '0';
									}echo '</div>
								</div>
							</div>
						</div>
					</a>
					<!-- Avatar -->';
					if (isset($_SESSION["ID"])){
						echo '
						<a href="account.php">
						<div class="avatar" style="background-color: #b5b5b59e; border-radius: 50%;width: 25px; height: 25px; padding-left: 3px; margin-top: 9px;">
							<p><b>'.$_SESSION["firstName"][0].$_SESSION["lastName"][0].'</b></p>
						</div>
						</a>';
					}else{
						echo '<a href="login.php">
						<div class="avatar">
							<img src="images/avatar.svg" alt="">
						</div>
					</a>';
					}
					echo '
				</div>
			</div>';
			?>

			<div class="burger_container d-flex flex-column align-items-center justify-content-around menu_mm"><div></div><div></div><div></div></div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="logo menu_mm"><a href="#">FashionCloset</a></div>
		<div class="search">
			<form action="searchList.php" method="get">
				<input type="search" class="search_input menu_mm" required="required" name="keyword">
				<button type="submit" id="search_button_menu" class="search_button menu_mm"><img class="menu_mm" src="images/magnifying-glass.svg" alt=""></button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="#">Tops</a></li>
				<li class="menu_mm"><a href="#">Swimwear</a></li>
				<li class="menu_mm"><a href="#">Dresses</a></li>
				<li class="menu_mm"><a href="#">Plus Size</a></li>
				<li class="menu_mm"><a href="#">Activewear</a></li>
				<li class="menu_mm"><a href="#">Accessories</a></li>
			</ul>
		</nav>
	</div>

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shopping_2.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_container">
						<div class="home_content">
							<div class="home_title">Shopping Cart</div>
							<div class="breadcrumbs">
								<ul>
									<li><a href="index.html">Home</a></li>
									<li>Shopping Cart</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Cart -->

	<div class="cart_container">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="cart_title">your shopping cart</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col">
					<div class="cart_bar d-flex flex-row align-items-center justify-content-start">
					<table id="checkout_table">
					<tr>
						<td width="1400" style="font-size: 12px;"><input type="checkbox" id="checkAll" />&nbsp;Select all</td>
						<td width="13000"><div class="cart_bar_title_name">Product</div></td>
						<div class="cart_bar_title_content ml-auto">
							<div class="cart_bar_title_content_inner d-flex flex-row align-items-center justify-content-end">
								<td width="1900"><div class="cart_bar_title_price">Price(AU$)</div></td>
								<td width="2750"><div class="cart_bar_title_quantity">Quantity</div></td>
								 <td width="650"><div class="cart_bar_title_total">Total</div></td>
								 <td width="1500"><div class="cart_bar_title_button"></div></td>
							</div>
						</div>
					</tr>
					</table>
					</div>
				</div>
			</div>
			<?php
			echo '<form method="post" action="checkout.php">';
			$row_num = 0;
			if (isset($_SESSION["ID"])){
				$sql = "SELECT clientID,productID,quantity,color,size,productName,imUrl,price FROM cart WHERE clientID='$ID'";
				$result = mysqli_query($con,$sql);
				$num = mysqli_num_rows($result);
				if($num!=0){
				while($row = mysqli_fetch_array($result)) {
					$row_num += 1;
					$productID = $row["productID"];
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
					$product_name = $row["productName"];
					$imUrl = $row["imUrl"];
					$price = $row["price"];
					
					echo '<div class="row">
				<div class="col">
					<div class="cart_products">
					<table id="checkout_table">
					<tr class="cart_product">
								<!-- Checkbox -->
								<input style="display:none;" name="ID_'.$row_num.'" value="'.$productID.'">
								<td><div><input type="checkbox" name="checkbox_'.$row_num.'" value="checked" class="checkCss" style="margin-left:32px;" /></div></td>
								<!-- Product Image -->
								<td><div class="cart_product_image"><img src="'.$imUrl.'" alt="product_image" style="width:120px; margin-left:45px;"></div></td>
								<!-- Product Name -->
								<td><div class="cart_product_name"><a href="product.html" style="margin-left:0px;">'.$product_name.'*'.$color.'*'.$size.'</a></div></td>
								<input style="display:none;" name="name_'.$row_num.'" value="'.$product_name.'">
								<input style="display:none;" name="color_'.$row_num.'" value="'.$color.'">
								<input style="display:none;" name="size_'.$row_num.'" value="'.$size.'">
								<div class="cart_product_info ml-auto">
									<div class="cart_product_info_inner d-flex flex-row align-items-center justify-content-md-end justify-content-start">
										<!-- Product Price -->
										<td><div class="cart_product_price" style="width:273px;    margin-right: -50px;">'.$price.'</div></td>
										<input style="display:none;" name="price_'.$row_num.'" value="'.$price.'">
										<!-- Product Quantity -->
										<td class="count">
										<div class="product_quantity_container">
											<div class="product_quantity clearfix">
												<input class="quantity_input" name="quantity_'.$row_num.'" type="text" value="'.$quantity.'">
												<div class="quantity_buttons">
													<a href="addCartWL.php?ID='.$productID.'&color='.$color.'&size='.$size.'" style="color:#232323;"><div class="quantity_inc_button" value="+"><i class="fa fa-caret-up" aria-hidden="true"></i></div></a>
													<a href="removeCartWL.php?delID='.$productID.'&color='.$color.'&size='.$size.'" style="color:#232323;"><div class="quantity_dec_button" value="-"><i class="fa fa-caret-down" aria-hidden="true"></i></div></a>
												</div>
											</div>
										</div>
										</td>
										<!-- Products Total Price -->
										<td><div class="cart_product_total" style="margin-left:-10px;">'.$price*$quantity.'</div></td>
										<!-- Product Cart Trash Button -->
										<td><div class="cart_product_button"><a href="removeCartWL.php?ID='.$productID.'&color='.$color.'&size='.$size.'" class="product_plus"><img src="images/trash.png" alt="remove_product"></a>
										</div></td>
									</div>
								</div>
						</tr>
						</table>
					</div>
				</div>
			</div>';
				}}else{
					echo '<br /><br /><p>&emsp;&emsp;Your cart is empty.</p>';
				}
					}else if (isset($_SESSION["clientID"])){
						$sql_temp = "SELECT clientID,productID,quantity,color,size,productName,imUrl,price FROM cart WHERE clientID='$clientID'";
						$result_temp = mysqli_query($con,$sql_temp);
						$num_temp = mysqli_num_rows($result_temp);
						if($num_temp!=0){
						while($row_temp = mysqli_fetch_array($result_temp)) {
							$row_num += 1;
							$productID = $row_temp["productID"];
							$quantity = $row_temp["quantity"];
							if (isset($row_temp["color"])){
								$color = $row_temp["color"];
							}else{
								$color = "Fixed";
							}
							if (isset($row_temp["size"])){
								$size = $row_temp["size"];
							}else{
								$size = "Normal";
							}
							$product_name = $row_temp["productName"];
							$imUrl = $row_temp["imUrl"];
							$price = $row_temp["price"];
							
							echo '<div class="row">
				<div class="col">
					<div class="cart_products">
					<table id="checkout_table">
					<tr class="cart_product">
								<!-- Checkbox -->
								<input style="display:none;" name="ID_'.$row_num.'" value="'.$productID.'">
								<td><div><input type="checkbox" name="checkbox_'.$row_num.'" value="checked" class="checkCss" style="margin-left:32px;" /></div></td>
								<!-- Product Image -->
								<td><div class="cart_product_image"><img src="'.$imUrl.'" alt="product_image" style="width:120px; margin-left:45px;"></div></td>
								<!-- Product Name -->
								<td><div class="cart_product_name"><a href="product.html" style="margin-left:0px;">'.$product_name.'*'.$color.'*'.$size.'</a></div></td>
								<input style="display:none;" name="name_'.$row_num.'" value="'.$product_name.'">
								<input style="display:none;" name="color_'.$row_num.'" value="'.$color.'">
								<input style="display:none;" name="size_'.$row_num.'" value="'.$size.'">
								<div class="cart_product_info ml-auto">
									<div class="cart_product_info_inner d-flex flex-row align-items-center justify-content-md-end justify-content-start">
										<!-- Product Price -->
										<td><div class="cart_product_price" style="width:273px;    margin-right: -50px;">'.$price.'</div></td>
										<input style="display:none;" name="price_'.$row_num.'" value="'.$price.'">
										<!-- Product Quantity -->
										<td class="count">
										<div class="product_quantity_container">
											<div class="product_quantity clearfix">
												<input class="quantity_input" name="quantity_'.$row_num.'" type="text" value="'.$quantity.'">
												<div class="quantity_buttons">
													<a href="addCartWL.php?ID='.$productID.'&color='.$color.'&size='.$size.'" style="color:#232323;"><div class="quantity_inc_button" value="+"><i class="fa fa-caret-up" aria-hidden="true"></i></div></a>
													<a href="removeCartWL.php?delID='.$productID.'&color='.$color.'&size='.$size.'" style="color:#232323;"><div class="quantity_dec_button" value="-"><i class="fa fa-caret-down" aria-hidden="true"></i></div></a>
												</div>
											</div>
										</div>
										</td>
										<!-- Products Total Price -->
										<td><div class="cart_product_total" style="margin-left:-10px;">'.$price*$quantity.'</div></td>
										<!-- Product Cart Trash Button -->
										<td><div class="cart_product_button"><a href="removeCartWL.php?ID='.$productID.'&color='.$color.'&size='.$size.'" class="product_plus"><img src="images/trash.png" alt="remove_product"></a>
										</div></td>
									</div>
								</div>
						</tr>
						</table>
					</div>
				</div>
			</div>';
						}}else{
							echo '<br /><br /><p>&emsp;&emsp;Your cart is empty.</p>';
						}
					}else{
						echo '<br /><br /><p>&emsp;&emsp;Your cart is empty.</p>';
					}echo '
			
			<div class="row">
				<div class="col">
					<div class="cart_control_bar d-flex flex-md-row flex-column align-items-start justify-content-start">
						<button class="button_clear cart_button"><a href="removeCartWL.php?operation=clear" id="clear_btn">clear cart</a></button>
						<button class="button_update cart_button_2 ml-md-auto"><a href="index.php" id="shopping_btn">continue shopping</a></button>
					</div>
				</div>
			</div>';
			mysqli_close($con);
			?>
			<div class="row cart_extra">
				<!-- Cart Coupon -->
				<div class="col-lg-6">
					<div class="cart_coupon">
						<div class="cart_title">coupon code</div>
						<form action="#" class="cart_coupon_form d-flex flex-row align-items-start justify-content-start" id="cart_coupon_form">
							<input type="text" class="cart_coupon_input" name="coupon_input" placeholder="Coupon code">
						</form>
					</div>
				</div>
				<!-- Cart Total -->
				<div class="col-lg-5 offset-lg-1">
					<div class="cart_total" id="cart_total">
						<div class="cart_title">cart total</div>
						<ul>
							<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="cart_total_title">Subtotal</div>
								<div class="t" style="display:none;">Selected <span id="countTotal">0</span> items</div>
								<div class="cart_total_price ml-auto">AU$<span id="priceTotal">0.00</span></div>
							</li>
							<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="cart_total_title">Shipping</div>
								<div class="cart_total_price ml-auto">AU$0.00</div>
							</li>
							<li class="d-flex flex-row align-items-center justify-content-start">
								<div class="cart_total_title">Total</div>
								<div class="cart_total_price ml-auto">AU$<span id="sumPrice">0.00</span></div>
							</li>
						</ul>
						<input type="submit" class="cart_total_button" id="btnOrder" value="Place order"></button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>

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
					<div class="footer_logo"><a href="#">Fashion Closet</a></div>
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
<script src="js/cart_custom.js"></script>
<script type="text/javascript" src="js/cart.js" ></script>
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
</body>
</html>