<?php
	session_start();
	
	$con=mysqli_connect("localhost","root","","fashiondb");
	mysqli_query($con, "set names 'gdk'");
	if (isset($_GET["ID"])){
		$productID = $_GET["ID"];
	}else if(isset($_GET["itemID"])){
		$productID = $_GET["itemID"];
	}else{
		echo "<script>alert('Oops...Sorry, there seems to be some technical issues so the page blocked. Please try again later.'); history.go(-1);</script>";
	}
	$sql_select = "SELECT * FROM products WHERE productID='$productID'";
	$result_select = mysqli_query($con,$sql_select);
	while($row = mysqli_fetch_array($result_select)) {
		$title = $row['productName'];
		$price = $row['price'];
		$imUrl = $row['img_first'];
	}
		
	if (isset($_SESSION["ID"])){
		$ID = $_SESSION["ID"];
		$_SESSION["ID"] = $ID;
		$first_name = $_SESSION["firstName"];
		$_SESSION["firstName"] = $first_name;
		$last_name = $_SESSION["lastName"];
		$_SESSION["lastName"] = $last_name;
	   
		if (isset($_GET["ID"])){
			if (isset($_POST["quantity"])){
				$p_quantity = $_POST["quantity"];
			}else{
				$p_quantity = 1;
			}
			if (isset($_POST["color_radio"])){
				$color = $_POST["color_radio"];
			}else if(isset($_GET["color"])){
				$color = $_GET["color"];
			}else{
				$color = "Fixed";
			}
			if (isset($_POST["product_radio"])){
				$size = $_POST["product_radio"];
			}else if(isset($_GET["size"])){
				$size = $_GET["size"];
			}else{
				$size = "Normal";
			}
			$sql_get = "SELECT clientID, productID,quantity,color,size from cart WHERE productID='$productID' AND clientID='$ID' AND color='$color' AND size='$size'";
			$result_get = mysqli_query($con,$sql_get);
			$num = mysqli_num_rows($result_get);
			if($num!=0){
				$exist = 0;
				while($row = mysqli_fetch_array($result_get)) {
					if ($row["color"]==$color && $row["size"]==$size){
						$exist = 1;
						$quantity = $row["quantity"];
						$quantity = intval($quantity) + $p_quantity;
						$sql = "UPDATE cart SET quantity = '$quantity' WHERE productID='$productID' AND clientID='$ID' AND color='$color' AND size='$size'";
					}
				}
				if ($exist == 0){
					$sql = "insert into cart(clientID,productID,quantity,color,size,productName,imUrl,price) values ('$ID','$productID','$p_quantity','$color','$size','$title','$imUrl','$price')";
				}
			}else{
				$sql = "insert into cart(clientID,productID,quantity,color,size,productName,imUrl,price) values ('$ID','$productID','$p_quantity','$color','$size','$title','$imUrl','$price')";
			}
		}else{
			$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$ID' AND productID = '$productID'";
			$result_match = mysqli_query($con,$sql_match);
			$num = mysqli_num_rows($result_match);
			if($num!=0){
				echo "<script>alert('This product is already in your wishlist!'); history.go(-1);</script>";
			}else{
				$sql = "insert into wishlist(clientID,productID,productName,imUrl,price) values ('$ID','$productID','$title','$imUrl','$price')";
			}
		}
		$result = mysqli_query($con,$sql);
		if (isset($_SESSION["location"])){
			if($_SESSION["location"]=="cart"){
				echo "<script>window.location.href='cart.php';</script>";
			}else{
				echo "<script>history.go(-1);</script>";
			}
		}else{
			echo "<script>history.go(-1);</script>";
		}
	}else if (isset($_SESSION["clientID"])){
		$ID = $_SESSION["clientID"];
		$_SESSION["clientID"] = $ID;
		
		if (isset($_GET["ID"])){
			if (isset($_POST["quantity"])){
				$p_quantity = $_POST["quantity"];
			}else{
				$p_quantity = 1;
			}
			if (isset($_POST["color_radio"])){
				$color = $_POST["color_radio"];
			}else if(isset($_GET["color"])){
				$color = $_GET["color"];
			}else{
				$color = "Fixed";
			}
			if (isset($_POST["product_radio"])){
				$size = $_POST["product_radio"];
			}else if(isset($_GET["size"])){
				$size = $_GET["size"];
			}else{
				$size = "Normal";
			}
			$sql_get = "SELECT clientID, productID,quantity,color,size from cart WHERE productID='$productID' AND clientID='$ID' AND color='$color' AND size='$size'";
			$result_get = mysqli_query($con,$sql_get);
			$num = mysqli_num_rows($result_get);
			if($num!=0){
				$exist = 0;
				while($row = mysqli_fetch_array($result_get)) {
					if ($row["color"]==$color && $row["size"]==$size){
						$exist = 1;
						$quantity = $row["quantity"];
						$quantity = intval($quantity) + $p_quantity;
						$sql = "UPDATE cart SET quantity = '$quantity' WHERE productID='$productID' AND clientID='$ID' AND color='$color' AND size='$size'";
					}
				}
				if ($exist == 0){
					$sql = "insert into cart(clientID,productID,quantity,color,size,productName,imUrl,price) values ('$ID','$productID','$p_quantity','$color','$size','$title','$imUrl','$price')";
				}
			}else{
				$sql = "insert into cart(clientID,productID,quantity,color,size,productName,imUrl,price) values ('$ID','$productID','$p_quantity','$color','$size','$title','$imUrl','$price')";
			}
		}else{
			$sql_match = "SELECT clientID, productID FROM wishlist WHERE clientID = '$clientID' AND productID = '$productID'";
			$result_match = mysqli_query($con,$sql_match);
			if($result_match!=""){
				echo "<script>alert('This product is already in your wishlist!'); history.go(-1);</script>";
			}else{
				$sql = "insert into wishlist(clientID,productID,productName,imUrl,price) values ('$clientID','$productID','$title','$imUrl','$price')";
			}
		}
		$result = mysqli_query($con,$sql);
		if (isset($_SESSION["location"])){
			if($_SESSION["location"]=="cart"){
				echo "<script>window.location.href='cart.php';</script>";
			}else{
				echo "<script>history.go(-1);</script>";
			}
		}else{
			echo "<script>history.go(-1);</script>";
		}
	}else{
		$clientID = uniqid();
		
		if (isset($_GET["ID"])){
			$sql = "insert into cart(clientID,productID,quantity,productName,imUrl,price) values ('$clientID','$productID','1','$title','$imUrl','$price')";
		}else{
			$sql = "insert into wishlist(clientID,productID,productName,imUrl,price) values ('$clientID','$productID','$title','$imUrl','$price')";
		}
		$result = mysqli_query($con,$sql);
		$_SESSION["clientID"] = $clientID;
		
		if (isset($_SESSION["location"])){
			if($_SESSION["location"]=="cart"){
				echo "<script>window.location.href='cart.php';</script>";
			}else{
				echo "<script>history.go(-1);</script>";
			}
		}else{
			echo "<script>history.go(-1);</script>";
		}
	}
	mysqli_close($con);
?>