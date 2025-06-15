<?php
include "../connect.php";
$user_id = $_POST['user_id'];
$message = $_POST['message'];
$is_read = $_POST['is_read'];

$query = "INSERT INTO `tb_contact`(`user_id`, `message`, `is_read`) VALUES ('$user_id','$message','$is_read')";
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