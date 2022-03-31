
<?php
session_start();
include('../smtp/PHPMailerAutoload.php');
include('../function.inc.php');
$conn = _connectodb();

$email = safe_value($conn, $_POST['loginemail']);
$password = safe_value($conn, $_POST['loginpassword']);


$response = array();
if (!empty($email) || !empty($password)) {

    $select = "SELECT * FROM users WHERE email = '$email' AND status='active'";
    $select2 = "SELECT * FROM users WHERE email = '$email' AND status='inactive'";

    $execute = mysqli_query($conn, $select);
    $execute2 = mysqli_query($conn, $select2);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['invalidemail'] = true;
    }
    elseif(mysqli_num_rows($execute2) == 1)
    {
        $response['notactive'] = true;
    }

    else if (mysqli_num_rows($execute) == 1) {
        while ($row = mysqli_fetch_assoc($execute)) {

            if (password_verify($password, $row['password'])) {

                $_SESSION['LOGIN_ID'] = $row['ID'];
                $_SESSION['EMAIL'] = $row['email'];
                $_SESSION['NAME'] = $row['name'];
                $response['success'] = true;
            } else {
                $response['passwordincorrect'] = true;
            }
        }
        
    } else {
        $response['emailnotfound'] = true;
    }
} 
echo json_encode($response);
?>