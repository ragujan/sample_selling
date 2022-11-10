<?php
$pageName = str_replace( array( '.php' ), '', basename(__FILE__));
echo $pageName;
echo 'PHP version: ' . phpversion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="mydiv"></div>
    <form action="backend.php" method="post">
        <input type="text" name="HEY" value="RAGJN">
        <button type="submit">click</button>
    </form> 
    <select id="abc">
      <option value="abc">abc</option> 
      <option value="rag">rag</option>
    </select>
    <button onclick="clickFunction();">click</button>

    <input id="myfile" type="file" >

<script src="script.js"></script>
</body>
</html>