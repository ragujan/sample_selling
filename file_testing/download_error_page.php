<?php
if (isset($_GET["error_code"])) {
    $error_code = $_GET["error_code"];
    $html_content_error_message ;
    if ($error_code == "0001") {
        ?>
        <div class="">
            <h3><b>Wrong credentials</b></h3>
            <p>Do not edit or change any values in those two fields </p>
            <p></p>
        </div> 
        <?php
    }
    if ($error_code == "0002") {
    }
    if ($error_code == "0003") {
    }
    if ($error_code == "0004") {
    }
    if ($error_code == "0005") {
    }
}
