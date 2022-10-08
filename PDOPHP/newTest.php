<?php


require "./PageButtons.php";
require "./queryFunctions.php";
$object = new PageButtons();
$object->produceBtns(6, 5, 1,"nextFunctionMelody","melodySamples");

$query = new queryFunctions();
$pageNumbers = $query->searchByTextPages("");
$fetchResults = $query->searchByText("",0);
echo $pageNumbers;
echo "</br>";

echo count($fetchResults);
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";

for($i=0;$i<count($fetchResults);$i++){
    echo $fetchResults[$i]['sampleID'];
    echo "</br>";
}