<?php
echo 'User IP - '.$_SERVER['REMOTE_ADDR'];
date_default_timezone_set('Asia/Colombo');
$fiexedDate =strtotime("2022-04-22 18:00:00");

if (date_default_timezone_get()) {
    echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
    echo "The time is " . date("Y-m-d h:i:s");
    $strTime =strtotime(date("Y-m-d h:i:s"));
    echo '<br/>'.$strTime-$fiexedDate.'<br/>';
}

?>