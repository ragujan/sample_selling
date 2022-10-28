<?php
$pageName = str_replace( array( '.php' ), '', basename(__FILE__));
echo $pageName;

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
    
<script  src="server_side.js"></script>
<script src="next.js"></script>
</body>
</html>