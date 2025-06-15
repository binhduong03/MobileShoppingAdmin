<?php
include "connect.php";
$email = $_POST['email'];
$pass = $_POST['pass'];
$username = $_POST['username'];
$phone = $_POST['phone'];
$uid = $_POST['uid'];
$role = isset($_POST['role']) ? $_POST['role'] : 0;

$query = "SELECT * FROM `user` WHERE `email` = '$email'";
$data = mysqli_query($conn, $query);
$numrow = mysqli_num_rows($data);

if($numrow > 0){
	$arr = [
		'success' => false,
		'message' => "email đã tồn tại",
	];
} else{
	$query = "INSERT INTO `user`(`email`, `pass`, `username`, `phone`, `uid`, `role`) 
          VALUES ('$email', '$pass', '$username', '$phone', '$uid', '$role')";

	$data = mysqli_query($conn, $query);
	if ($data == true) {
		$arr = [
			'success' => true,
			'message' => "Thành công",
		];
	}else{
		$arr = [
			'success' => false,
			'message' => "Không thành công",
		];
	}
}




print_r(json_encode($arr));

?>