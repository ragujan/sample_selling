<?php
require "DownloadLink.php";
require "DirectoryZip.php";
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$folder_creation_path = GlobalLinkFiles::getFilePath("folder_creation");
$style = GlobalLinkFiles::getDirectoryPath("style");
$query_object = new DownloadLink();
$link = "http://localhost/sampleSelling-master/file_testing/authenticate_download.php?unique_id=6374abd38d577&dnt=2022-11-16%2010:22:27";
$style_path = $style . "authenticate_download.css";
$bootstap_path = $style . "bootstrap.css";
$sample_selling_path = $style . "sampleselling.css";
// if (isset($_GET["unique_id"]) && isset($_GET["dnt"])) {


//     $unique_id = $_GET["unique_id"];
//     $dnt = $_GET["dnt"];


//     $folder_name = $folder_creation_path . uniqid() . "folder_rag";

//     //make folder



//     mkdir($folder_name);

//     $status = $query_object->confirmCustomerPurchase($unique_id, $dnt);
//     if ($status == 1) {

//         $products = $query_object->get_products($unique_id, $dnt);
//         $row_count = count($products);
//         print_r($products);

//         for ($i = 0; $i < $row_count; $i++) {
//             # code...
//             $qty = $products[$i]["qty"];
//             for ($j = 0; $j < $qty; $j++) {
//                 $product = $ROOT . $products[$i]["samplePath"];
//                 echo $product;
//                 $unique_id = $products[$i]["UniqueId"] . uniqid() . $products[$i]["Sample_Name"];
//                 $folder_path = $folder_name . "/" . $unique_id . ".zip";
//                 copy($product, $folder_path);
//             }
//         }
//     }

//     $folder_path_to_be_zipped = $ROOT . "/" . "sampleSelling-master/downloadable_zip_files/" . uniqid() . ".zip";
//     echo $folder_path_to_be_zipped;
//     $zip = new DirectoryZip($folder_path_to_be_zipped, $folder_name);
// }
$unique_id = $_GET["unique_id"];
$dnt = $_GET["dnt"];



//confirmation and warning message to show
$are_you_sure = "This is an one time download link for your purchase, we don't take responsibilities
    if your download gets failed not because of server side issue, so make you sure you download it correctly"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $bootstap_path ?>">
    <link rel="stylesheet" href="<?= $sample_selling_path ?>">
    <link rel="stylesheet" href="<?= $style_path ?>">
    <title>authenticate_download</title>

</head>

<body>
    <div class="container-fluid">


        <div  id="warning_div" class="bg-danger col-lg-6 offset-lg-3 col-10 offset-1  mt-3 py-2 px-2 abc">
            <div>
                <span><b>Important! Please follow these guidance to avoid any troubles </b></span>
            </div>
            <div>
                <ul>

                    <li>Do not disable Javascript
                        <br>
                        <p>We need to track the downloading status to
                            make sure the download is successful, if Javascript is disabled
                            we wono't be able to track and you will not get another chance

                        </p>
                    </li>
                </ul>
                <ul>


                    <li>This is an onetime download link so be careful
                        <br>
                        <p>Since the samples sizes aren't huge make sure to download
                            them and have a good internet connection


                        </p>
                    </li>

                </ul>
            </div>
            <div class="text-end">
                <div>
                    <button id="accept-btn" onclick="acceptBtnProcess('<?=$unique_id?>','<?=$dnt?>');" class="accept-btn">accept</button>
                </div>
            </div>

        </div>
        <div class="row  p-5">
            <div id="download-form" class="col-12 d-none ">
      
            </div>
        </div>
    </div>
   
    <script src="script.js"></script>
</body>

</html>