<?php

if (!isset($_SESSION["userEmail"])) {
?>
    <div style="height: 70px;" class="col-12   navbarMainDivHolder ">
        <div class="row ">
            <div class="py-0 col-lg-1  col-md-9 col-7 text-md-start  text-start my-auto">
                <img src="../resources/icon_images/logo_transparent.png " class=" navbarImage p-0" alt="">
            </div>

            <div class="py-0 col-lg-9 d-none d-lg-block col-md-9 col-8 offset-0  my-auto">
                <div class="row">
                    <div class="col-3 text-center"><a href="../home/home.php" class="   text-white navLinkTexts  text-decoration-none">Home</a></div>
                    <div class="col-3 text-center"><a href="../products/audio_samples/sampleselling.php" class="  text-white navLinkTexts  text-decoration-none">Samples & Drum Kits</a></div>
                    <div class="col-3 text-center"><a href="../midiFiles/sample.php" class="  text-white navLinkTexts  text-decoration-none">Midi Packs</a></div>
                    <div class="col-3 text-center"><a href="" class="  text-white navLinkTexts  text-decoration-none">Contact & Services</a></div>
                </div>
            </div>
            <div class="py-0 col-lg-2  offset-lg-0 text-lg-end  my-auto col-md-3 col-5 offset-0   cartNCustomerDiv">
                <div class="row">
                    <div id="cartItemsDiv" style="position: relative;" class="col-lg-8 col-5  text-end">
                        <img src="../resources/icons/cartBag.png" alt="">
                        <span id="cartItems" class="cartQtyRowCount px-2">0</span>
                    </div>
                    <div id="userButton" class="col-lg-4 col-4 text-end ">
                        <img src="../resources/icons/user.png" alt="">
                    </div>
                    <div id="burgerMenu" class="col-lg-4 col-3 d-md-block d-lg-none  text-end ">
                        <img src="../resources/icons/burderMenu.png" alt="">
                    </div>
         
                </div>
            </div>
        </div>
    </div>

    <div id="navBarVertical" style="margin-top: 65px;z-index: 2000;" class="col-12   colorBlack  d-none text-center navBarVertical">
        <div class="row">
            <div class="py-1 d-block d-lg-none  col-12 offset-0  my-auto">
                <div class="row">
                    <div class="col-10 offset-1 text-center py-3"><a href="../home/home.php" class="   text-white navLinkTexts  text-decoration-none">Home</a></div>
                    <div class="col-10 offset-1 text-center py-3"><a href="../products/audio_samples/sampleselling.php" class="  text-white navLinkTexts  text-decoration-none">Samples & Drum Kits</a></div>
                    <div class="col-10 offset-1 text-center py-3"><a href="../midiFiles/sample.php" class="  text-white navLinkTexts  text-decoration-none">Midi Packs</a></div>
                    <div class="col-10 offset-1 text-center py-3"><a href="" class="  text-white navLinkTexts  text-decoration-none">Contact & Services</a></div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div style="height: 70px;" class="col-12   navbarMainDivHolder ">
        <div class="row ">
            <div class="py-0 col-lg-1  col-md-9 col-7 text-md-start  text-start my-auto">
                <img src="../RagImages/RAG JNTransparent.png " class=" navbarImage p-0" alt="">
            </div>

            <div class="py-0 col-lg-9 d-none d-lg-block col-md-9 col-8 offset-0  my-auto">
                <div class="row">
                    <div class="col-3 text-center"><a href="../home/home.php" class="   text-white navLinkTexts  text-decoration-none">Home</a></div>
                    <div class="col-3 text-center"><a href="../showsamples/sampleselling.php" class="  text-white navLinkTexts  text-decoration-none">Samples & Drum Kits</a></div>
                    <div class="col-3 text-center"><a href="../midiFiles/sample.php" class="  text-white navLinkTexts  text-decoration-none">Midi Packs</a></div>
                    <div class="col-3 text-center"><a href="" class="  text-white navLinkTexts  text-decoration-none">Contact & Services</a></div>
                </div>
            </div>
            <div style="position: relative;" class="py-0 col-lg-2   offset-lg-0 text-lg-end  my-auto col-md-3 col-5 offset-0   cartNCustomerDiv">
                <div class="row">
                    <div id="cartItemsDiv" style="position: relative;" class="col-lg-8 col-5  text-end">
                        <img src="../icons/cartBag.png" alt="">
                        <span id="cartItems" class="cartQtyRowCount px-2">4</span>
                    </div>
                    <div id="userButtonSignUp" class=" col-lg-4 col-4 text-end ">
                        <div class="row">
                            <div class="col-12 ">
                                <img src="../icons/user.png" alt="">
                            </div>
                        </div>

                    </div>

                    <div id="burgerMenu" class="col-lg-4 col-3 d-md-block d-lg-none  text-end ">
                        <img src="../icons/burderMenu.png" alt="">
                    </div>

                    <div style="position: absolute;z-index: 25;margin-top: 50px;" id="userOptions" class=" text-start userOptions col-12   d-none">
                        <div class="row">
                            <div class="col-12">
                                <ul type="none" class="userOptionsUL" style="cursor: pointer;">
                                    <li><a style="text-decoration: none;" href="../userAccount/userAccount.php">User Account</a></li>
                                    <li><a style="text-decoration: none;" href="../viewcart/viewcart.php">My Cart</a></li>
                                    <li><a style="text-decoration: none;" href="../userProcess/unsetUserEmail.php">Log Out</a></li>


                                </ul>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>

        </div>
    </div>

    <div id="navBarVertical" style="margin-top: 65px;z-index: 899;" class="col-12   colorBlack  d-none text-center navBarVertical">
        <div class="row">
            <div class="py-1 d-block d-lg-none  col-12 offset-0  my-auto">
                <div class="row">
                    <div class="col-10 offset-1 text-center py-3"><a href="../home/home.php" class="   text-white navLinkTexts  text-decoration-none">Home</a></div>
                    <div class="col-10 offset-1 text-center py-3"><a href="../showsamples/sampleselling.php" class="  text-white navLinkTexts  text-decoration-none">Samples & Drum Kits</a></div>
                    <div class="col-10 offset-1 text-center py-3"><a href="../midiFiles/sample.php" class="  text-white navLinkTexts  text-decoration-none">Midi Packs</a></div>
                    <div class="col-10 offset-1 text-center py-3"><a href="" class="  text-white navLinkTexts  text-decoration-none">Contact & Services</a></div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>
    <script src="../siteHeader/header.js"></script>
<?php
?>