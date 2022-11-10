
<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$vendor_path = GlobalLinkFiles::getFilePath("vendor_autoload");

// webhook.php
//
// Use this sample code to handle webhook events in your integration.
//
// 1) Paste this code into a new file (webhook.php)
//
// 2) Install dependencies
//   composer require stripe/stripe-php
//
// 3) Run the server on http://localhost:4242
//   php -S localhost:4242

use Stripe\Stripe;

require $vendor_path;
require '../query/Customer.php';
// This is your Stripe CLI webhook secret for testing your endpoint locally.
$endpoint_secret = 'whsec_22a91502bfc987c641589ec8928c3eef6654686db591d387a662e2e6602c7713';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload,
    $sig_header,
    $endpoint_secret
  );
} catch (\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  http_response_code(400);
  exit();
}
$customer_entered_email = "brojogan";
// Handle the event
switch ($event->type) {
  case 'customer.created':
    $paymentIntent = $event->data->object;
    $customer_entered_email = $paymentIntent->id;
    $event_name = $paymentIntent->object;
    $customer = new Customer();
    break;
  case 'checkout.session.completed':
    $event_name = $event->data->object->object;
    $checkout_session_id = $event->data->object->id;


    $customer_creation = $event->data->object->customer;
    \Stripe\Stripe::setApiKey('sk_test_51J7i2wKy85cwwCHP7ZguJXqQVemWwnfr5mPfrW2Ujkao6iJ9JLDGi5YdRLg2Qj67nTFeTtaKDRqlY7444JLmMidx00TNEnpW0K');
    $stripe = new \Stripe\StripeClient(
      'sk_test_51J7i2wKy85cwwCHP7ZguJXqQVemWwnfr5mPfrW2Ujkao6iJ9JLDGi5YdRLg2Qj67nTFeTtaKDRqlY7444JLmMidx00TNEnpW0K'
    );

    $customer_search =  $stripe->customers->retrieve(
      $customer_creation
    );
    $customer_email = $customer_search->email;
    $line_items = \Stripe\Checkout\Session::allLineItems($checkout_session_id);

    $listname = $line_items->object;
    $list_items_array = $line_items->data;


    foreach ($list_items_array as $lists) {
      $price_id = $lists["price"]["id"];

      $sample_id = $lists["price"]["metadata"]["sample_id"];
      $user_id = $lists["price"]["metadata"]["user_id"];
      $qty = $lists["price"]["metadata"]["qty"];
      $customer = new Customer();
      $customer_id = 0;
      $dnt = date("Y-m-d h:i:s");

      $unique_id = uniqid();
      if ($user_id == "not_a_logged_in_user") {

        $customer_id = $customer->get_user_id_from_stripe($customer_email);
        $sample_primary_key_id = $customer->get_sample_id($sample_id);

        if ($customer_id == 0 || $customer_id == '0') {
          $customer->insert_customer_purchase($unique_id, $dnt, $qty, '0', $sample_primary_key_id, $customer_email);
        } else {

          $customer->insert_customer_purchase($unique_id, $dnt, $qty, $customer_id, $sample_primary_key_id, $customer_email);
        }
      } else {
        $customer_id = $customer->get_user_id_from_stripe($customer_email);
        $sample_primary_key_id = $customer->get_sample_id($sample_id);
        $customer->insert_customer_purchase($unique_id, $dnt, $qty, $customer_id, $sample_primary_key_id, $customer_email);
      }
    }
    break;


  default:
    echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);
