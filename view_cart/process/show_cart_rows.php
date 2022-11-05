<?php
echo "boo boob";
if ($_POST["cartArrays"] && !empty($_POST["cartArrays"]) && isset($_POST["cartArrays"])) {
    require "../query/Sample_query_functions.php";
    $object = new Sample_query_functions();
    $a  = $_POST["cartArrays"];
    print_r($a);
    echo "<br>";
  echo "oiojjsdf";
    $b = json_decode($a);
    // print_r($b[0]);
    // if($b[0]->id == "Nope"){
    //     echo "Nothing to show";
    //     return;
    // }
    $idQtyArray = [];
    $productCount = 0;
    foreach ($b as $c) {
        if (intval($c->id) && ($c->id) != 0 && ($c->qty) != 0 && intval($c->qty)) {
            $id = $c->id;
            $qty = $c->qty;
            $count = $object->checkCartrows($id);
            if ($count == 1) {

                $rowArray = $object->showCartRows($id);
                
          
                
                $productuniqueid = $rowArray[0]["UniqueId"];
                $rowArray = $rowArray[0];
                $sPrice =  $rowArray["SamplePrice"];
               

?>
                <div class="col-lg-10 offset-lg-1  py-lg-2 py-3">
                    <div class="row  cartRowsIndi">
                        <div class="col-lg-2 col-2 py-2   cartRowSampleImage text-center">
                            <img class="p-0 m-0" src="<?php echo $rowArray["source_URL"]; ?>" alt="">
                        </div>
                        <div class="col-lg-10 col-10 py-2">
                            <div class="row">
                                <div class="col-lg-3 col-4 ">
                                    <div class="row">
                                        <div class="col-12 ">
                                            <h6 ><?php echo $rowArray["Sample_Name"]; ?></h6>
                                            
                                            <input type="text" hidden name="uniqueId[<?php echo $productCount; ?>]"  value="<?php echo $productuniqueid; ?>" class="text-body   py-1 bg-white text-dark px-lg-2 px-2 fw-bold" >
                                        </div>
                                        <div class="col-12 ">
                                            <a onclick="removeFromCart(<?php echo $id; ?>)">remove</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-3 cartRowPriceDiv ">

                                    <h6>$ <?php echo $rowArray["SamplePrice"]; ?></h6>

                                </div>
                                <div class="col-lg-2 col-2 text-center  cartRowInputDiv">
                            
                                      
                    

                                    <input type="number"  name="qty[<?php echo $productCount; ?>]" class="text-body   py-1 bg-white text-dark px-lg-2 px-2 fw-bold" id="cartQtyId<?php echo $id; ?>" onchange="newQtySelect(<?php echo $id; ?>,<?php echo $sPrice; ?>);" value="<?php echo $qty; ?>">
                                </div>

                                <div class="col-lg-3 col-3 cartAmountPriceDiv">

                                    <span style="display: flex;flex-direction: row;align-items: center;">$ <h6 id="qtyAndSamplePrice<?php echo $id; ?>" class="my-0"> <?php echo $rowArray["SamplePrice"] * $qty; ?></h6></span>

                                </div>
                            </div>
                        </div>



                    </div>
                </div>
<?php
$productCount++;
            } else {
                echo "Nope";
            }
        }
    }
}
