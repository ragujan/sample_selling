
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

// Handle the event
switch ($event->type) {

  case 'checkout.session.completed':
    $checkout_session_id = $event->data->object->id;
    $purchased_customer_email = $event->data->object->customer_email;
    // $checkout_id = $event->data->object->id;
     // $sql = "INSERT INTO rag (rag)
    //       VALUES ('" . $payment_intent_id . "')";
    \Stripe\Stripe::setApiKey('sk_test_51J7i2wKy85cwwCHP7ZguJXqQVemWwnfr5mPfrW2Ujkao6iJ9JLDGi5YdRLg2Qj67nTFeTtaKDRqlY7444JLmMidx00TNEnpW0K');


    $line_items = \Stripe\Checkout\Session::allLineItems($checkout_session_id);

    $listname = $line_items->object;
    $list_items_array = $line_items->data;

    foreach($list_items_array as $lists){
        $sample_id = $lists["price"]["metadata"]["sample_id"];
        $user_id = $lists["price"]["metadata"]["user_id"];
        $qty = $lists["price"]["metadata"]["qty"];
        $customer = new Query();
        $customer_id = 0;
        $unique_id = uniqid();
        if($user_id == "not_a_logged_in_user"){
            $user_id = 0;
            $result_set = $customer->get_user_id_from_stripe($purchased_customer_email);
            $unique_id = $purchased_customer_email;
          //  $customer_id = $result_set[0]["CustomerID"];
            
            
        }else{
            $customer_id = $customer->get_user_id($user_id);
        }
        $dnt = date("Y-m-d h:i:s");
        
       
        $customer->insert_just("ragjn");
        
        $sample_id = $customer->get_sample_id($sample_id);
        $customer->insert_customer_purchase($unique_id,$dnt,$qty,$customer_id,$sample_id);
         
    }
    break;


  case 'payment_intent.canceled':
    $paymentIntent = $event->data->object;
    break;
  case 'payment_intent.created':
    $paymentIntent = $event->data->object;
    break;
  case 'payment_intent.partially_funded':

    $paymentIntent = $event->data->object;
    break;
  case 'payment_intent.payment_failed':
    $paymentIntent = $event->data->object;
    break;
  case 'payment_intent.processing':
    $paymentIntent = $event->data->object;
    break;
  case 'payment_intent.requires_action':
    $paymentIntent = $event->data->object;
    break;
  case 'payment_intent.succeeded':
    $paymentIntent = $event->data->object;
    break;
  default:
    echo 'Received unknown event type ' . $event->type;
}

http_response_code(200);