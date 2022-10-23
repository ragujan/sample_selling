
<?php
require "../query/Sample_query_functions.php";
require "../utils/pagination.php";
require "../utils/product_view.php";
require "../utils/page_buttons.php";
// require "../PDOPHP/Validations.php";
$pageName = "sampleTypeMidi";
$pagenumber;
$allowedPages = 0;
$stopnumber = 0;
$outputpage = 0;
$valueforBTN = 0;
$exactResultsPerPage = 8;
$DefaultSampleTypeNumber = 4;
$jsMethodName = "commonNextFunction";
$A;

$object = new Sample_query_functions();




if (isset($_POST["PG"]) && isset($_POST["SSTN"])) {

    
    $A = $_POST["PG"];
    $subsampletypenumber = $_POST["SSTN"];
    if ($subsampletypenumber == 0) {
     
        $valueforBTN = 0;

        $samplePage = $object->sampleTypePagesMidi($DefaultSampleTypeNumber);
        if ($A >= $samplePage) {
            $A = $samplePage;
        } else if ($A <= 0) {
            $A = 0;
        }

        $getRows = $object->sampleTypeMidi($DefaultSampleTypeNumber, $A * $exactResultsPerPage);
        $totalCount = $object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    } else {
        $valueforBTN = $subsampletypenumber;

        $samplePage = $object->subSampleTypePages($subsampletypenumber);
        if ($A >= $samplePage) {
            $A = $samplePage;
        } else if ($A <= 0) {
            $A = 0;
        }
        $getRows = $object->sampleType($DefaultSampleTypeNumber,$A * $exactResultsPerPage);
        $totalCount = $object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    }
} else if (isset($_POST["PG"])) {
    
    $A = $_POST["PG"];

    $valueforBTN = 0;
    $samplePage = $object->sampleTypePages($DefaultSampleTypeNumber);
    if ($A >= $samplePage) {
        $A = $samplePage;
    } else if ($A <= 0) {
        $A = 0;
    }
 
    $getRows = $object->sampleType($DefaultSampleTypeNumber, $A * $exactResultsPerPage);
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else {
    
    $A = 0;
    $valueforBTN = 0;
    $getRows = $object->sampleType($DefaultSampleTypeNumber, $A * $exactResultsPerPage);

    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
}

$htmlContentObject = new ProductView();
echo $htmlContentObject->view_midi_samples($getRows, $allowedPages, $A, $valueforBTN, $pageName,$jsMethodName);
