<?php
class PaginatedQuery{

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

require "DB.php";
$pagenumber;
if (isset($_POST["PG"])) {
    $predictnumofrows = DB::forsearch("SELECT * FROM subsampletype INNER JOIN samples ON samples.SubsampleID=subsampletype.subsampleID WHERE subsampletype.sampleTypeID='1';");
    $numofrows = $predictnumofrows->num_rows;
    $receivednumber = $_POST["PG"];
    
    $stopnumber = ceil($numofrows / 8);
    if ($receivednumber <= 0) {
        $receivednumber = 0;
        $pagenumber = ($receivednumber) * 8;
    } else if ($receivednumber >= $stopnumber) {
        $pagenumber = (($stopnumber - 1) * 8);
        $receivednumber = $stopnumber - 1;
    } else {
        $pagenumber = ($receivednumber) * 8;
    }
    
} else {
    $receivednumber = 0;
    $pagenumber = $receivednumber;
}
$resultsperpage = 8;

?>