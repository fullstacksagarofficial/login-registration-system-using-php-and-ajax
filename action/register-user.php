
<?php
session_start();
include('../smtp/PHPMailerAutoload.php');
include('../function.inc.php');
$conn = _connectodb();
setTimeZone();
$added_on = date("Y-m-d");
$name = safe_value($conn, $_POST['registername']);
$email = safe_value($conn, $_POST['registeremail']);
$registerpassword = safe_value($conn, $_POST['registerpassword']);
$confirmpassword = safe_value($conn, $_POST['confirmpassword']);
$password = password_hash($registerpassword, PASSWORD_BCRYPT);
$token = bin2hex(random_bytes(15));
$response = array();
$selectemail = "SELECT * FROM users WHERE email = '$email'";
$execute = mysqli_query($conn, $selectemail);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['reginvalid_email'] = true;
} else if ($execute->num_rows == 1) {
    $response['regexist_email'] = true;
} else if ($registerpassword != $confirmpassword) {
    $response['notmatch'] = true;
} else {
    $sql = "INSERT into users (
        name,
        email,
        password,
        token,
        status,
        added_on
        )
        VALUES (
        '$name',
        '$email',
        '$password',
        '$token',
        'inactive',
        '$added_on'
        )";

    $result  = mysqli_query($conn, $sql);

    if ($result) {
        $subject = 'Account Activation';
        $html = ' <a style="color:#455eb2; text-decoration:none;"  href="http://localhost/login-registration-system-using-php-and-ajax/action/email-active?token=' . $token . '">Click Here To Verify Your E-mail Address</a>
        ';
        send_email($email, $html, 'Registration !');
        $_SESSION['account_active'] = "yes";
        $response['regsuccess'] = true;
    }
}
echo json_encode($response);

?>