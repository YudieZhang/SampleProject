<?php
session_start();
set_time_limit(3600);
require_once('./common.php');

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

$orderID = $_SESSION["orderID"];
$_SESSION["orderID"] = $orderID;
$discount = $_SESSION["discount"];
$con=mysqli_connect("localhost","root","","fashiondb");
mysqli_query($con, "set names 'gdk'");

// ### Approval Status
// Determine if the user approved the payment or not
if (isset($_GET['success']) && $_GET['success'] == 'true') {

    // Get the payment Object by passing paymentId
    // payment id was previously stored in session in
    // CreatePaymentUsingPayPal.php
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);

    // ### Payment Execute
    // PaymentExecution object includes information necessary
    // to execute a PayPal account payment.
    // The payer_id is added to the request query parameters
    // when the user is redirected from paypal back to your site
    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    // ### Optional Changes to Amount
    // If you wish to update the amount that you wish to charge the customer,
    // based on the shipping address or any other reason, you could
    // do that by passing the transaction object with just `amount` field in it.
    // Here is the example on how we changed the shipping to $1 more than before.

	$sumPrice = 0;
	$productList = array();
	$sql = "select orderID,productID,productName,quantity,price,discount from orders where orderID = '$orderID'";
	$result = mysqli_query($con,$sql);
	
	while($row = mysqli_fetch_array($result)) {
		$sumPrice += $row["price"]*$row["quantity"]*$row["discount"];
	}

    $transaction = new Transaction();
    $amount = new Amount();
    $details = new Details();

    $details->setShipping(0)
        ->setTax(round($sumPrice*0.1,2))
        ->setSubtotal(round($sumPrice,2));

    $amount->setCurrency('AUD');
    $amount->setTotal(round($sumPrice*0.1,2) + round($sumPrice,2));
    $amount->setDetails($details);
    $transaction->setAmount($amount);

    // Add the above transaction object inside our Execution object.
    $execution->addTransaction($transaction);

    try {
        // Execute the payment
        $result = $payment->execute($execution, $apiContext);
        header("Location: ./pmt_success.php");
    } catch (Exception $ex) {
        header("Location: ../cancel.php");
        exit(1);
    }

    return $payment;
} else if (isset($_GET['success']) && $_GET['success'] == 'false'){
	header("Location: ../cancel.php");
} else {
    echo "PayPal returns invalid callback address parameter.";
}