<?php


// if(isset($_SESSION['userEmail'])){
//     session_destroy ();
    

// }
session_start();
unset($_SESSION['userEmail']);
if(isset($_SESSION['userEmail'])){
    echo "blah blah rasputin";
}else{

}
 header('Location: http://localhost/sampleSelling-master/home/home.php'); 
?>