<?php

require "../midiFiles/midiValidations.php";
$validation = MidiValidations::checkValidation($_POST["PG"], $_POST["SSTN"]);
$PG = $_POST["PG"];
$ID = $_POST["SSTN"];
$getRows;
$valueforBTN;
$exactResultsPerPage = 8;
$A = $_POST["PG"];
$subsampletypenumber = $_POST["SSTN"];
$jsMethodName = "commonNextFunction";
$pageName = "sampleTypeMidi";
if ($validation == 1) {
  require "../PDOPHP/Sample_query_functions.php";
 
  $object = new Sample_query_functions();
  if ($_POST["SSTN"] == 0 OR !isset($_POST["SSTN"])) {
    echo "echo becho";
    $getPages = $object->sampleTypePages(4);
    if ($A >= $getPages) {
      $A = $getPages;
    } else if ($A <= 0) {
      $A = 0;
    }
    echo $getPages;
    $getRows = $object->sampleType(4, $A * $exactResultsPerPage);
    $valueforBTN = 0;
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
  } else  if ($_POST["SSTN"] !== 0) {
    
    $getPages = $object->subSampleTypePages($_POST["SSTN"]);
    if ($A >= $getPages) {
      $A = $getPages;
    } else if ($A <= 0) {
      $A = 0;
    }
    $getRows = $object->subSampleType($_POST["SSTN"], $A * $exactResultsPerPage);
    $valueforBTN = $ID;
    $totalCount = $object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
  }
  require "../PDOPHP/ShowHTML.php";
  $htmlContentObject = new ShowHTML();
  echo $htmlContentObject->htmlContent($getRows, $allowedPages, $A, $valueforBTN, $pageName,$jsMethodName);
} else {
  echo "Nope";
}
