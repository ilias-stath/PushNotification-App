<?php

$tableName = $deps[$index]->getTable();
$findTable = "SHOW TABLES LIKE '$tableName'";
$result = mysqli_query($conn,$findTable);

if ( mysqli_num_rows($result) > 0) {
	//printf("Exists\n");
}else{
	$columns = "(
		id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(500) NOT NULL,
		date VARCHAR(255) NOT NULL,
		link VARCHAR(255) NOT NULL
		)";

	$createTable = "CREATE TABLE $tableName $columns ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

	if (mysqli_query($conn, $createTable)) {
    		//printf("Table created.\n");
	} else {
    		echo "Error creating table: " . mysqli_error($conn);
	}
}


?>