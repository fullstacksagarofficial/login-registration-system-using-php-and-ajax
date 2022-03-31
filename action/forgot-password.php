
<?php
session_start();
include('../smtp/PHPMailerAutoload.php');
include('../function.inc.php');
$conn = _connectodb();

setTimeZone();
$added_on = date("Y-m-d");

$useremail = safe_value($conn, $_POST['forgot_email']);
$res = mysqli_query($conn, "select * from users where email='$useremail'");
$check_user = mysqli_num_rows($res);
$response = array();
if ($check_user > 0) {
   $row = mysqli_fetch_assoc($res);
   $token = $row['token'];
   $name = $row['name'];
   $html = '<a href="http://localhost/login-registration-system-using-php-and-ajax/reset-password.php?token=' . $token . '" target="_blank" style="font-size: 20px; text-decoration: none; color: #FE7155; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #FE7155; display: inline-block;">Click Here</a>';
   send_email($useremail, $html, 'Forgot Password !');
   $response['forgotsuccess'] = true;
} else {
   $response['notfound'] = true;
}
echo json_encode($response);

?>