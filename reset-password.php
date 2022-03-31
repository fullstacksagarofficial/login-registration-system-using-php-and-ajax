<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <?php include('include/links.php'); ?>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-5 center mt-5" style="display:block">
                <div class="wrapper">
                    <div class="title-text">
                        <div class="title login f18">
                            New Password
                        </div>

                    </div>
                    <div class="form-container">

                        <div class="form-inner">
                            <form method="post" id="newpassform" class="login">

                                <div class="field">
                                    <input type="password" name="reset_password" id="reset_password" placeholder="New password"> </li>
                                </div>
                                <p id="resetpasserr" class="error"></p>
                                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                                <input type="submit" value="Submit" id="changenow" class="btnsubmit">

                                <p id="forgotsuccess" class="success"></p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('include/script.php'); ?>

    <script>
        $("#resetpasserr").hide();
        $("#forgotsuccess").hide();
        $("#changenow").click(function(e) {
            e.preventDefault();
            var reset_password = document.getElementById("reset_password").value;
            if (reset_password == "") {
                $("#resetpasserr").html("Please Enter Your Password");
                $("#resetpasserr").show();
                $("#reset_password").focus();
                $("#resetpasserr").delay(4000).fadeOut("slow");
                return false;
            } else {
                document.getElementById("changenow").value = "Please Wait..";
                document.getElementById("changenow").disabled = true;
                $.ajax({
                    type: "post",
                    url: "http://localhost/login-registration-system-using-php-and-ajax/action/reset-password",
                    data: $("#newpassform").serialize(),
                    success: function(response) {
                        document.getElementById("changenow").value = "Submit";
                        document.getElementById("changenow").disabled = false;
                        var response = JSON.parse(response);
                        if (response.resetsuccess == true) {
                            $("#newpassform")[0].reset();
                            $("#forgotsuccess").html(
                                "Password changed successfully ! <a href='index.php'> Click Here to Login</a> "
                            );
                            $("#forgotsuccess").delay(9000).fadeOut("slow");
                            $("#forgotsuccess").show();
                        } else if (response.resetfail == true) {
                            $("#resetpasserr").html("Please Check Internet Connection...");
                            $("#resetpasserr").delay(9000).fadeOut("slow");
                            $("#resetpasserr").show();
                        } else if (response.wrong == true) {
                            $("#resetpasserr").html("Something Went Wrong...");
                            $("#resetpasserr").delay(9000).fadeOut("slow");
                            $("#resetpasserr").show();
                        }
                    },
                });
            }
        });
    </script>
</body>

</html>