<?php
require "DownloadLink.php";
require "DirectoryZip.php";
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$folder_creation_path = GlobalLinkFiles::getFilePath("folder_creation");

$query_object = new DownloadLink();
$link = "http://localhost/sampleSelling-master/file_testing/authenticate.php?unique_id=6374abd38d577&dnt=2022-11-16%2010:22:27";

$unique_id = $_POST["unique_id"];
$dnt = $_POST["dnt"];


$download = new DownloadLink();

if (!$download->checkDownloadStatus($unique_id, $dnt)) {

    //set a unique folder name
    $folder_name = $folder_creation_path . uniqid() . "folder_rag";

    //make folder
    mkdir($folder_name);

    //confirm the unique id and datetime matches in the customerpurchase table
    $status = $download->confirmCustomerPurchase($unique_id, $dnt);
    if ($status == 1) {

        //query customer purchase history table to get the products and the qtys
        $products = $download->get_products($unique_id, $dnt);
        $row_count = count($products);


        for ($i = 0; $i < $row_count; $i++) {
            # code...
            $qty = $products[$i]["qty"];
            //create zip files for each product if the qty is 2 then create 2 zip files
            for ($j = 0; $j < $qty; $j++) {

                //orginal zip file path exact location 
                $product = $ROOT . $products[$i]["samplePath"];
                //unique name is created to create a copy of the zip file
                $unique_name = $products[$i]["UniqueId"] . uniqid() . $products[$i]["Sample_Name"];
                //generate file path for the copy of original zip file 
                $folder_path = $folder_name . "/" . $unique_name . ".zip";
                //original product will be copied to this $folder_path
                copy($product, $folder_path);
            }
        }
    }


    //to zip out the entire folder which contains the zip files as products
    $folder_path_to_be_zipped = $ROOT . "/" . "sampleSelling-master/downloadable_zip_files/" . uniqid() . ".zip";
    echo $folder_path_to_be_zipped;
    $zip = new DirectoryZip($folder_path_to_be_zipped, $folder_name);
    $zip_creation_status = $zip->makeDirectory();
    echo "<br>";
    echo $zip_creation_status;
    echo "<br>";
    echo $zip->getZipCreationStatus();
    if (file_exists($folder_path_to_be_zipped)) {
        echo " yess this file exits";
        //add a row to the download history table so next time there won't be a chance to download again
        //$download->updateDownloadStatus($unique_id, $dnt);

        //download section 


        ob_clean();
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($folder_path_to_be_zipped) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($folder_path_to_be_zipped));
        flush(); // Flush system output buffer
        readfile($folder_path_to_be_zipped);
        unlink($folder_path_to_be_zipped);
        unlink($folder_name);
        exit();
    }
}
