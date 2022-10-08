<?php
require "DB.php";

class SearchClass
{
    public $searchqueryinput;
    public $fetchrows;
    public $numrows;
    public $fetcharray;
    function search()
    {
        $commonsearch = $this->searchqueryinput;
        $searchnumrows = $commonsearch->num_rows;
        if ($searchnumrows >= 1) {
            for ($i = 0; $i < $searchnumrows; $i++) {
                $this->fetcharray[$i] = $this->fetchrows = $commonsearch->fetch_assoc();
            }
        }
        $this->numrows = $searchnumrows;
    }

    function returnfetch()
    {
        return $this->fetchrows;
    }
    function returnrows()
    {
        return $this->numrows;
    }
    function returnarrays()
    {
        return $this->fetcharray;
    }
}
//searchquery from DBclass
$mysearchquery = DB::forsearch("SELECT * FROM `samples`;");
//create SerchClassObject
$searchobject = new SearchClass();
//store the query in SearchClassObject's instance variable $searchqueryinput
$searchobject->searchqueryinput = $mysearchquery;
/*call the searchmethod so it will get the num of rows and fetch the result, assigned the 
associative array to the instance variable $fetchrows */
$searchobject->search();
//by calling the returnfetch function it would return the associative array.
$fetchedresults = $searchobject->returnfetch();
//got the num of rows by calling the returnrows() function
$serachfinalrows = $searchobject->returnrows();
$searchedarrays = $searchobject->returnarrays();
// print_r($searchedarrays);
// echo "<br/>";
// echo "<br/>";
// print_r($searchedarrays[0]);
// echo "<br/>";
// echo "<br/>";
// print_r($searchedarrays[1]);
// $firstrow = $searchedarrays[1];
// echo $firstrow['Sample_Name'];
// echo "<br/>";
// echo "<br/>";
// echo "<br/>";
// echo "<br/>";
$arrsize = count($searchedarrays);

for ($i = 0; $i < $arrsize; $i++) {
    echo $searchedarrays[$i]['Sample_Name'];
    echo "<br/>";
    echo "<br/>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>