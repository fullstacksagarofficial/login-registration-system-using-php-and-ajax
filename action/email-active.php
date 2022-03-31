
<?php
session_start();
include('../smtp/PHPMailerAutoload.php');
include('../function.inc.php');
$conn = _connectodb();

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $updatequery = "update users set status='active' where token='$token'";
    $select = "SELECT * FROM users WHERE token = '$token'";
    $execute = mysqli_query($conn, $select);
    $userrow = mysqli_fetch_assoc($execute);
    $email = $userrow['email'];
    $name = $userrow['name'];
    $query = mysqli_query($conn, $updatequery);
    if ($query) {
        $html = '
        <p style="font-size:14px; color:#455eb2; padding-left:20px; padding-right:20px; text-align:justify;"> Your Account ' . $email . ' registered Successfully </p>
        ';
        send_email($email, $html, 'Account Activated !');

        $_SESSION['img'] = "background: linear-gradient(rgb(255 255 255), rgb(255 255 255 / 83%)), url(img/sparcle.gif) no-repeat;
            background-size: cover;";
        $_SESSION['account_active'] = "Account Activated !";
        header("location:../account-active");
    }
}

?>