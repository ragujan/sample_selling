<?php

session_start();
if (!isset($_SESSION["userEmail"])) {
   echo  "window.location=  http://localhost/sampleSelling-master/home/home.php";
} else {
   $uname = $_POST["un"];
   $ulname = $_POST["uln"];
   $ufname = $_POST["ufn"];


   require_once "../userProcess/CheckUser.php";
   $userQuery = new CheckUser();
   $checkuserbyEmail = $userQuery->checkEmail($_SESSION["userEmail"]);
   if ($checkuserbyEmail) {
      $queryUpdateStatus =$userQuery->updateUsers($ufname, $ulname, $uname, $_SESSION["userEmail"]);
      if($queryUpdateStatus){
         echo "Success";
      }else{
         echo "Failed to produce";
      }
   }
}
