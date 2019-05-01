<?php 

header("content-type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {

	case 'GET':
	getMethod();
	break;

	case 'POST':
	$data = json_decode(file_get_contents('php://input'),true);
	postMethod($data);
	break;


	case 'PUT':
	$data = json_decode(file_get_contents('php://input'),true);
	updateMethod($data);
	break;	

	case 'DELETE':
	$data = json_decode(file_get_contents('php://input'),true);
	deleteData($data);
	break;
	
}


//GET
function getMethod(){

	require 'db.php';

	$stmt = $pdo->query("SELECT * FROM tbl_student" );
	
	$fetchData = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($fetchData) {
		
		$rows['data'] [] = $fetchData;
		echo json_encode($rows);
	}
	else{

		echo '{"output" : "data not fetched"}';
	}

}

//INSERT
function postMethod($data){

	require 'db.php';

	$name = $data["name"];
	$dep = $data["dep"];
	$age = $data["age"];

	$stmt = $pdo->prepare("INSERT INTO tbl_student (name,dep,age) VALUES (?,?,?)");

	$insert = $stmt->execute([

		$name,
		$dep,
		$age

	]);

	if ($insert) {
		
		echo '{"output" : "data inserted successfully"}';
	}
	else{
		echo '{"output" : "data not inserted"}';
	}
}

//UPDATE
function updateMethod($data){

	require 'db.php';

	$id = $data["id"];
	$name = $data["name"];
	$dep = $data["dep"];
	$age = $data["age"];

	$stmt = $pdo->prepare("UPDATE tbl_student SET name=?,dep=?,age=? WHERE id=?");

	$update = $stmt->execute([

		$name,
		$dep,
		$age,
		$id    
	]);

	if ($update) {

		echo '{"output" : "data updated successfully"}';
	}
	else{
		echo '{"output" : "data not updated"}';
	}
}




//DELETE
function deleteData($data){

	require 'db.php';

	$id = $data["id"];
	$stmt = $pdo->prepare("DELETE FROM tbl_student WHERE id=?");
	$delete = $stmt->execute([$id]);


	if ($delete) {
		echo '{"output" : "data deleted successfully"}';
	}
	else{
		echo '{"output" : "data not deleted"}';
	}
}



?>
