<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$folder_creation_path = GlobalLinkFiles::getFilePath("folder_creation");

$file = "a.zip";
$newly_generated_name = uniqid(). $file;

//initialzie a unique folder name
$folder_name = $folder_creation_path .uniqid()."folder_rag";

//make folder
mkdir($folder_name);
//newly generated path 
$newly_generated_path = $folder_name . "/" . $newly_generated_name;

//copy the zip file to that directoy
copy($file,$newly_generated_path);
echo "<br>";
echo $ROOT;
echo "<br>";
$newly_generated_path = str_replace($ROOT,"localhost",$newly_generated_path);
$download_url = $newly_generated_path;

//purchase_unique_id
$purchased_unique_id = "?unique_id=abcded2021-11-10 10:47:42";
$download_url = $download_url . $purchased_unique_id;
echo $download_url;
