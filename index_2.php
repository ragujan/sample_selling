<?php
$pageName = str_replace(array('.php'), '', basename(__FILE__));
echo $pageName;

echo 'PHP version: ' . phpversion();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";

$vendor_path = GlobalLinkFiles::getFilePath("vendor_autoload");
$sendEmail_path = GlobalLinkFiles::getFilePath("send_email");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta harset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="mydiv"></div>
    <form action="backend.php" method="post">
        <input type="text" name="HEY" value="RAGJN">
        <button type="submit">click</button>
    </form>
    <select id="abc">
        <option value="abc">abc</option>
        <option value="rag">rag</option>
    </select>
    <button onclick="clickFunction();">click</button>
<a href='#'>DDD</a>
    <input id="myfile" type="file">

    <script src="script.js"></script>
</body>

</html>
<?php

    $abc = "ragmarshall";
    $abc = "ragmarshall";
    $abc = "ragmarshall";
    $abc = "ragmarshall";
    $abc = "ragmarshall";
    $abc = "ragmarshall";
