<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$abc = "marshall_mathers ";
function abc(){
    $abc = "not marshall mathers";
    return $abc;
}


echo abc();

?>