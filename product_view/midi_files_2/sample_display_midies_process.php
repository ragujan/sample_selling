
<?php
require "../query/Sample_query_functions.php";
require "../utils/pagination.php";
require "../utils/product_view.php";
require "../utils/page_buttons.php";
// require "../PDOPHP/Validations.php";

$query_object = new Sample_query_functions();
$pageName = "sample_display_midies_process";
$pagenumber;
$allowedPages = 0;
$stopnumber = 0;
$outputpage = 0;
$valueforBTN = 0;
$exactResultsPerPage = $query_object->getExactResultsPerPage();
$DefaultSampleTypeNumber = 4;
$jsMethodName = "commonNextFunction";
$A;





if (isset($_POST["PG"]) && isset($_POST["SSTN"])) {

    
    $A = $_POST["PG"];
    $subsampletypenumber = $_POST["SSTN"];
    if ($subsampletypenumber == 0) {
     
        $valueforBTN = 0;

        $samplePage = $query_object->sampleTypePagesMidi($DefaultSampleTypeNumber);
        if ($A >= $samplePage) {
            $A = $samplePage;
        } else if ($A <= 0) {
            $A = 0;
        }

        $getRows = $query_object->sampleTypeMidi($DefaultSampleTypeNumber, $A * $exactResultsPerPage);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    } else {
        $valueforBTN = $subsampletypenumber;

        $samplePage = $query_object->subSampleTypePages($subsampletypenumber);
        if ($A >= $samplePage) {
            $A = $samplePage;
        } else if ($A <= 0) {
            $A = 0;
        }
        $getRows = $query_object->sampleType($DefaultSampleTypeNumber,$A * $exactResultsPerPage);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    }
} else if (isset($_POST["PG"])) {
    
    $A = $_POST["PG"];

    $valueforBTN = 0;
    $samplePage = $query_object->sampleTypePages($DefaultSampleTypeNumber);
    if ($A >= $samplePage) {
        $A = $samplePage;
    } else if ($A <= 0) {
        $A = 0;
    }
 
    $getRows = $query_object->sampleType($DefaultSampleTypeNumber, $A * $exactResultsPerPage);
    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else {
    
    $A = 0;
    $valueforBTN = 0;
    $getRows = $query_object->sampleType($DefaultSampleTypeNumber, $A * $exactResultsPerPage);

    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
}

$htmlContentObject = new ProductView();
echo $htmlContentObject->view_midi_samples($getRows, $allowedPages, $A, $valueforBTN, $pageName,$jsMethodName);
