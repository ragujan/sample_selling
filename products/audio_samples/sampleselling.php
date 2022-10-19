<?php
session_start();
require "../query/Sample_query_functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.css">


        <link rel="stylesheet" href="../../style/sampleselling.css">
  
    <link rel="stylesheet" href="../../style/navbar.css">
    <title>BeatSample</title>
</head>

<body>

    <div id="loadingScreen" class=" d-none loadingScreenDiv">
        <div class="loadingThing"></div>
    </div>

    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="maindiv col-12">
                    <div class="row">
                        <div class="col-12 py-3 d-none">
                            <div class="row">
                                <div class="col-4 text-start py-2">
                                    <a href="#"> <img class="sitelogo" src="../RagImages/RAG JN.png" alt="">
                                    </a>
                                </div>

                                <div class="py-2 col-6">
                                    <div class="row">
                                        <div class="col-8 text-center col-lg-6 fs-5 offset-2 fw-light offset-lg-3 my-2">
                                            <div class="row">
                                                <div class="col-4 navlinksdiv"><a class="navlinks text-decoration-none " href="../home/home.php">Home</a></div>
                                                <div class="col-4 navlinksdiv"><a class="navlinks text-decoration-none" href="../showsamples/sampleselling.php">Samples</a></div>
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
                        <?php
                        require "../../siteHeader/header.php"
                        ?>



                        <div style="position: relative;" class="thecontentdiv  col-12 ">
                            <div class="row">
                                <div class="col-12 pt-4">
                                    <div class="row">
                                        <div class="col-lg-7 col-5 text-start   text-lg-end">
                                            <h1 class="sampleheading text-white">Samples & Drums</h1>
                                        </div>
                                        <div class="col-lg-4 col-7 text-start text-lg-end">

                                            <div class=" row">
                                                <div id="searchBoxDiv" class="col-lg-10 col-7  ">
                                                    <input id="searchBox" class="text-dark px-2 py-1 " type="text">
                                                </div>
                                                <div class="col-lg-2 col-5 text-lg-start text-center">
                                                    <img id="searchButton" class="searchIconImage" src="../resources/icons/search.png" alt="" srcset="">
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div id="mainsampleDiv" class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr class="HRTAG ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-1 col-md-2 col-3 py-2 text-center">
                                                            <span class="fs-5 fw-bolder">Filter By</span>
                                                        </div>
                                                        <div class="col-lg-11 col-md-10 col-9 text-start">
                                                            <select name="" onchange="showsubsamplesdrums();" class="selectTAG py-2 px-1" id="subSampleDrumID">
                                                                <?php
                                                              
                                                                $query_object = new Sample_query_functions();
                                                                $subsamples = $query_object->listSubSampleTypes("melodies");
                                                                $arrsize = count($subsamples);
                                                                if (!$subsamples > 0) {
                                                                ?>
                                                                    <option class="text-white"> NOPE</option>
                                                                <?php

                                                                } else {
                                                                ?>
                                                                    <option value="ALL" class="text-white"> All</option>
                                                                    <?php
                                                                    for ($i = 0; $i < $arrsize; $i++) {
                                                                        $sampleName = $subsamples[$i]['subsampleName'];
                                                                        $sampleID = $subsamples[$i]['subsampleID'];

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
                                        <div id="sampleTypeMelody" style="padding-left: 2.5%;padding-right: 2.5%;" class="col-12 pb-5 pt-3">

                                        </div>


                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr class="HRTAG">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-1 col-md-2 col-3 py-2 text-center">
                                                            <span class="fs-5 fw-bolder">Filter By</span>
                                                        </div>
                                                        <div class="col-lg-11 col-md-10 col-9 text-start">
                                                            <select name="" onchange="showsubsamplesdrums();" class="selectTAG py-2 px-1" id="subSampleDrumID">
                                                                <?php
         
                                                                $subsamples = $query_object->listSubSampleTypes("drums");
                                                                $arrsize = count($subsamples);
                                                                if (!$subsamples > 0) {
                                                                ?>
                                                                    <option class="text-white"> NOPE</option>
                                                                <?php

                                                                } else {
                                                                ?>
                                                                    <option value="ALL" class="text-white"> All</option>
                                                                    <?php
                                                                    for ($i = 0; $i < $arrsize; $i++) {
                                                                        $sampleName = $subsamples[$i]['subsampleName'];
                                                                        $sampleID = $subsamples[$i]['subsampleID'];

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
                                        <div class="col-12 " id="sampleTypeDrums">

                                        </div>

                                    </div>
                                </div>
                                <div id="bySearch" style="padding-left: 5%;padding-right: 5%;" class="col-12 py-5">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="newDivId"></div>
    <script src="script.js"></script>

</body>

</html>