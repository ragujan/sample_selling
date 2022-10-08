<?php
// require "../PDOPHP/queryFunctions.php";
// require "../PDOPHP/Pagination.php";
// $object = new queryFunctions();
// $melody = $object->subSampleType(4, 0);
// $totalCount = $object->returnTotalCount(); 

require "../PDOPHP/queryFunctions.php";
require "../PDOPHP/Pagination.php";
$pagenumber;
$allowedPages = 0;
$stopnumber = 0;
$outputpage = 0;
$valueforBTN =0;
$exactResultsPerPage =4;
$DefaultSampleTypeNumber = 1;
$A;

$object = new queryFunctions();
if (isset($_POST["PG"]) && isset($_POST["SSTN"])) {
    
    $A = $_POST["PG"];  
    $subsampletypenumber = $_POST["SSTN"];  
    if($subsampletypenumber =="null"){
        
        $valueforBTN = "null";
        
        $samplePage = $object->sampleTypePages($DefaultSampleTypeNumber);
        if ($A >= $samplePage) {
            $A = $samplePage;
        } else if ($A <= 0) {
            $A = 0;
        }
        $melody = $object->sampleType($DefaultSampleTypeNumber, $A * $exactResultsPerPage);
        $totalCount = $object->returnTotalCount();   
        $allowedPages = ceil($totalCount / $exactResultsPerPage);


    }else{
        $valueforBTN = $subsampletypenumber;
       
        $samplePage = $object->subSampleTypePages($subsampletypenumber);
        if ($A >= $samplePage) {
            $A = $samplePage;
        } else if ($A <= 0) {
            $A = 0;
        }
    
        $melody = $object->subSampleType($subsampletypenumber, $A * $exactResultsPerPage);
        $totalCount = $object->returnTotalCount();   
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    }

} else if (isset($_POST["PG"])) {
    $A = $_POST["PG"];
    
    $valueforBTN = "null";
    $samplePage = $object->sampleTypePages($DefaultSampleTypeNumber);
    if ($A >= $samplePage) {
        $A = $samplePage;
    } else if ($A <= 0) {
        $A = 0;
    }
    $melody = $object->sampleType($DefaultSampleTypeNumber, $A * $exactResultsPerPage);
    $totalCount = $object->returnTotalCount();   
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else {
    $A = 0;
    
    $valueforBTN = "null";
    $melody = $object->sampleType($DefaultSampleTypeNumber, $A * $exactResultsPerPage);
    $totalCount = $object->returnTotalCount();  
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
}
$array_1 = array($allowedPages, $A,$valueforBTN,"nextfunctionmelody");
array_push($melody,$array_1);
$json = json_encode($melody);
echo $json;
?>