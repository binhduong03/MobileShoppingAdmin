<?php
include "connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$email = $_POST['email'];
  
$query = "SELECT * FROM `user` WHERE `email` = '$email'";
$data = mysqli_query($conn, $query);
$result = array();
while ($row = mysqli_fetch_assoc($data)) {
  // code...
  $result[] = ($row);
}

if (empty($result)) {
    $arr = [
        'success' => false,
        'message' => "Mail không chính xác",
        'result' => $result
    ];
} else{

    //send mail
    $email=($result[0]["email"]);
    $pass=($result[0]["pass"]);
    $link="<a href='http://192.168.0.103:81/androidstudio_banhang/reset_pass.php?key=".$email."&reset=".$pass."'>Nhấn để đặt lại mật khẩu</a>";
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "binhduongx6qs10@gmail.com";
    // GMAIL password
    $mail->Password = "ieyuflirbdxltflk";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From= $email;
    $mail->FromName='App bán hàng';
    $mail->AddAddress($email, 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = $link;
    if($mail->Send())
    {
      $arr = [
          'success' => true,
          'message' => "Vui lòng kiểm tra mail của bạn",
          'result' => $result
      ];
    }
    else
    {
      $arr = [
          'success' => false,
          'message' => "Gửi mail không thành công",
          'result' => $result
      ];
    }

}
print_r(json_encode($arr));
?>