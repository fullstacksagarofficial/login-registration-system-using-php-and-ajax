<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php include('include/links.php'); ?>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-5 center mt-5" style="display:block">
                <div class="wrapper">
                    <div class="title-text">
                        <div class="title login f18 text-success">
                            Welcome <?php echo strtoupper($_SESSION['NAME']) ?> !

                            <a href="action/logout.php"> <p class="text-danger mt-3">Logout</p></a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php include('include/script.php'); ?>


</body>

</html>