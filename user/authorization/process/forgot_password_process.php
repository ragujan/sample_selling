<?php
// print_r(str_replace("userProcess","",__DIR__). 'vendor/autoload.php');

// require str_replace("userProcess","",__DIR__). 'vendor/autoload.php';
require "../vendor/autoload.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST["I"]) && !empty($_POST["I"])) {

    $E = $_POST["I"];
   
    if (filter_var($E, FILTER_VALIDATE_EMAIL)) {
        require "../query/User.php";
        $checkUser = new User();
        $emailExists = $checkUser->checkEmail($E);
        if ($emailExists) {
            date_default_timezone_set('Asia/Colombo');
            if (date_default_timezone_get()) {
               
               $currentTimeandDate= date("Y-m-d h:i:s");
            }
            $random = rand();
            $P = hash('md5', $random);
            $updatePasswordForVerification = $checkUser->updatePasswordForVerification($E, $P,$currentTimeandDate);
            
            if ($updatePasswordForVerification) {
                $email = "needtoknoweverything631@gmail.com";
                $sendersEmail = $E;

                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = $email;                     //SMTP username
                    $mail->Password   = 'blahblahblackshp';                               //SMTP password
                    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


                    $mail->setFrom($email, 'Politics');

                    $mail->addAddress($sendersEmail);
                    $mail->addReplyTo($email, 'Politics');
                    $mail->addCC('cc@example.com');
                    $mail->addBCC('bcc@example.com');


                    $mail->isHTML(true);
                    $mail->Subject = 'Your Verification Code From RagSamples';
                    $mail->Body    = $P;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    session_start();
                    $_SESSION["userEmail"] = $E;
                    exit("Success");
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }else{
                echo "Please try later";
                exit();  
            }
        } else {
            echo "This email is not a registered one";
        }
    } else {
        echo "Not a Valid Email";
        exit();
    }

    // require "../PDOPHP/queryFunctions.php";
    // require "../userProcess/UserInputValidation.php";
    // $validateEmail =new UserinputValidation();
    // $validateEmail->checkEmail($_POST["I"]);

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;



    // require '../vendor/phpmailer/';
    // require '../phpMailer2/PHPMailer.php';
    // require '../phpMailer2/SMTP.php';




    //Load Composer's autoloader

} else {
    echo "Email Field shouldn't be empty";
    exit();
}
