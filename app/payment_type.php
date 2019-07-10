<?php
session_start();

if($_POST["regular_radio"]=="cash"){
	header("Location: ./pmt_success.php");
}else if($_POST["regular_radio"]=="card"){
	$orderID = $_GET["orderID"];
	echo "<script>window.location.href='payment.php?orderID=".$orderID."';</script>";
}else{
	echo "<script>alert('Please select the payment type.'); history.go(-1);</script>";
}
?>