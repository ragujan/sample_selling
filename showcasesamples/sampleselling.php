<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="sampleselling.css">
    <title>BeatSample</title>
</head>

<body>



    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="maindiv col-12">
                    <div class="row">
                        <div class="col-12 py-3">
                            <div class="row">
                                <div class="col-4 text-center py-2">
                                    <a href="#"> <img class="sitelogo" src="../RagImages/RAG JN.png" alt="">
                                    </a>
                                </div>

                                <div class="py-2 col-6">
                                    <div class="row">
                                        <div class="col-8 text-center col-lg-6 fs-5 offset-2 fw-light offset-lg-3 my-2">
                                            <div class="row">
                                                <div class="col-4 navlinksdiv"><a class="navlinks text-decoration-none " href="home.php">Home</a></div>
                                                <div class="col-4 navlinksdiv"><a class="navlinks text-decoration-none" href="sampleselling.php">Samples</a></div>
                                                <div class="col-4 navlinksdiv"><a class="navlinks text-decoration-none" href="#">Contact</a></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="py-2 col-2">
                                    <div class="row">
                                        <div class="col-6  my-2 fs-4">
                                            <a href="#"> <i class="text-white bi bi-bag"></i></a>

                                        </div>
                                        <div class="col-6 my-2 fs-4">
                                            <a href="#" class=""> <i class="text-white bag2 bi bi-person-check"></i></a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="thecontentdiv  col-12">
                            <div class="row">
                                <div class="col-12  text-center">
                                    <h1 class="sampleheading text-white">Samples & Drums</h1>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr class="HRTAG">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-1 col-md-2 col-3 py-2">
                                                            <span>Filter By</span>
                                                        </div>
                                                        <div class="col-lg-11 col-md-10 col-9 text-start">
                                                            <select name="" onchange="showsubsamples();" class="selectTAG py-2 px-1" id="subSampleMelodyID">
                                                                <?php
                                                                require "../DB/DB.php";
                                                                $mysearchquery = DB::forsearch("SELECT * FROM `subsampletype` WHERE `sampleTypeID` IN(SELECT `sampleTypeID` FROM `sampletype` WHERE `typeName`='Melodies');");
                                                                $searchobject = new SearchClass();
                                                                $searchobject->searchqueryinput = $mysearchquery;
                                                                $searchobject->search();
                                                                $fetchedresults = $searchobject->returnfetch();
                                                                $serachfinalrows = $searchobject->returnrows();
                                                                $searchedarrays = $searchobject->returnarrays();
                                                                $arrsize = count($searchedarrays);
                                                                if ($searchedarrays[0] == "Nothing") {
                                                                ?>
                                                                    <option value="All" class="text-white"> NOPE</option>
                                                                <?php

                                                                } else {
                                                                ?>
                                                                    <option class="text-white"> ALL</option>
                                                                    <?php
                                                                    for ($i = 0; $i < $arrsize; $i++) {
                                                                        $sampleName = $searchedarrays[$i]['subsampleName'];
                                                                        $sampleID = $searchedarrays[$i]['subsampleID'];
                                                                        echo "<br/>";
                                                                        echo "<br/>";
                                                                    ?>
                                                                        <option value="<?php echo $sampleID; ?>" class="text-white"> <?php echo $sampleName ?></option>
                                                                <?php
                                                                    }
                                                                }



                                                                ?>



                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div id="showmelodysamples" class="col-12 py-5">

                                        </div>


                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr class="HRTAG">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-1 col-md-2 col-3 py-2">
                                                            <span>Filter By</span>
                                                        </div>
                                                        <div class="col-lg-11 col-md-10 col-9 text-start">
                                                            <select name="" onchange="showsubsamplesdrums();" class="selectTAG py-2 px-1" id="subSampleDrumID">
                                                                <?php

                                                                $mysearchquery = DB::forsearch("SELECT * FROM `subsampletype` WHERE `sampleTypeID` IN(SELECT `sampleTypeID` FROM `sampletype` WHERE `typeName`='Drums');");
                                                                $searchobject = new SearchClass();
                                                                $searchobject->searchqueryinput = $mysearchquery;
                                                                $searchedarrays = $searchobject->search();
                                                                $arrsize = count($searchedarrays);
                                                                if ($searchedarrays[0] == "Nothing") {
                                                                ?>
                                                                    <option class="text-white"> NOPE</option>
                                                                <?php

                                                                } else {
                                                                ?>
                                                                    <option value="ALL" class="text-white"> All</option>
                                                                    <?php
                                                                    for ($i = 0; $i < $arrsize; $i++) {
                                                                        $sampleName = $searchedarrays[$i]['subsampleName'];
                                                                        $sampleID = $searchedarrays[$i]['subsampleID'];
                                                                        echo "<br/>";
                                                                        echo "<br/>";
                                                                    ?>
                                                                        <option value="<?php echo $sampleID; ?>" class="text-white"> <?php echo $sampleName; ?></option>
                                                                <?php
                                                                    }
                                                                }



                                                                ?>



                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" id="showdrumsamples">

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="sampleselling.js"></script>
</body>

</html>