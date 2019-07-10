<?php
session_start();
require_once('./common.php');

$con=mysqli_connect("localhost","root","","fashiondb");
mysqli_query($con, "set names 'gdk'");

if (isset($_SESSION["ID"])){
	$ID = $_SESSION["ID"];
	$_SESSION["ID"] = $ID;
	$first_name = $_SESSION["firstName"];
	$_SESSION["firstName"] = $first_name;
	$last_name = $_SESSION["lastName"];
	$_SESSION["lastName"] = $last_name;
}else if (isset($_SESSION["clientID"])){
	$clientID = $_SESSION["clientID"];
	$_SESSION["clientID"] = $clientID;
}
$discount = $_SESSION["discount"];
$_SESSION["discount"] = $discount;
$orderID = $_GET["orderID"];
$_SESSION["orderID"] = $orderID;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ShippingAddress;

// ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$sumPrice = 0;
$productList = array();
$sql = "select orderID,productID,productName,quantity,price,discount from orders where orderID = '$orderID'";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
	$item = new Item();
	$item->setName($row["productName"])
    ->setCurrency('AUD')
    ->setQuantity($row["quantity"])
    ->setSku(strval($row["productID"])) // Similar to `item_number` in Classic API
    ->setPrice(round($row["price"]*$row["discount"],2));
	array_push($productList,$item);
	$sumPrice += round($row["price"]*$row["discount"],2)*$row["quantity"];
}

$itemList = new ItemList();
$itemList->setItems($productList);

echo $_POST["shipping_fn"]." ".$_POST["shipping_ln"];
echo $_POST["Address"];
echo $_POST["Town"];
echo $_POST["State"];
echo $_POST["Phone_No"];
echo $_POST["Zipcode"];
echo $_POST["Country"];

$address = new ShippingAddress();
$address->setRecipientName($_POST["shipping_fn"]." ".$_POST["shipping_ln"])
        ->setLine1($_POST["Address"])
        ->setLine2(' ')
        ->setCity($_POST["Town"])
        ->setState($_POST["State"])
        ->setPhone($_POST["Phone_No"])
        ->setPostalCode($_POST["Zipcode"])
        ->setCountryCode($_POST["Country"]);

$itemList->setShippingAddress($address);


// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
$details = new Details();
$details->setShipping(0)
    ->setTax(round($sumPrice*0.1,2))
    ->setSubtotal(round($sumPrice,2));

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("AUD")
    ->setTotal(round($sumPrice*0.1,2) + round($sumPrice,2))
    ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("FashionCloset Payment")
    ->setInvoiceNumber(uniqid());

// ### Redirect urls
// Set the urls that the buyer must be redirected to after
// payment approval/ cancellation.
$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/exec.php?success=true")
    ->setCancelUrl("$baseUrl/exec.php?success=false");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

$payment->create($apiContext);

$approvalUrl = $payment->getApprovalLink();
header("Location: {$approvalUrl}");