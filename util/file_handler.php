<?php
class FileHandler
{
    public $location;
    public $unique_name_generated;
   
    public function filedetails($file, $folderDirectory, $size, $type)
    {

        $filename = $file["name"];
        $filetype = $file["type"];
        $filesize = $file["size"];
        $filetemp = $file["tmp_name"];
        $this->unique_name_generated = uniqid() . $filename;
        $this->location = $_SERVER["DOCUMENT_ROOT"] . $folderDirectory . $this->unique_name_generated;
        
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

?>