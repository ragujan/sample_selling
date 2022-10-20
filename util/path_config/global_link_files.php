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
}

