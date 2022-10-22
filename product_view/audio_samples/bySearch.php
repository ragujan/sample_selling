<?php
require "../query/Sample_query_functions.php";
require "../utils/Pagination.php";
require "../utils/ShowHTML.php";
$pageName = "bySearch";
$jsMethodName = "nextfunctionsearch";
$pagenumber;
$allowedPages = 0;
$stopnumber = 0;
$outputpage = 0;
$valueforBTN = 0;
$exactResultsPerPage = 8;
$DefaultSampleTypeNumber = 1;
$A;

$object = new Sample_query_functions();
if (isset($_POST["PG"]) && intval(($_POST["PG"])) && !empty(($_POST["PG"]))   && isset($_POST["searchText"])) {
   
    $A = $_POST["PG"];
    $searchText = $_POST["searchText"];
    $valueforBTN = $searchText;
    $samplePage = $object->searchByTextPages($searchText);
    if ($A >= $samplePage) {
        $A = $samplePage;
    } else if ($A <= 0) {
        $A = 0;
    }

    $melody = $object->searchByText($searchText, $A * $exactResultsPerPage);
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else if (isset($_POST["searchText"])) {
    $A = 0;
    
    $searchText = $_POST["searchText"];
    if ($searchText == "") {
      
    }
    
    $valueforBTN = $searchText;
    $samplePage = $object->searchByTextPages($searchText);
    if ($A >= $samplePage) {
        $A = $samplePage;
    } else if ($A <= 0) {
        $A = 0;
    }
    $melody = $object->searchByText($searchText, 0);
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else if (isset($_POST["PG"])) {
    $A = $_POST["PG"];

    $searchText = "";
   
    $valueforBTN = $searchText;
    $samplePage = $object->searchByTextPages($searchText);
    if ($A >= $samplePage) {
        $A = $samplePage;
    } else if ($A <= 0) {
        $A = 0;
    }
    $melody = $object->searchByText($searchText, 0);
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else {

    $A = 0;
    
    $valueforBTN = "null";
    $melody = $object->searchByText($searchText, $A * $exactResultsPerPage);
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
}
$getRows = $melody;
$htmlContentObject = new ShowHTML();
echo $htmlContentObject->htmlContent($getRows, $allowedPages, $A, $valueforBTN, $pageName,$jsMethodName);
?>