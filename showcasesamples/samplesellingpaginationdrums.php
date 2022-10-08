<?php
require "DB/DB.php";
$pagenumber;
$stopnumber = 0;
$outputpage = 0;
$A;
if (isset($_POST["PG"]) && isset($_POST["SSTN"])) {
    $A = $_POST["PG"];
    $subsampletypenumber = $_POST["SSTN"];
  
    $Q = "SELECT * FROM subsampletype 
    INNER JOIN samples ON samples.SubsampleID=subsampletype.subsampleID 
    WHERE subsampletype.subsampleID = '" . $subsampletypenumber . "' ;";
    $manualQuery = "WHERE  subsampletype.subsampleID = '" . $subsampletypenumber . "' LIMIT 8 OFFSET $outputpage;";
} else if (isset($_POST["PG"])) {

    $A = $_POST["PG"];
 
    $Q = "SELECT * FROM subsampletype 
    INNER JOIN samples ON samples.SubsampleID=subsampletype.subsampleID 
    WHERE subsampletype.sampleTypeID='2' ";
    $manualQuery = "WHERE subsampletype.sampleTypeID='2' LIMIT 8 OFFSET $outputpage";
} else {
    $A = 0;
  
}

$mysearchquery = DB::forsearch("$Q");

$searchobject = new Pagination();
$searchobject->searchqueryinput = $mysearchquery;
$searchedarrays = $searchobject->search();
$tnums = $searchobject->returnrows();

$searchobject->getNumber($tnums);

$outputpage = $searchobject->decidesPages($A);


$stopnumber = $searchobject->returnStopNumber();
$realreceivednumber = $searchobject ->returnRealReceiveNumber();
if (isset($_POST["PG"]) && isset($_POST["SSTN"])) {

    $manualQuery = "WHERE  subsampletype.subsampleID = '" . $subsampletypenumber . "' LIMIT 8 OFFSET $outputpage;";
} else if (isset($_POST["PG"])) {


    $manualQuery = "WHERE subsampletype.sampleTypeID='2' LIMIT 8 OFFSET $outputpage";
} 

$paginationsearchQuery = DB::forsearch("SELECT 
samples.sampleID,samples.Sample_Name,
samples.SamplePrice,
samples.SampleDescription, 
sampleimages.source_URL,
sampleaudio.sampleAudioSrc
FROM subsampletype 
INNER JOIN samples 
ON samples.SubsampleID=subsampletype.subsampleID 
INNER JOIN sampleaudio
ON sampleaudio.sampleID=samples.sampleID
INNER JOIN sampleimages
ON sampleimages.sampleID=samples.sampleID
$manualQuery;");
$paginationOBject = new SearchClass();
$paginationOBject->searchqueryinput = $paginationsearchQuery;
$paginationOBjectArrays = $paginationOBject->search();
$totalcount = count($paginationOBjectArrays);

if ($paginationOBjectArrays[0] == "Nothing") {
?>
    <div class="row">
        <div class="col-12 text-center text-white">
            <h1>Nothing to show here</h1>
        </div>
    </div>
<?php
} else {


?>
    <div id="thesamplecontainer2" class="row thesamplecontainer1  ">
        <div class="col-12">
            <div class="row">



                <?php
                for ($i = 0; $i < $totalcount; $i++) {
                    $melodydetails = $paginationOBjectArrays;
                    $melodyname =  $melodydetails[$i]["Sample_Name"];
                    $melodyprice =  $melodydetails[$i]["SamplePrice"];
                    $melodyID =  $melodydetails[$i]["sampleID"];

                    $imagePath =  $melodydetails[$i]["source_URL"];;
                    $audioPath = $melodydetails[$i]["sampleAudioSrc"];
                ?>
                    <div class="col-lg-3 py-3   col-6 col-md-4  ">
                        <div class="row">
                            <div class="col-10 beatpackdiv py-lg-3 py-md-2 py-2 offset-1">
                                <div class="row">
                                    <div class="col-12 audiopreviewdiv">
                                        <audio id="audio<?php echo $melodyID ?>" class="audiopreview">
                                            <source src="<?php echo $audioPath; ?>" type="audio/ogg">
                                            <source src="<?php echo $audioPath; ?>" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                        <img src="<?php echo  $imagePath; ?>" class="beatPACKIMAGE" alt="">
                                        <img id="playmusic<?php echo $melodyID ?>" onclick="playmusic('<?php echo $melodyID ?>');" class="playcolrols audiopreview" src="BrymoImages/play-button.png" alt="">
                                        <img id="pausemusic<?php echo $melodyID ?>" onclick="pausemusic('<?php echo $melodyID ?>');" class="playcolrols audiopreview d-none" src="BrymoImages/pause.png" alt="">


                                    </div>

                                    <div class="col-12 pt-2">
                                        <div class="row">
                                            <div class="col-6 pt-2 text-center">
                                                <span class="sampleName"><?php echo $melodyname; ?></span>
                                            </div>
                                            <div class="col-6 pt-2 text-center">
                                                <span class="sampleName text-danger"><?php echo $melodyprice; ?></span>
                                            </div>
                                            <div class="col-12  py-2 d-grid col-md-6 text-center">
                                                <button class="cartBTN py-lg-2 py-sm-1">Cart</button>
                                            </div>
                                            <div class="col-12  py-2 d-grid col-md-6 text-center">
                                                <button class="buyBTN py-lg-2 py-sm-1" onclick="viewbuy('<?php echo $melodyID ?>')">Buy</button>
                                            </div>
                                        </div>

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
        <?php
        if (isset($_POST["PG"]) && isset($_POST["SSTN"])) {
        ?>
            <div class="col-12 py-5 text-center navbuttons">
                <div class="row">
                    <div class="col-6 offset-3">
                        <div class="row">
                            <div class="col-2  text-center d-grid ">
                                <button id="prev" class=" nextButton" onclick="nextfunctiondrums('<?php echo $realreceivednumber  - 1; ?>','<?php echo $subsampletypenumber; ?>');">Prev</button>
                            </div>
                            <div class="col-8">
                                <?php
                                for ($i = 0; $i < $stopnumber; $i++) {
                                ?>
                                    <button id="prev" class=" nextButton" onclick="nextfunctiondrums('<?php echo ($i); ?>','<?php echo $subsampletypenumber; ?>');"><?php echo ($i ); ?></button>

                                <?php
                                }
                                ?>
                            </div>

                            <div class="col-2  text-center  d-grid">
                                <button id="next" class=" nextButton" onclick="nextfunctiondrums('<?php echo $realreceivednumber  + 1; ?>','<?php echo $subsampletypenumber; ?>');"><?php echo  $realreceivednumber ; ?></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <?php
        } else {
        ?>
            <div class="col-12 py-5 text-center navbuttons">
                <div class="row">
                    <div class="col-6 offset-3">
                        <div class="row">
                            <div class="col-2  text-center  d-grid ">
                                <button id="prev" class=" nextButton" onclick="nextfunctiondrums('<?php echo $realreceivednumber  - 1; ?>',null);"><?php echo $realreceivednumber -1; ?></button>
                            </div>
                            <div class="col-8">
                                <?php
                                for ($i = 0; $i < $stopnumber; $i++) {
                                ?>
                                    <button id="prev" class=" nextButton" onclick="nextfunctiondrums('<?php echo ($i); ?>',null);"><?php echo ($i ); ?></button>

                                <?php
                                }
                                ?>
                            </div>

                            <div class="col-2  text-center  d-grid">
                                <button id="next" class=" nextButton" onclick="nextfunctiondrums('<?php echo $realreceivednumber  + 1; ?>',null);"><?php echo $realreceivednumber  + 1; ?></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php
        }
        ?>

    </div>

<?php
}
?>