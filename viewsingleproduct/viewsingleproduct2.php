<?php
require "../DB/DB.php";
$sampleID = $_GET["X"];
$mysearchquery = DB::forsearch("SELECT * FROM `samples` INNER JOIN `sampleimages` 
ON sampleImages.sampleID=samples.sampleID
INNER JOIN `subsampletype`
ON subsampletype.subsampleID=samples.SubsampleID
WHERE samples.sampleID='" . $sampleID . "'  ;");
$searchobject = new SearchClass();
$searchobject->searchqueryinput = $mysearchquery;
$searchobject->search();
$fetchedresults = $searchobject->returnfetch();
$serachfinalrows = $searchobject->returnrows();
$searchedarrays = $searchobject->returnarrays();
$arrsize = count($searchedarrays);
$sampleRow = $searchedarrays[0];
$sampleName = $sampleRow["Sample_Name"];
$samplePrice = $sampleRow["SamplePrice"];
$imagePath = $sampleRow["source_URL"];
$sampleType = $sampleRow["subsampleName"];
$sampleDescription = $sampleRow["SampleDescription"];
$sampleArray = array('ID' => $sampleID, 'name' => $sampleName, 'price' => $samplePrice, 'image' => $imagePath);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ssss, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/sampleselling.css">
    <link rel="stylesheet" href="viewsingleproduct.css">
     <link rel="stylesheet" href="../style/navbar.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12 ">
                    <div class="row">
                         <?php
                require "../siteHeader/header.php"
                         ?>
<div class="d-none" id="cartItems"></div>
                        <div class="col-12  ">
                            <div class="row">
                                <div class="text-white col-12 text-center">

                                </div>
                            </div>
                        </div>
                        <div class="col-12 py-5   thesingleproductcontentdiv">
                            <div class="row ">
                          
                                <div class="col-lg-6 col-md-6   py-4 sampleInfoDIV bg-danger">
                                    <div class="row">
                                        <div class="col-10 offset-1">
                                            <div class="row">
                                                <div class="col-12 pt-5">
                                                    <h1 class="sampleheaddiv  px-0 pt-4 pb-0 "> <?php echo $sampleName; ?>
                                                    </h1>

                                                </div>
                                                <div class="col-12 ">
                                                    <div class="py-1" id="borderLeft"></div>
                                                </div>
                                                <div class="col-12 py-4">
                                                    <h5 class="sampledescription"><?php echo $sampleDescription; ?></h5>
                                                </div>
                                                <div class="col-6 pt-2 pb-3 ">
                                                    <h3 class="fw-bolder">Price : $<?php echo $samplePrice ?></h3>
                                                </div>
                                                <div class="col-6 pt-2 pb-3 ">
                                                    <input type="number" id="selectQTY" class="p-2 bg-dark w-100">
                                                </div>
                                                <div class="col-12 pt-lg-1 pt-1 pb-5 pt-md-3">
                                                    <div class="row gy-3 gy-md-1">
                                                        <div class="col-md-6 offset-md-0 col-12 d-grid ">

                                                            <button class="cartButton" onclick="newAddtoCart(<?php echo $sampleID; ?>);"> Cart </button>
                                                        </div>
                                                        <div class="col-md-6 offset-md-0 col-12 d-grid ">
                                                            <button class="buyButton" onclick="goToviewCart(<?php echo $sampleID; ?>);" >Buy</button>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>


                        </div>
                        <div class="col-6 thefooterdiv">
                            <div class="row">
                                <div class="col-12 text-center pt-4">
                                    <h1 class="cardinfo">We accept</h1>
                                </div>
                                <div class="col-12 py-5">
                                    <div class="row">
                                        <div class="col text-center">
                                            <img src="../paymentMethods/1.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="../paymentMethods/2.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="../paymentMethods/3.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="../paymentMethods/4.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="../paymentMethods/5.png" class="paymentmethods" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-6 thefooterdiv">
                            <div class="row">
                                <div class="col-12 text-center pt-4">
                                    <h1 class="cardinfo">We accept</h1>
                                </div>
                                <div class="col-12 py-5">
                                    <div class="row">
                                        <div class="col text-center">
                                            <img src="../paymentMethods/1.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="../paymentMethods/2.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="../paymentMethods/3.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="../paymentMethods/4.png" class="paymentmethods" alt="">
                                        </div>
                                        <div class="col text-center">
                                            <img src="../paymentMethods/5.png" class="paymentmethods" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="viewsingleproduct.js"></script>
    <script src="cart.js"></script>
</body>

</html>