<?php
$root = $_SERVER["DOCUMENT_ROOT"];
$directory = dirname($_SERVER["PHP_SELF"]);
require_once $root . $directory . "/global_link_files.php";

    echo GlobalLinkFiles::getLink("site_header");

