<?php
include "../connect.php";
$product_id = $_POST['product_id'];

$query = "DELETE FROM `tb_product` WHERE `product_id` = '$product_id'";
$data = mysqli_query($conn, $query);
if ($data == true) {
	$arr = [
		'success' => true,
		'message' => "Thành công",
	];
}else{
	$arr = [
		'success' => false,
		'message' => "Xóa không thành công",
	];
}

print_r(json_encode($arr));

?>