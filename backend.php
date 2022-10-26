<?php
if(isset($_GET["HEY"])){
    echo "this is a GET request ". $_GET["HEY"];
}
if(isset($_POST["HEY"])){
    echo "this is a post request ". $_POST["HEY"];
}


?>