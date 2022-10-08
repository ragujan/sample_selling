<?php
require "DB.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Document</title>
</head>

<body>
    <div class="col-lg-11 col-md-10 col-9 text-start">
        <div class="row">


            <?php

            $mysearchquery = DB::forsearch("SELECT * FROM `samples` 
            INNER JOIN `subsampletype`
            ON subsampletype.subsampleID = samples.SubsampleID
            INNER JOIN `sampletype`
            ON sampletype.sampleTypeID =subsampletype.sampleTypeID");
            $searchobject = new SearchClass();
            $searchobject->searchqueryinput = $mysearchquery;
            $searchedarrays = $searchobject->search();
            $arrsize = count($searchedarrays);
            for ($i = 0; $i < $arrsize; $i++) {
                $sampleName = $searchedarrays[$i]['Sample_Name'];
                $sampleID = $searchedarrays[$i]['sampleID'];
                $sampletype =$searchedarrays[$i]['typeName'];
            ?>
                <div class="col-8 offset-2">
                    <div class="row">

                        <div class="col-4">
                            <h1><?php echo $sampleName ?></h1>
                        </div>
                        <div class="col-4">
                            <h1><?php echo $sampleID." ".$sampletype; ?></h1>
                        </div>
                        <div class="col-4"><button id="del<?php echo $sampleID ?>" onclick="deletesample(<?php echo $sampleID ?>)">Delete</button></div>
                    </div>
                </div>
            <?php
            }


            ?>



        </div>
    </div>
    <script src="deletefiles.js"></script>
</body>

</html>