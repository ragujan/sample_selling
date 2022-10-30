<?php

$type;
$name;
if ($_POST["type"] && $_POST["name"]) {
    $type = $_POST["type"];
    $name = $_POST["name"];
    require_once "../path_config/global_link_files.php";

    echo  GlobalLinkFiles::getRelativePath($name);
}
