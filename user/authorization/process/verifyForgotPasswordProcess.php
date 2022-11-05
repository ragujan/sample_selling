<?php
session_start();
$_SESSION["verifyForgotPasswordEmail"]=$_SESSION["userEmail"];

if (isset($_POST["I"]) && !empty($_POST["I"]) && isset($_SESSION["verifyForgotPasswordEmail"]) )  {
  
    $P= $_POST["I"];
    require "../userProcess/CheckUser.php";
    $checkUser = new CheckUser();
    if($checkUser->checkPandE($P, $_SESSION["verifyForgotPasswordEmail"])){
      
      exit("Success");
    }else{
      exit("Counld't verify");
    }
}else{
    exit("Cound't receive vaild data");
}

?>