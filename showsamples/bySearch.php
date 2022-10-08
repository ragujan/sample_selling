<?php
require "../PDOPHP/queryFunctions.php";
require "../PDOPHP/Pagination.php";
$pageName = "bySearch";
$pagenumber;
$allowedPages = 0;
$stopnumber = 0;
$outputpage = 0;
$valueforBTN = 0;
$exactResultsPerPage = 8;
$DefaultSampleTypeNumber = 1;
$A;

$object = new queryFunctions();
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

if (count($melody) == 0 or $melody[0] == "Nothing") {
?>
    <div class="row thesamplecontainer1">
        <div class="col-12 text-center text-white">
            <h1>Nothing to show here</h1>
        </div>
    </div>
<?php
} else {

?>
    <div class="row thesamplecontainer1  ">
        <div class="col-12">
            <div class="row">
                <?php
                for ($i = 0; $i < count($melody); $i++) {
                    $melodydetails = $melody;
                    $melodyname =  $melodydetails[$i]["Sample_Name"];
                    $melodyprice =  $melodydetails[$i]["SamplePrice"];
                    $melodyID =  $melodydetails[$i]["sampleID"];
                    $imagePath =  $melodydetails[$i]["source_URL"];;
                    $audioPath = $melodydetails[$i]["sampleAudioSrc"];
                ?>
                     <div class="  col-lg-3 py-3  col-md-4 offset-md-0 col-sm-6 offset-sm-3 col-10 offset-1">
                        <div class="row  ">

                            <div id="beatPackDiv<?php echo $melodyID; ?>" class=" col-10 beatpackdiv  py-lg-0 py-md-0 py-0 offset-1">
                                <div class="row">
                                    <div class="col-12   audiopreviewdiv px-0 pt-0 pb-1 ">
                                        <audio id="audio<?php echo $melodyID ?>" class="audiopreviewImage">
                                            <source src="<?php echo $audioPath; ?>" type="audio/ogg">
                                            <source src="<?php echo $audioPath; ?>" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                        <img src="<?php echo $imagePath; ?>" class="beatPACKIMAGE " alt="">
                                        <img  id="playmusic<?php echo $melodyID ?>" onclick="playmusic('<?php echo $melodyID ?>');" class="playcolrols audiopreview" src="../BrymoImages/play-button.png" alt="">
                                        <img  id="pausemusic<?php echo $melodyID ?>" onclick="pausemusic('<?php echo $melodyID ?>');" class="playcolrols audiopreview d-none" src="../BrymoImages/pause.png" alt="">
                                    </div>

                                    <div class="col-12 d-flex  flex-column pb-3 px-4 ">                               
                                            <h5 style=""  class="text-white mt-3  sampleDetailsBox-Name "><?php echo $melodyname ?></h5>
                                            <h5 class="text-white mt-1  sampleDetailsBox">$ 47.44</h5>
                                            <button class="viewBTN mt-1 sampleDetailsBox  py-lg-2 py-sm-1" onclick="viewbuy('<?php echo $melodyID ?>')">View</button>                                   
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
        <div class="col-10 offset-1 col-md-12 offset-md-0 mt-5 py-1 text-center  navbuttons">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-12 offset-0">

                    <div class="row">
                        <?php
                        require "../PDOPHP/PageButtons.php";
                        $P = new PageButtons();

                        $pageBtn = $P->produceBtns($allowedPages, $A, $valueforBTN, "nextfunctionsearch", $pageName,);
                        ?>

                    </div>
                </div>
            </div>

        </div>

    </div>

<?php
}

?>