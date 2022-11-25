<?php
 $ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, 'http://i.imgur.com/wtQ6yZR.gif');

 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

 $contents = curl_exec($ch);

 echo $contents;