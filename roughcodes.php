<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="roughcodes.php">
        <input type="text" name="name[0]" value="rag6">
        <input type="text" name="name[1]" value="rag5">
        <input type="text" name="name[2]" value="rag4">
        <input type="text" name="name[3]" value="rag3">
        <input type="text" name="name[4]" value="rag2">
        <input type="text" name="name[5]" value="rag1">
        <button type="submit">submit</button>
    </form>
</body>

</html>
<?php
if (isset($_POST["name"])) {
//     print_r($_POST["name"]);
//     $url = 'abc333.php';
//     $postvars = http_build_query($_POST["name"]);

//     // open connection
//     $ch = curl_init();
    
//     // set the url, number of POST vars, POST data
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_POST, count($_POST["name"]));
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    
//     // execute post
//     $result = curl_exec($ch);
    
//     // close connection
//     curl_close($ch);

// //close connection
// curl_close($ch);
   $curl = curl_init();
   curl_setopt($curl,CURLOPT_URL,"C:\xampp\htdocs\sampleSelling-master\abc333.php");
   curl_exec($curl);
}

?>