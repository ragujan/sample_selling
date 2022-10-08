<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap.css">
    <title>Document</title>
</head>

<body>

</body>

</html>

<?php
require "queryFunctions.php";
require "./PageButtons.php";

$object = new queryFunctions();

$melody = $object->sampleType(1, 12);

if (count($melody) == 0) {
    $melodydetails = $melody;
    
} else {
    for ($i = 0; $i < count($melody); $i++) {
        $melodydetails = $melody;
        $melodyname =  $melodydetails[$i]["Sample_Name"];
        $melodyprice =  $melodydetails[$i]["SamplePrice"];
        $melodyID =  $melodydetails[$i]["sampleID"];
        $imagePath =  $melodydetails[$i]["source_URL"];;
        $audioPath = $melodydetails[$i]["sampleAudioSrc"];
    }
}

class PageButtons22
{
    public function produceBtns($totalpages, $currentPage, $buttonPerPages)
    {
        $A = $currentPage;
        if (($A - 2) < 0) {
        } else {
?>
            <div class="col  text-center  d-grid ">
                <button id="prev" class=" nextButton" onclick="nextfunctionmelody('<?php echo ($A - 2); ?>',null);"><?php echo $A - 1; ?></button>
            </div>

        <?php
        }
        if (($A - 1) < 0) {
        } else {
        ?>

            <div class="col  text-center  d-grid ">
                <button id="prev" class=" nextButton" onclick="nextfunctionmelody('<?php echo ($A - 1); ?>',null);"><?php echo $A; ?></button>
            </div>
        <?php
        }
        ?>

        <div class="col  text-center  d-grid ">
            <button id="prev" class="bg-danger nextButton" onclick="nextfunctionmelody('<?php echo ($A); ?>',null);"><?php echo $A + 1; ?></button>
        </div>

        <?php
        if (($A + 1) >= $totalpages) {
        } else {
        ?>
            <div class="col  text-center  d-grid ">
                <button id="prev" class=" nextButton" onclick="nextfunctionmelody('<?php echo ($A + 1); ?>',null);"><?php echo $A + 2; ?></button>
            </div>

        <?php
        }
        if (($A + 2) >= $totalpages) {
        } else {
        ?>

            <div class="col  text-center  d-grid ">
                <button id="prev" class=" nextButton" onclick="nextfunctionmelody('<?php echo ($A + 2); ?>',null);"><?php echo $A + 3; ?></button>
            </div>
        <?php
        }
        ?>

<?php

    }
}


$P = new PageButtons();
$pageBtn = $P->produceBtns(6, 0, 3,"ragJn","ragJN");



