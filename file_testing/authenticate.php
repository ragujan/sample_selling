<?php
require "DownloadLink.php";
require "DirectoryZip.php";
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$folder_creation_path = GlobalLinkFiles::getFilePath("folder_creation");

$query_object = new DownloadLink();
$link = "http://localhost/sampleSelling-master/file_testing/authenticate.php?unique_id=6374abd38d577&dnt=2022-11-16%2010:22:27";
if (isset($_GET["unique_id"]) && isset($_GET["dnt"])) {
   
    $link_encode = urlencode($link);
   
    $link_decode = urldecode($link_encode);
 
    $unique_id = $_GET["unique_id"];
    $dnt = $_GET["dnt"];

    echo "<br>";
    $folder_name = $folder_creation_path . uniqid() . "folder_rag";

    //make folder

    echo "<br>";

    mkdir($folder_name);

    $status = $query_object->confirmCustomerPurchase($unique_id, $dnt);
    if ($status == 1) {

        $products = $query_object->get_products($unique_id, $dnt);
        $row_count = count($products);
        print_r($products);
        echo "<br>";
        for ($i = 0; $i < $row_count; $i++) {
            # code...
            $qty = $products[$i]["qty"];
            for ($j = 0; $j < $qty; $j++) {
                $product = $ROOT . $products[$i]["samplePath"];
                echo $product;
                $unique_id = $products[$i]["UniqueId"].uniqid().$products[$i]["Sample_Name"];
                $folder_path = $folder_name."/".$unique_id.".zip";
                copy($product,$folder_path);
                echo "<br>";
            }
        }
    }
}
$folder_path_to_be_zipped = $ROOT."/"."sampleSelling-master/downloadable_zip_files/". uniqid().".zip";
echo $folder_path_to_be_zipped;
$zip = new DirectoryZip($folder_path_to_be_zipped,$folder_name);