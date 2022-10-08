<?php
session_start();
if(isset($_SESSION["verifyForgotPasswordEmail"])){
    unset($_SESSION["verifyForgotPasswordEmail"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/forgotPassword.css">

    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div id="signInOnly" class="col-12 signInOnly py-5">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 class="fw-bold">FORGOT PASSWORD</h3>
                        </div>
                        <div class="col-md-4 offset-md-4 col-8 offset-2">
                            <div class="row">
                                <div class="col-12 py-3 ">
                                    <div class="row">
                                        <div class="col-12 text-start">
                                            <span class=" ms-0  ">Email</span>
                                        </div>
                                        <div class="col-12 text-start  " id="errorMessage">
                                            <span  class=" ms-0   text-danger"></span>
                                        </div>
                                        <div class="col-12">
                                            <input id="inputFieldsEmail" class="w-100 py-2 px-2 inputFieldsEmail" type="Email">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 pt-1 pb-1 ">
                                    <div class="row">

                                        <div class="col-8 offset-2 pb-4 pt-2">
                                            <button onclick="forgotPassword();" class="w-100 logInButton py-2">Send Code To This Email</button>
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
    <script src="userProcess.js"></script>
</body>

</html>