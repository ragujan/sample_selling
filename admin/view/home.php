<?php
session_start();
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$style_path = GlobalLinkFiles::getDirectoryPath("style");
if (!isset($_SESSION["admin_session"]) && !isset($_SESSION["admin_verify_session"])) {

    header('Location: http://localhost/sampleSelling-master/admin_login');
    die();
} else if (isset($_SESSION["admin_verify_session"]) && !isset($_SESSION["admin_session"])) {
   
    header('Location: http://localhost/sampleSelling-master/admin/view/admin_verify.php');
    die();
} else if (!isset($_SESSION["admin_verify_session"]) && isset($_SESSION["admin_session"])) {

  
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo $style_path; ?>bootstrap.css">
        <link rel="stylesheet" href="<?php echo $style_path; ?>common.css">
        <link rel="stylesheet" href="<?php echo $style_path; ?>admin.css">
        <title>home</title>
    </head>

    <body>

    </body>

    </html>
<?php
}
?>