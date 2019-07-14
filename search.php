<?php

session_start();

$ID = $_SESSION["ID"];
$_SESSION["ID"] = $ID;

if (isset($_POST["keyword"])) {
	$keyword=$_POST['keyword'];
}else{
	$keyword="";
}
if (isset($POST["categories"])) {
	$select_categories=$_POST['categories'];
}else{
	$select_categories="";
}

$con=mysqli_connect("localhost","root","","fashiondb");
mysqli_query($con, "set names 'gdk'");

if ($keyword!="") {
	if (isset($_SESSION["result"])) {
		$items=array();
		foreach ($_SESSION["result"] as $value){
			if (strpos($value["title"],$keyword)!=false OR strpos($value["description"],$keyword)!=false OR strpos($value["brand"],$keyword)!=false){
				array_push($items,$value);
			}
		}
		$_SESSION["result"]=$items;
	}else{
	$sql = "SELECT `ID`,`also_viewed`,`also_bought`,`bought_together`,`title`,`price`,`salesRank`,`imUrl`,`brand`,`categories`,`description` FROM product WHERE title LIKE '%".$keyword."%' OR description LIKE '%".$keyword."%' OR brand LIKE '%".$keyword."%'";
	$result = mysqli_query($con,$sql);
	$_SESSION["result"] = mysqli_fetch_array($result);

	while($row = mysqli_fetch_array($result)) {
		$categories=str_replace("[","",$row['categories']);
		$categories=str_replace("[","",$categories);
		$categories= explode(',',$categories);
		$_SESSION["categories"]=$categories;
	}
	mysqli_close($con);
}} else {
	if (isset($_SESSION["result"])) {
		foreach($_SESSION["result"] as $row) {
			$categories=str_replace("[","",$row['categories']);
			$categories=str_replace("[","",$categories);
			$categories= explode(',',$categories);
			$items=array();
			foreach ($categories as $value){
				if ($select_categories == $value){
					array_push($items,$row);
				}
			}
			$_SESSION["result"]=$items;
		}
	}else{	
	$sql = "SELECT `ID`,`also_viewed`,`also_bought`,`bought_together`,`title`,`price`,`salesRank`,`imUrl`,`brand`,`categories`,`description` FROM product";
	$result = mysqli_query($con,$sql);

	while($row = mysqli_fetch_array($result)) {
		$categories=str_replace("[","",$row['categories']);
		$categories=str_replace("[","",$categories);
		$categories= explode(',',$categories);
		$items=array();
		foreach ($categories as $value){
			if ($select_categories == $value){
				array_push($items,$row);
			}
		}
	}
	$_SESSION["result"]=$items;
	mysqli_close($con);
}}
?>