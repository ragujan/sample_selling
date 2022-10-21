<?php

require_once "../uploadSamples/SampleUniqueiDProcess.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/sampleSelling-master/util/path_config/global_link_files.php";

$image_path = GlobalLinkFiles::getDirectoryPath("image");

$zip_path = GlobalLinkFiles::getDirectoryPath("zip_file");

$audio_src_path = GlobalLinkFiles::getDirectoryPath("audio");

class FileHandler
{
    public $thecommonfile;
    public $location;
    public $thefile;
    public $unique_name_generated;
    public $location_in_server;
    public function filedetails($thefile, $folderDirectory, $size, $type)
    {

        $file = $thefile;
        $filename = $file["name"];
        $filetype = $file["type"];
        $filesize = $file["size"];
        $filetemp = $file["tmp_name"];
        $this->unique_name_generated = uniqid() . $filename;
        $this->location = $_SERVER["DOCUMENT_ROOT"] . $folderDirectory . $this->unique_name_generated;
        $this->location_in_server = $this->unique_name_generated;
        $filefullname = explode(".", $filename);
        $format = strtolower(end($filefullname));

        $acceptedtype = array("{$type}");
        $acceptedsize = "{$size}";

        if (in_array($format, $acceptedtype) === false) {
            $errors[] = "not the expected file format it should be a {$type} file .";
        }

        if ($filesize > $acceptedsize) {
            $errors[] = "File size must be excately {$size} MB";
        }

        if (empty($errors) == true) {
            move_uploaded_file($filetemp, $this->location);
        } else {
            print_r($errors);
        }
    }
    public function getFilename()
    {
        return $this->unique_name_generated;
    }
}


$charLength = 25;
if (
    isset($_POST["SampleName"]) &&  !empty($_POST["SampleName"])
    && isset($_POST["SamplePrice"]) && intval($_POST["SamplePrice"])
    && !empty($_POST["SamplePrice"]) && isset($_POST["SampleDescription"])
    && !empty($_POST["SampleDescription"])
) {


    if (isset($_FILES["SampleFile"])) {
        if (
            $_FILES["SampleFile"]["type"] == "application/x-zip-compressed" && $_FILES["SampleAudio"]["type"] == "audio/mpeg" && $_FILES["SampleImage"]["type"] == "image/jpeg"
        ) {








            require "../DB/DB.php";
            $typesearch = DB::forsearch("SELECT * FROM `sampletype`;");
            $availabletypes;

            $sname = $_POST["SampleName"];
            $sprice = $_POST["SamplePrice"];
            $subSampletype = $_POST["SampleSubMelody"];
            $sampledescription = $_POST["SampleDescription"];

            $date = date("Y-m-d h:i:s");
            $sampleUniqueiDProcess = new SampleUniqueiDProcess();

            DB::insert("INSERT INTO `samples` (`Sample_Name`,`Sample_Date`,`SamplePrice`,`SubsampleID`,`SampleDescription`,`UniqueId`)VALUES('" . $sname . "','" . $date . "','" . $sprice . "','" . $subSampletype . "','" . $sampledescription . "','" . $sampleUniqueiDProcess->getCheckedRandomUniqueId() . "') ");
            $lastID = DB::$dbms->insert_id;

            if (isset($_FILES["SampleFile"])) {
                $fileHandlerforzip = new FileHandler();
                $fileHandlerforzip->filedetails($_FILES["SampleFile"], $zip_path, "50000000", "zip");
                $zippathname =$zip_path . $fileHandlerforzip->getFilename();

                DB::insert("INSERT INTO `samplePath`(`samplePath`,`sampleID`) VALUES ('" . $zippathname . "','" . $lastID . "') ");
            }
            if (isset($_FILES["SampleAudio"])) {

                $fileHandlerforzip = new FileHandler();
                $fileHandlerforzip->filedetails($_FILES["SampleAudio"], $audio_src_path, "50000000", "mp3");
                $audiopathname =$audio_src_path . $fileHandlerforzip->getFilename();
                DB::insert("INSERT INTO `sampleaudio`(`sampleAudioSrc`,`sampleID`) VALUES ('" . $audiopathname . "','" . $lastID . "') ");
            }
            if (isset($_FILES["SampleImage"])) {

                $fileHandlerforzip = new FileHandler();
                $fileHandlerforzip->filedetails($_FILES["SampleImage"], $image_path, "50000000", "jpg");
                $imagepathname = $image_path . $fileHandlerforzip->getFilename();
                DB::insert("INSERT INTO `sampleimages`(`source_URL`,`sampleID`) VALUES ('" . $imagepathname . "','" . $lastID . "') ");
            }
        } else {

            echo "Not the exact file type ";
        }
    }
} else {
    if (!intval($_POST["SamplePrice"])) {
        echo "Invalid Input for sample price";
    }

    if (!isset($_FILES["SampleFile"])) {
        echo "No zip files has been uploaded";
    }
    if (!isset($_FILES["SampleAudio"])) {
        echo "No audio files has been uploaded";
    }
    if (!isset($_FILES["SampleImage"])) {
        echo "No Image files has been uploaded";
    }
}
