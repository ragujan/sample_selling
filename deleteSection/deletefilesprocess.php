<?php
$ID = $_POST["ID"];

require "DB.php";
$mysearchquery = DB::forsearch("SELECT * FROM `samples` 
INNER JOIN `samplePath` ON
samplePath.sampleID = samples.sampleID
INNER JOIN `sampleimages` ON
sampleimages.sampleID = samples.sampleID
INNER JOIN `sampleaudio`
ON sampleaudio.sampleID = samples.sampleID

 WHERE samples.sampleID='".$ID."';");
$searchobject = new SearchClass();
$searchobject->searchqueryinput = $mysearchquery;
$searchedarrays = $searchobject->search();
$arrsize = count($searchedarrays);
$fileSource  = $searchedarrays[0]['samplePath'];
$audioSource = $searchedarrays[0]['sampleAudioSrc'];
$audioImage = $searchedarrays[0]['source_URL'];
echo $audioImage;
echo $audioSource;

unlink($fileSource);
unlink($audioImage);
unlink($audioSource);


DB::delete("DELETE FROM samplePath WHERE samplePath.sampleID='".$ID."'; ");
DB::delete("DELETE FROM sampleimages WHERE sampleimages.sampleID='".$ID."'; ");
DB::delete("DELETE FROM sampleaudio WHERE sampleaudio.sampleID='".$ID."'; ");
DB::delete("DELETE FROM samples WHERE samples.sampleID='".$ID."'; ");