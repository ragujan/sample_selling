<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class Search extends Db
{

    function limitsearch()
    {
        $searchquery = "SELECT SUM(qty),customer_purchase_history.sampleID,unique_id,CustomerID,dnt,customer_email,source_URL,SamplePrice,Sample_Name 
FROM customer_purchase_history
INNER JOIN sampleimages 
ON sampleimages.sampleID = customer_purchase_history.sampleID
INNER JOIN samples
ON samples.sampleID = customer_purchase_history.sampleID
GROUP BY sampleID  ORDER BY qty  DESC LIMIT 3 ";
        $statement = $this->connect()->prepare($searchquery);
        $statement->execute([]);
        $resultset = $statement->fetchAll();
        $getrows = count($resultset);

        if ($getrows >= 1) {
            for ($i = 0; $i < $getrows; $i++) {



                $melodydetails = $resultset[0];
                $melodyname = $melodydetails["Sample_Name"];
                $melodyID = $melodydetails["sampleID"];
                $imagePath = $melodydetails["source_URL"];




?>
                <div class="col-lg-4 py-3   col-4 col-md-4 ">
                    <div class="row">
                        <div class="col-12 col-md-10 offset-md-1 beatpackdiv py-lg-3 py-md-2 py-1 offset-0">
                            <div class="row">
                                <div class="col-12 audiopreviewdiv">
                                    <img src="<?php echo $imagePath; ?>" class="beatPACKIMAGE mostsold" alt="">


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