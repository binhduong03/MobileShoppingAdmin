<?php
include "connect.php";

if(isset($_POST['submit_password']) && $_POST['email'] && $_POST['pass'])
{
  $email=$_POST['email'];
  $pass=$_POST['pass'];

  $query = "update user set pass='$pass' where email='$email'";

  $data = mysqli_query($conn, $query);

  if ($data == true) {
    echo "Thành công";
  }
}
?>