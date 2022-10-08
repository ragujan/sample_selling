<?php

require "../midiFiles/midiValidations.php";
if(!isset($_POST["PG"])){
    $_POST["PG"]=0;
}
$validation = MidiValidations::checkSearchValidation($_POST["PG"], $_POST["searchText"]);
$PG = $_POST["PG"];
$ST = $_POST["searchText"];
$getRows;
$valueforBTN;
$exactResultsPerPage = 8;
$A = $_POST["PG"];
$subsampletypenumber = $_POST["searchText"];
$jsMethodName = "nextfunctionsearch";
$pageName = "sampleTypeMidi";
if ($validation == 1) {
  require "../PDOPHP/queryFunctions.php";
 
  $object = new queryFunctions();
  if ($_POST["searchText"] == "" OR !isset($_POST["searchText"])) {
  
    $getPages = $object->searchByTextPages($_POST["searchText"]);
    if ($A >= $getPages) {
      $A = $getPages;
    } else if ($A <= 0) {
      $A = 0;
    }
    $getRows = $object->searchByText($_POST["searchText"], $A * $exactResultsPerPage);
    $valueforBTN = 0;
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
  } else  if ($_POST["searchText"] !== "") {
    
    $getPages = $object->searchByTextPages($_POST["searchText"]);
    if ($A >= $getPages) {
      $A = $getPages;
    } else if ($A <= 0) {
      $A = 0;
    }
    $getRows = $object->searchByText($_POST["searchText"], $A * $exactResultsPerPage);
    $valueforBTN = $ST;
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
  }
  require "../PDOPHP/ShowHTML.php";
  $htmlContentObject = new ShowHTML();
  echo $htmlContentObject->htmlContent($getRows, $allowedPages, $A, $valueforBTN, $pageName,$jsMethodName);
} else {
  echo "Nope";
}
