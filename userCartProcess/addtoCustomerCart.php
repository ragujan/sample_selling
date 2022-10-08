<?php
session_start();

require "../userProcess/CheckUser.php";
if (isset($_SESSION["userEmail"])) {
    $email = $_SESSION["userEmail"];
    $cartItems = $_POST["array"];

    $array = json_decode($cartItems);
    $customerQuery = new CheckUser();
    $getId = $customerQuery->getCusIdByEmail($email);
    //echo $customerQuery->getCustomerCart($email);
   
    foreach ($array as $c) {
        echo  $customerQuery->checkCusIdinCartByEmail($email, $c->id, $c->qty);
        // 

    }
}
