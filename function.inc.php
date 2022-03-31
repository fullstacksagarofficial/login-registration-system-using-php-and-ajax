<?php 

$servername = "localhost";$dbusername ="root";$password = "";
$dbname = "login-registration-system";
error_reporting(E_ALL);
function _connectodb()
{
	global $dbname;
	global $servername;
	global $dbusername;
	global $password;
	$connect = new mysqli($servername,$dbusername,$password,$dbname);
	if($connect->connect_error) 
	{
		print_r("Connection Error: " . $connect->connect_error);
		return false;
	}
	else
	{
		return $connect;
	}
}
function setTimeZone()
{
	date_default_timezone_set('Asia/Kolkata');
}
function safe_value($conn,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($conn,$str);
	}
}

function send_email($email, $html, $subject)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
    $mail->Username = "YOUREMAIL";
    $mail->Password = "YOURPASSWORD";
    $mail->SetFrom("YOUREMAIL");
    $mail->addAddress($email);
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $html;
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if ($mail->send()) {
        // echo "done";
    } else {
        // echo $mail->ErrorInfo;
    }
}

?>