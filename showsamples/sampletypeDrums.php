<?php
require "../PDOPHP/Sample_query_functions.php";
require "../PDOPHP/Pagination.php";
// require "../PDOPHP/Validations.php";
$pageName = "sampleTypeMelody";
$pagenumber;
$allowedPages = 0;
$stopnumber = 0;
$outputpage = 0;
$valueforBTN = 0;
$exactResultsPerPage = 8;
$DefaultSampleTypeNumber = 2;
$jsMethodName = "commonNextFunction";
$A;

$object = new Sample_query_functions();




if (isset($_POST["PG"]) && isset($_POST["SSTN"])) {

    
    $A = $_POST["PG"];
    $subsampletypenumber = $_POST["SSTN"];
    if ($subsampletypenumber == 0) {

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

require "../PDOPHP/ShowHTML.php";
$htmlContentObject = new ShowHTML();
echo $htmlContentObject->htmlContent($getRows, $allowedPages, $A, $valueforBTN, $pageName,$jsMethodName);
