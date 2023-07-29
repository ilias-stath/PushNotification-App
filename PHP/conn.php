<?php

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','test');


$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset("utf8");

if($conn->connect_error){
	die('Connection Failed' . $con->connect_error); //Cuts everything off
	echo "Error, cannot connect to db";
}else{
	$alterDB = "ALTER DATABASE test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
	mysqli_query($conn,$alterDB);
	
	$tableName = "test";
	$findTable = "SHOW TABLES LIKE '$tableName'";
	$result = mysqli_query($conn,$findTable);

	if ( mysqli_num_rows($result) > 0) {
		//printf("Exists\n");
	}else{
		$columns = "(
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			title VARCHAR(255) NOT NULL,
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
}


printf("File 'conn.php' loaded\n\n");
?>