<?php
include "connect.php";
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$total = 5; // lấy 5 sản phẩm trên 1 trang
$pos = ($page-1)*$total; // 0,5  5,5
$type = isset($_POST['type']) ? $_POST['type'] : 0;

$query = "SELECT * FROM `tb_product` WHERE `type` = $type LIMIT $pos, $total";
$data = mysqli_query($conn, $query);
$result = array();
while ($row = mysqli_fetch_assoc($data)) {
	// code...
	$result[] = ($row);
}

// print_r($result);
if (!empty($result)) {
	$arr = [
		'success' => true,
		'message' => "thanh cong",
		'result' => $result
	];
}else{
	$arr = [
		'success' => false,
		'message' => "khong thanh cong",
		'result' => $result
	];
}

print_r(json_encode($arr));

?>