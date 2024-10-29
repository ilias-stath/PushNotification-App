<?php

require_once '/home/myuni/public_html/NotificationCode/Dep_class.php';

$deps = array();

$ece = new Departements('https://ece.uowm.gr/feed.php','feedECE.txt','ECE','ECE');
$mech = new Departements('https://mech.uowm.gr/feed/','feedMECH.txt','MECH','MECH');
$chemeng = new Departements('https://chemeng.uowm.gr/feed/','feedCHEMENG.txt','CHEMENG','CHEMENG');
$ide = new Departements('https://ide.uowm.gr/feed/','feedIDE.txt','IDE','IDE');
$mre = new Departements('https://mre.uowm.gr/feed/','feedMRE.txt','MRE','MRE');

$deps[0] = $ece;
$deps[1] = $mech;
$deps[2] = $chemeng;
$deps[3] = $ide;
$deps[4] = $mre;

$depNum = count($deps);
//$depNum = 1;

require_once '/home/myuni/public_html/NotificationCode/conn.php';

require_once '/home/myuni/public_html/NotificationCode/keyTable.php';

if($connection){
	$search = $conn->query("SELECT API_KEY, APP_ID FROM ConnectionKeys WHERE id = 1");
	if($search){
		$row = $search->fetch_assoc();
    		if ($row) {
        		$API_KEY = $row['API_KEY'];
        		$APP_ID = $row['APP_ID'];
		}
	}
	for($index=0;$index<$depNum;$index++){
		
		require '/home/myuni/public_html/NotificationCode/createTables.php';

		require '/home/myuni/public_html/NotificationCode/getRss.php';

		require '/home/myuni/public_html/NotificationCode/findInRss.php';

		require '/home/myuni/public_html/NotificationCode/sendToDB.php';

		require '/home/myuni/public_html/NotificationCode/pushNot.php';
		
	}

}



mysqli_close($conn);


echo "\n\nALL GOOD";

?>