<?php
include "../connect.php";
$tensp = $_POST['tensp'];
$giasp = $_POST['giasp'];
$hinhanh = $_POST['hinhanh'];
$mota = $_POST['mota'];
$loai = $_POST['loai'];
$sanphammoi_id = $_POST['sanphammoi_id'];

$query = "UPDATE `tb_product` SET `name`='$tensp',`price`='$giasp',`image`='$hinhanh',`description`='$mota',`type`='$loai' WHERE `product_id` = '$sanphammoi_id'";
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





print_r(json_encode($arr));

?>