<?php
include "connect.php";
$token = $_POST['token'];
$user_id = $_POST['user_id'];

$query = "UPDATE `user` SET `token`='$token' WHERE `user_id` = '$user_id'";
$data = mysqli_query($conn, $query);
if ($data == true) {
	$arr = [
		'success' => true,
		'message' => "thanh cong",
	];
}else{
	$arr = [
		'success' => false,
		'message' => "khong thanh cong",
	];
}





print_r(json_encode($arr));

?>