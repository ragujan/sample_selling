<?php
class DB
{

    public static $dbms;
    public static $dbms1;
    public static function common()
    {
        if (!isset(DB::$dbms)) {
            DB::$dbms = new mysqli("localhost", "root", "ragJN100Mania", "sampleselling", "3306");
        }
    }


    public static function insert($q)
    {
        DB::common();
        DB::$dbms->query($q);
    }
    public static function delete($q)
    {
        DB::common();
        DB::$dbms->query($q);
    }
    public static function forsearch($q)
    {
        DB::common();
        $resultset = DB::$dbms->query($q);
        return $resultset;
    }
    public static function forsearch1($q)
    {
        DB::common();
        $resultset = DB::$dbms->prepare($q);
        return $resultset;
    }
}
DB::common();


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
            $this->numrows = $searchnumrows;
            return $this->fetcharray;
        }else{
            $this->fetcharray=array("Nothing");
            return $this->fetcharray;
        }
      
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

// $mysearchquery = DB::forsearch("SELECT * FROM `samples`;");
// $searchobject = new SearchClass();
// $searchobject->searchqueryinput = $mysearchquery;
// $searchobject->search();
// $fetchedresults = $searchobject->returnfetch();
// $serachfinalrows = $searchobject->returnrows();
// $searchedarrays = $searchobject->returnarrays();
// $arrsize = count($searchedarrays);
// for ($i = 0; $i < $arrsize; $i++) {
//     echo $searchedarrays[$i]['Sample_Name'];
//     echo "<br/>";
//     echo "<br/>";
// }

class Pagination extends SearchClass
{
    public $pIndex;
    public $resultsperpage;
    public $getnumber;
    public $stopnumber;
    public $realreceivednumber;

    public function getNumber($n)
    {
        $this->getnumber = $n;
        return $this->getnumber;
    }

    public function decidesPages($rn)
    {
        $receivednumber = $rn;
        $this->resultsperpage = 8;
        $this->stopnumber = ceil($this->getnumber / $this->resultsperpage);
        
        if ($receivednumber <= 0) {
            $receivednumber = 0;
            $pagenumber = ($receivednumber) * 8;
        } else if ($receivednumber >=  $this->stopnumber) {
            //$pagenumber = (( $this->stopnumber-1 ) * 1);
            $st= $this->stopnumber;
            $pagenumber = ($st-1)*8;
           // $receivednumber =  $this->stopnumber - 1;
        } else {
            
            $pagenumber = ($receivednumber) * 8;
        }
        $this->realreceivednumber = $receivednumber;
        return $pagenumber;
    }

    public function searchQuery($i)
    {
    }
    public function returnRealReceiveNumber(){
        return $this -> realreceivednumber ;
    }

    public function returnStopNumber(){
        return  $this->stopnumber;
    }
}