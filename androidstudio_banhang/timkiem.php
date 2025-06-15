<?php
include "connect.php";
$search = isset($_POST['search']) ? $_POST['search'] : '';
$result = [];
if (empty($search)) {
    $arr = [
        'success' => false,
        'message' => "khong thanh cong",
        'result' => $result
    ];
}else{
    $query = "SELECT * FROM `tb_product` WHERE name LIKE '%$search%';";
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
}
print_r(json_encode($arr));
?>
