<?php
include "connect.php";

$phone = $_POST['phone'];
$email = $_POST['email'];
$total_amount = $_POST['total_amount'];
$user_id = $_POST['user_id'];
$address = $_POST['address'];
$quantity = $_POST['quantity'];
$chitiet = $_POST['chitiet'];

$query = "INSERT INTO `tb_order` (`user_id`, `address`, `phone`, `email`, `quantity`, `total_amount`) 
          VALUES ('$user_id', '$address', '$phone', '$email', '$quantity', '$total_amount')";
$data = mysqli_query($conn, $query);

if ($data == true) {
    $query = "SELECT order_id FROM tb_order WHERE user_id = '$user_id' ORDER BY order_id DESC LIMIT 1";
    $data = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($data);
    $order_id = $row['order_id'];

    if (!empty($order_id)) {
        // 3. Duyệt chi tiết đơn hàng
        $chitiet = json_decode($chitiet, true);
        $success = true;

        foreach($chitiet as $value){
            $product_id = $value['product_id'];
            $quantity = $value['quantity'];
            $price = $value['price'];

            $truyvan = "INSERT INTO `tb_orderdetail` (`order_id`, `product_id`, `quantity`, `price`) 
                        VALUES ('$order_id', '$product_id', '$quantity', '$price')";
            $data = mysqli_query($conn, $truyvan);

            if (!$data) {
                $success = false;
                break;
            }
        }

        if ($success) {
            $arr = [
                'success' => true,
                'message' => "Thêm đơn hàng và chi tiết thành công"
            ];
        } else {
            $arr = [
                'success' => false,
                'message' => "Lỗi khi thêm chi tiết đơn hàng"
            ];
        }
    } else {
        $arr = [
            'success' => false,
            'message' => "Không tìm thấy mã đơn hàng vừa thêm"
        ];
    }
} else {
    $arr = [
        'success' => false,
        'message' => "Không thêm được đơn hàng"
    ];
}

// Trả kết quả dạng JSON
header('Content-Type: application/json');
echo json_encode($arr);
?>
