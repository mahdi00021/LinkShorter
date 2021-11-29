<?php
require(__dir__ . '\Data\Database.php');


$db_connection = new Database();
$conn = $db_connection->dbConnection();
$conn->beginTransaction();
$query = "insert into urls(url,short_code,hits) values('http://ihnaa.ir','ahg','2')";
$result = $conn->prepare($query);
$result->execute();
$conn->commit();

?>