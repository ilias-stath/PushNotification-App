<?php

//$alterDB = "ALTER DATABASE myuni CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
//mysqli_query($conn,$alterDB);

$tableName = "ConnectionKeys";
$findTable = "SHOW TABLES LIKE '$tableName'";
$result = mysqli_query($conn,$findTable);


if ( mysqli_num_rows($result) > 0) {
	//printf("Exists\n");
}else{
	$columns = "(
		id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		API_KEY VARCHAR(49) NOT NULL,
		APP_ID VARCHAR(36) NOT NULL
		)";

	$createTable = "CREATE TABLE $tableName $columns ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

	if (mysqli_query($conn, $createTable)) {
    		//printf("Table created.\n");
	} else {
    		echo "Error creating table: " . mysqli_error($conn);
	}
}

$isEmpty = "SELECT * FROM $tableName";

$result = mysqli_query($conn, $isEmpty);

if($result){
	if(mysqli_num_rows($result) <= 0){
		$insert = "INSERT INTO $tableName (API_KEY, APP_ID) VALUES ('NjRmMDVjNzYtNmIxZS00ZjBkLTlhNmUtNGU5MTgxNTYxY2Vk', 'dbfcf29c-7c9c-442c-959b-9047021379f1')";
		if (!mysqli_query($conn, $insert)){
    				echo "Error: " . mysqli_error($conn);
		}
	}
}else{
	echo "Error executing query: " . mysqli_error($conn);
}

?>