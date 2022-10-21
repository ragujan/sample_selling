<?php


class GlobalLinkFiles
{
    public static function getLink($path_name)
    {
        $file = "link.json";
        $unparsed_json_file = file_get_contents($file);
        $object = json_decode($unparsed_json_file);
        $actual_path = "";
        foreach ($object as $key => $value) {
            if ($value->path_name == $path_name) {
                $actual_path = $value->actual_path;
                break;
            }
        }
        return $actual_path;
    }
    public static function getProductDirectories($directory_name)
    {
        $file = $_SERVER["DOCUMENT_ROOT"]."/sampleSelling-master/util/path_config/products.json";
        $unparsed_json_file = file_get_contents($file);
        $object = json_decode($unparsed_json_file);
        $actual_path = "";
        foreach ($object as $key => $value) {
            if($value->directory_name == $directory_name){
                $actual_path = $value->actual_path;
            };
            // if ($value->path_name == $directory_name) {
            //     $actual_path = $value->actual_path;
            //     break;
            // }
        }
        return $actual_path;
    }
}
// $image_path = GlobalLinkFiles::getProductDirectories("image");
// $zip_path = GlobalLinkFiles::getProductDirectories("zip_file");
// $audio_src_path = GlobalLinkFiles::getProductDirectories("audio");

// echo "image path is ".$image_path;
// echo "<br>";
// echo "zip path is ". $zip_path;
// echo "<br>";
// echo "audio path is". $audio_src_path;
// echo  GlobalLinkFiles::getProductDirectories("audio");