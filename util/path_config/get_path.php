<?php
$root = $_SERVER["DOCUMENT_ROOT"];
$directory = dirname($_SERVER["PHP_SELF"]);
require_once $root . $directory . "/global_link_files.php";
if (isset($_GET["path_name"])) {
    echo GlobalLinkFiles::getLink($_GET["path_name"]);
}
