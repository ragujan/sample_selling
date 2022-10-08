<?php

// if(isset($_POST["ID"])){
//     $ID=$_POST["ID"];
//     DB::insert("INSERT INTO usercart (`sampleID`,`qty`) VALUES ('".$ID."','1') ;");
// //     $mysearchquery = DB::forsearch("SELECT * FROM `samples`;");
// // $searchobject = new SearchClass();
// // $searchobject->searchqueryinput = $mysearchquery;
// // $searchedarrays = $searchobject->search();
// // $arrsize = count($searchedarrays);
// }


$count =count($_POST);
for($i=1;$i<=$count;$i++){
   echo $_POST[$i];
   echo "</br>";

}