<?php

$feedToGet = $deps[$index]->getFeedLink();
$feedText = $deps[$index]->getFeed();

$ch = curl_init($feedToGet);
$fp = fopen($feedText,"w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
if(curl_error($ch)) {
    fwrite($fp, curl_error($ch));
}
curl_close($ch);
fclose($fp);


?>