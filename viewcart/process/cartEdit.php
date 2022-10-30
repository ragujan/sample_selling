<?php


if (isset($_POST["id"]) && intval($_POST["id"]) && $_POST["id"] > 0 && !empty($_POST["id"]) && isset($_POST["qty"]) && intval($_POST["qty"]) && $_POST["qty"] > 0 && !empty($_POST["qty"])) {
    $ID = $_POST["id"];
    $QTY = $_POST["qty"];
    require "../query/Sample_query_functions.php";
    $object = new Sample_query_functions();
    echo $object->checkCartrows($ID);
    echo "yeah";
} else {
    echo "Nope";
}
