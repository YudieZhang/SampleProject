<?php
	session_start();
	
	$con=mysqli_connect("localhost","root","","fashiondb");
	mysqli_query($con, "set names 'gdk'");
	if (isset($_GET["ID"])){
		$productID = $_GET["ID"];
		if(isset($_GET["color"])){
			$color = $_GET["color"];
		}else{
			$color = "Fixed";
		}
		if(isset($_GET["size"])){
			$size = $_GET["size"];
		}else{
			$size = "Normal";
		}
		$sql_select = "SELECT * FROM products WHERE productID='$productID'";
		$result_select = mysqli_query($con,$sql_select);
		while($row = mysqli_fetch_array($result_select)) {
			$title = $row['productName'];
			$price = $row['price'];
			$imUrl = $row['img_first'];
		}
	}else if(isset($_GET["itemID"])){
		$productID = $_GET["itemID"];
		$sql_select = "SELECT * FROM products WHERE productID='$productID'";
		$result_select = mysqli_query($con,$sql_select);
		while($row = mysqli_fetch_array($result_select)) {
			$title = $row['productName'];
			$price = $row['price'];
			$imUrl = $row['img_first'];
		}
	}else if (isset($_GET["operation"])){
	}else if (isset($_GET["delID"])){
		$productID = $_GET["delID"];
		if(isset($_GET["color"])){
			$color = $_GET["color"];
		}else{
			$color = "Fixed";
		}
		if(isset($_GET["size"])){
			$size = $_GET["size"];
		}else{
			$size = "Normal";
		}
		$sql_select = "SELECT * FROM products WHERE productID='$productID'";
		$result_select = mysqli_query($con,$sql_select);
		while($row = mysqli_fetch_array($result_select)) {
			$title = $row['productName'];
			$price = $row['price'];
			$imUrl = $row['img_first'];
		}
	}else{
		echo "<script>alert('Oops...Sorry, there seems to be some technical issues so the page blocked. Please try again later.'); history.go(-1);</script>";
	}
		
	if (isset($_SESSION["ID"])){
		$ID = $_SESSION["ID"];
		$_SESSION["ID"] = $ID;
		$first_name = $_SESSION["firstName"];
		$_SESSION["firstName"] = $first_name;
		$last_name = $_SESSION["lastName"];
		$_SESSION["lastName"] = $last_name;
	   
		if (isset($_GET["ID"])){
			$sql = "DELETE FROM cart WHERE productID = '$productID' AND clientID = '$ID' AND color = '$color' AND size = '$size'";
		}else if (isset($_GET["itemID"])){
			$sql = "DELETE FROM wishlist WHERE productID = '$productID' AND clientID = '$ID'";
		}else if (isset($_GET["operation"])){
			if ($_GET["operation"] == "clear"){
				$sql = "DELETE FROM cart WHERE clientID = '$ID'";
			}else if ($_GET["operation"] == "clearWL"){
				$sql = "DELETE FROM wishlist WHERE clientID = '$ID'";
			}
		}else if (isset($_GET["delID"])){
			$sql_del = "SELECT clientID, productID, quantity FROM cart WHERE productID = '$productID' AND clientID = '$ID' AND color = '$color' AND size = '$size'";
			$result_del = mysqli_query($con,$sql_del);
			$num = mysqli_num_rows($result_del);
			if($num!=0){
				while($row = mysqli_fetch_array($result_del)) {
					$quantity = $row["quantity"];
					if ($quantity != 1){
						$quantity = intval($quantity) - 1;
					}
					$sql = "UPDATE cart SET quantity = '$quantity' WHERE productID='$productID' AND clientID='$ID' AND color = '$color' AND size = '$size'";
				}
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
			$sql = "DELETE FROM cart WHERE productID = '$productID' AND clientID = '$clientID' AND color = '$color' AND size = '$size'";
		}else if (isset($_GET["itemID"])){
			$sql = "DELETE FROM wishlist WHERE productID = '$productID' AND clientID = '$clientID'";
		}else if (isset($_GET["operation"])){
			if ($_GET["operation"] == "clear"){
				$sql = "DELETE FROM cart WHERE clientID = '$clientID'";
			}
		}else if (isset($_GET["delID"])){
			$sql_del = "SELECT clientID, productID, quantity FROM cart WHERE productID = '$productID' AND clientID = '$ID' AND color = '$color' AND size = '$size'";
			$result_del = mysqli_query($con,$sql_del);
			$num = mysqli_num_rows($result_del);
			if($num!=0){
				while($row = mysqli_fetch_array($result_del)) {
					$quantity = $row["quantity"];
					if ($quantity != 1){
						$quantity = intval($quantity) - 1;
					}
					$sql = "UPDATE cart SET quantity = '$quantity' WHERE productID='$productID' AND clientID='$ID' AND color = '$color' AND size = '$size'";
				}
			}
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
	}else{
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