<?php

class Search
{

    function getData($table, $concell, $value)
    {
        if (empty($concell)) {
            $searchquery = DB::forsearch("SELECT * FROM $table; ");
        } else {
            $searchquery = DB::forsearch("SELECT * FROM `$table` WHERE $concell='" . $value . "'; ");
        }
        $getrows = $searchquery->num_rows;
        if ($getrows >= 1) {
            for ($i = 0; $i < $getrows; $i++) {
            }
        }
    }
    function limitsearch($tablename, $concell, $value)
    {
        if (($concell == "null")) {

            $searchquery = DB::forsearch("SELECT * FROM  {$tablename} LIMIT 0,3; ");
        } else {
            $searchquery = DB::forsearch("SELECT * FROM {$tablename} WHERE $concell='" . $value . "' LIMIT 3; ");
        }
        $getrows = $searchquery->num_rows;
        echo "Number of rows is"." ".$getrows;
        if ($getrows >= 1) {
            for ($i = 0; $i < $getrows; $i++) {



                $melodydetails = $searchquery->fetch_assoc();
                $melodyname = $melodydetails["Sample_Name"];
                $melodyprice = $melodydetails["SamplePrice"];
                $melodyID = $melodydetails["sampleID"];
                $getImage = DB::forsearch("SELECT * FROM `sampleimages` WHERE `sampleID`='" . $melodyID . "' ;");
                $getImagepath = $getImage->fetch_assoc();
                $imagePath = $getImagepath["source_URL"];
                $getaudio = DB::forsearch("SELECT * FROM `sampleaudio` WHERE `sampleID`='" . $melodyID . "' ;");
                $getaudiopathrow = $getaudio->fetch_assoc();
                $audioPath = $getaudiopathrow["sampleAudioSrc"];
?>
                <div class="col-lg-4 py-3   col-4 col-md-4 ">
                    <div class="row">
                        <div class="col-12 col-md-10 offset-md-1 beatpackdiv py-lg-3 py-md-2 py-1 offset-0">
                            <div class="row">
                                <div class="col-12 audiopreviewdiv">
                                    <img src="../BrymoImages/BeatpackImage.png" class="beatPACKIMAGE mostsold" alt="">


                                </div>

                                <div class="col-12 pt-2">
                                    <div class="row">
                                        <div class="col-12 pt-2 text-center">
                                            <span class="sampleName "><?php echo $melodyname; ?></span>
                                        </div>
                                   
   
                                        <div class="col-12  pt-2 d-grid  text-center">
                                            <button class="buyBTN py-lg-2 py-sm-1">View</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
<?php

            }
        }
    }
}

?>