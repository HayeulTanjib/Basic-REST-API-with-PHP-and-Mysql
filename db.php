<?php 

$dsn = "mysql:dbname=db_student; host=localhost";
$userName = "root";
$userPassword = "";

try{
	
	$pdo = new PDO ($dsn, $userName, $userPassword);
	
}catch(PDOException $e){
	
	echo "Connection Error! <mark>".$e->getMessage()."</mark>";
}

?>