<?php
session_start();
include "../vendor/autoload.php";

// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51J7i2wKy85cwwCHP7ZguJXqQVemWwnfr5mPfrW2Ujkao6iJ9JLDGi5YdRLg2Qj67nTFeTtaKDRqlY7444JLmMidx00TNEnpW0K');
$stripe = new \Stripe\StripeClient(
  'sk_test_51J7i2wKy85cwwCHP7ZguJXqQVemWwnfr5mPfrW2Ujkao6iJ9JLDGi5YdRLg2Qj67nTFeTtaKDRqlY7444JLmMidx00TNEnpW0K'
);
$token = $_POST['stripeToken'];
$email = $_POST['stripeEmail'];
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:80/sampleSelling-master';

require_once "Samples.php";
$object = new Samples();
$sampleids;
$qtys;

if (isset($_POST["uniqueId"]) && isset($_POST["qty"]) && (count($_POST["uniqueId"]) == count($_POST["qty"]))) {
  $sampleids = $_POST["uniqueId"];
  $qtys = $_POST["qty"];
  $lineItems = array();
  $userId = "not_a_logged_in_user";
  if ($_SESSION["userEmail"]) {
    include_once "../userProcess/CheckUser.php";
    $userEmail = $_SESSION["userEmail"];
    $user = new CheckUser();
    $userId = $user->getCustomerUniqueIdByEmail($userEmail);
  }
  \Stripe\Customer::create(array(
    "source"  => $token,
    "email" => $email,
    "description" => "It Worked!"
  ));
  for ($i = 0; $i < count($sampleids); $i++) {
    $qty = $qtys[$i];
    if ($object->checkId($sampleids[$i])) {

      $sampledetails =  $object->getSampleDetails($sampleids[$i]);
      $sampleprice = $sampledetails[0]['SamplePrice'] * 100;
      $samplename = $sampledetails[0]['Sample_Name'];
      $sampleImagePath = $sampledetails[0]['source_URL'];
      $sampleId = $sampledetails[0]["UniqueId"];
      $sampleImagePath = str_replace(array('.'), "", $sampleImagePath);
      $sampleImagePath = str_replace(array('jpg'), ".jpg", $sampleImagePath);
      $sampleImagePath = $YOUR_DOMAIN . $sampleImagePath;

      //create meta data to attach to the price 
      $meta_data = array("user_id" => $userId, "sample_id" => $sampleId, "qty" => $qty);
      $product = \Stripe\Product::create([
        'name' => "{$samplename}",
        'images' => [
          "{$sampleImagePath}"
        ]
      ]);

      $price = \stripe\price::create([
        'product' => "{$product['id']}",
        'unit_amount' => "{$sampleprice}",
        'currency' => 'usd',
        'metadata' => $meta_data

      ]);
      array_push($lineItems, [
        'price' => "{$price['id']}",
        'quantity' => $qtys[$i],
      ]);
    }
  }

  if (count($lineItems) > 0) {
    $lineItems  = array('line_items' => $lineItems);
    $checkout_session = \Stripe\Checkout\Session::create([
      $lineItems,
      'mode' => 'payment',
      'success_url' => $YOUR_DOMAIN . '/payment-testing/success.html',
      'cancel_url' => $YOUR_DOMAIN . '/payment-testing/cancel.html',
    ]);


    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
  } else {
    header("Location: $YOUR_DOMAIN/payment-testing/viewcart.php");
  }
} else {
  header("Location: $YOUR_DOMAIN/payment-testing/viewcart.php");
}
