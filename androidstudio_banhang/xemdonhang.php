<?php
include "connect.php";
$user_id = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;

$query = "SELECT * FROM `tb_order` WHERE `user_id` = $user_id";
$data = mysqli_query($conn, $query);
$result = array();

while ($row = mysqli_fetch_assoc($data)) {
    $order_id = $row['order_id'];
    $truyvan = "SELECT * FROM `tb_orderdetail` 
                INNER JOIN tb_order 
                ON tb_orderdetail.product_id = tb_product.product_id 
                WHERE tb_orderdetail.order_id = $order_id";

    $data1 = mysqli_query($conn, $truyvan);
    $item = array();
    while($row1 = mysqli_fetch_assoc($data1)){
        $item[] = $row1;
    }
    $row['item'] = $item;
    $result[] = $row;
}

if (!empty($result)) {
    $arr = [
        'success' => true,
        'message' => "thanh cong",
        'result' => $result
    ];
} else {
    $arr = [
        'success' => false,
        'message' => "khong thanh cong",
        'result' => []
    ];
}

print_r(json_encode($arr));
?>
