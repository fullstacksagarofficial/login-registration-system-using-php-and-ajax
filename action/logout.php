
<?php
session_start();
include('../function.inc.php');
$conn = _connectodb();
unset($_SESSION['LOGIN_ID']);
unset($_SESSION['EMAIL']);
unset($_SESSION['NAME']);
echo '<script>window.location.href="../index.php"</script>';
?>