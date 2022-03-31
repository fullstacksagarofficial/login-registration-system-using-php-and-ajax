
<?php
session_start();
include('../smtp/PHPMailerAutoload.php');
include('../function.inc.php');
$conn = _connectodb();
setTimeZone();
$added_on = date("Y-m-d");

$reset_password = safe_value($conn, $_POST['reset_password']);
$token = safe_value($conn, $_POST['token']);

    if (isset($token)) {
        $cpassword = password_hash($reset_password, PASSWORD_BCRYPT);

        $updatequery = "update users set password='$cpassword' where token='$token' ";
        $execute = mysqli_query($conn, $updatequery);

        if ($execute) {
            $response['resetsuccess'] = true;
        } else {
            $response['resetfail'] = true;
        }
    } else {
        $response['wrong'] = true;
    }


echo json_encode($response);
?>