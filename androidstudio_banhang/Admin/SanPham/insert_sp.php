<?php
include "../connect.php";
$tensp = $_POST['tensp'];
$giasp = $_POST['giasp'];
$hinhanh = $_POST['hinhanh'];
$mota = $_POST['mota'];
$loai = $_POST['loai'];

$query = "INSERT INTO `tb_product`(`name`, `price`, `image`, `description`, `type`) VALUES ('$tensp','$giasp','$hinhanh','$mota','$loai')";
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