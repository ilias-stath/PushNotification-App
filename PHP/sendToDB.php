<?php

$tableName = $deps[$index]->getTable();

$isEmpty = "SELECT * FROM $tableName";

$result = mysqli_query($conn, $isEmpty);

$titles = $deps[$index]->getTitles();
$dates = $deps[$index]->getDates();
$links = $deps[$index]->getLinks();

$titlesDB = array();
$datesDB = array();
$linksDB = array();
$count = 0;

if($result){
	if(mysqli_num_rows($result) > 0){
		for($i=1; $i<11; $i++){
			$getValues = "SELECT * FROM $tableName WHERE id = $i";
			$result = mysqli_query($conn, $getValues);
			while($row = mysqli_fetch_assoc($result)){
				$titlesDB[$i-1] = $row['title'];
				$datesDB[$i-1] = $row['date'];
				$linksDB[$i-1] = $row['link'];
			}
			if($datesDB[0] == $dates[0] && $linksDB[0] == $links[0]){
				break;
			}elseif($datesDB[0] != $dates[$i-1] && $linksDB[0] != $links[$i-1]){
				$count = $i;
			}else{
				break;
			}
		}
		if($count != 0){
			for($i=0; $i<10; $i++){
				$insert = "UPDATE $tableName SET title = '$titles[$i]' , date = '$dates[$i]' , link = '$links[$i]' WHERE id = ". ($i + 1);
				if (!mysqli_query($conn, $insert)) {
    					echo "Error: " . mysqli_error($conn);
				}
			}
		}
	}else{
		$count = 10;
		for($i=0; $i<10; $i++){
			$insert = "INSERT INTO $tableName (title, date, link) VALUES ('" . $titles[$i] . "', '" . $dates[$i] . "', '" . $links[$i] . "')";
			if (!mysqli_query($conn, $insert)) {
    				echo "Error: " . mysqli_error($conn);
			}
		}
	}

}else{
	echo "Error executing query: " . mysqli_error($conn);
}

unset($titles);
unset($dates);
unset($links);

//printf("%d\n",$count);
//printf("File 'sendToDB.php' loaded\n\n");
?>