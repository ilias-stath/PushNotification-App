<?php

$ch = curl_init("https://ece.uowm.gr/feed.php");
$fp = fopen("feed.txt","w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
if(curl_error($ch)) {
    fwrite($fp, curl_error($ch));
}
curl_close($ch);
fclose($fp);

printf("File 'getRss.php' loaded\n\n");

?>