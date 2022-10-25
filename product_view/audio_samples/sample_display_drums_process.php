
<?php
require "../query/Sample_query_functions.php";
require "../utils/pagination.php";
require "../utils/product_view.php";
require "../utils/page_buttons.php";
// require "../PDOPHP/Validations.php";
$query_object = new Sample_query_functions();
$pageName = "sample_display_drums_process";

$allowedPages = 0;
$valueforBTN = 0;
$exactResultsPerPage = $query_object->getExactResultsPerPage();
$DefaultSampleTypeNumber = 2;
$jsMethodName = "commonNextFunction";
$page_number ;

if(isset($_POST["page_number"]) && isset($_POST["sub_sample_id"])){
    // echo "page number and sub sample id is received";
}

if(isset($_POST["page_number"])){
    // echo "Page number is received";
}
if(isset($_POST["sub_sample_id"])){
    // echo "sub sample id is received";
}
if(!isset($_POST["page_number"]) && !isset($_POST["sub_sample_id"])){
   // echo "neither page number or sub sample id is received";
}

if (isset($_POST["page_number"]) && isset($_POST["sub_sample_id"])) {
    //if page number and the sub sample id is sent to the server 
    $page_number = $_POST["page_number"];
   
    
    $subsampletypenumber = $_POST["sub_sample_id"];
    if ($subsampletypenumber == 0) {
        // if the sub sample type number is zero which means 
        $valueforBTN = 0;

        $total_result_count = $query_object->sampleTypePages($DefaultSampleTypeNumber);
        if ($page_number >= $total_result_count) {
            $page_number = $total_result_count;
        } else if ($page_number <= 0) {
            $page_number = 0;
        }

        $results_per_page= $query_object->sampleType($DefaultSampleTypeNumber, $page_number * $exactResultsPerPage);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    } else {
        //if the sub sample type number is not zero and the page number is received
        $valueforBTN = $subsampletypenumber;
        $total_result_count = $query_object->subSampleTypePages($subsampletypenumber);
        if ($page_number >= $total_result_count) {
            $page_number = $total_result_count;
        } else if ($page_number <= 0) {
            $page_number = 0;
        }
        $results_per_page= $query_object->subSampleType($subsampletypenumber,$page_number * $exactResultsPerPage);
        $totalCount = $query_object->returnTotalCount();
        $allowedPages = ceil($totalCount / $exactResultsPerPage);
    }
} else if (isset($_POST["page_number"])) {
    $page_number = $_POST["page_number"];

    $valueforBTN = 0;
    $total_result_count = $query_object->sampleTypePages($DefaultSampleTypeNumber);
    if ($page_number >= $total_result_count) {
        $page_number = $total_result_count;
    } else if ($page_number <= 0) {
        $page_number = 0;
    }
 
    $results_per_page= $query_object->SampleType($DefaultSampleTypeNumber, $page_number * $exactResultsPerPage);
    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
} else {
    $page_number = 0;
    $valueforBTN = 0;
    $results_per_page= $query_object->sampleType($DefaultSampleTypeNumber, $page_number * $exactResultsPerPage);

    $totalCount = $query_object->returnTotalCount();
    $allowedPages = ceil($totalCount / $exactResultsPerPage);
}
$htmlContentObject = new ProductView();
echo $htmlContentObject->view_audio_samples($results_per_page, $allowedPages, $page_number, $valueforBTN, $pageName,$jsMethodName);
