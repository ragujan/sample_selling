
<?php
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

require '../vendor/autoload.php';
require '../customer/Query.php';
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
    $customer_entered_email = $paymentIntent->email;
    $event_name = $paymentIntent->object;
    $customer = new Query();
    $customer->insert_just($customer_entered_email,$event_name);
    break;
   case 'checkout.session.completed':
    $event_name = $event->data->object->object;
    $checkout_session_id = $event->data->object->id;
    \Stripe\Stripe::setApiKey('sk_test_51J7i2wKy85cwwCHP7ZguJXqQVemWwnfr5mPfrW2Ujkao6iJ9JLDGi5YdRLg2Qj67nTFeTtaKDRqlY7444JLmMidx00TNEnpW0K');
    $stripe = new \Stripe\StripeClient(
      'sk_test_51J7i2wKy85cwwCHP7ZguJXqQVemWwnfr5mPfrW2Ujkao6iJ9JLDGi5YdRLg2Qj67nTFeTtaKDRqlY7444JLmMidx00TNEnpW0K'
    );


    $line_items = \Stripe\Checkout\Session::allLineItems($checkout_session_id);

    $listname = $line_items->object;
    $list_items_array = $line_items->data;


    foreach ($list_items_array as $lists) {
      $price_id = $lists["price"]["id"];

      $sample_id = $lists["price"]["metadata"]["sample_id"];
      $user_id = $lists["price"]["metadata"]["user_id"];
      $qty = $lists["price"]["metadata"]["qty"];
      $customer = new Query();
      $customer_id = 0;
      $unique_id = uniqid();
      if ($user_id == "not_a_logged_in_user") {
        $user_id = 0;

      } else {
        $customer_id = $customer->get_user_id($user_id);
      }
      $dnt = date("Y-m-d h:i:s");


      $customer->insert_just($customer_email_from_invoice,$event_name);

    }
    break;


  default:
    echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);
