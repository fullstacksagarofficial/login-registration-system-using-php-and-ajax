<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <?php include('include/links.php'); ?>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-5 center mt-5" style="display:block">
                <div class="wrapper">
                    <div class="title-text">
                        <div class="title login f18">
                            Forgot Password
                        </div>

                    </div>
                    <div class="form-container">
                        <div class="form-inner">
                            <form method="POST" class="login" id="forgotform">
                                <div class="field">
                                    <input type="text" name="forgot_email" id="forgot_email" placeholder="Email"> </li>

                                </div>
                                <p id="forgotemail" class="error"></p>
                                <input type="submit" value="Submit" id="forgotnow" class="btnsubmit">
                                <p id="forgotsuccess" class="success mt-1"></p>
                                <p id="forgotfail" class="error mt-1"></p>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include('include/script.php'); ?>
    <script>
        $("#forgotemail").hide();
        $("#forgotsuccess").hide();
        $("#forgotfail").hide();
        $("#forgotnow").click(function(e) {
            e.preventDefault();
            var forgot_email = document.getElementById("forgot_email").value;
            if (forgot_email == "") {
                $("#forgotemail").html("Please Enter Your Email");
                $("#forgotemail").show();
                $("#forgot_email").focus();
                $("#forgotemail").delay(4000).fadeOut("slow");
                return false;
            } else {
                document.getElementById("forgotnow").value = "Please Wait..";
                document.getElementById("forgotnow").disabled = true;
                $.ajax({
                    type: "post",
                    url: "http://localhost/login-registration-system-using-php-and-ajax/action/forgot-password.php",
                    data: $("#forgotform").serialize(),
                    success: function(response) {
                        document.getElementById("forgotnow").value = "Submit";
                        document.getElementById("forgotnow").disabled = false;
                        var response = JSON.parse(response);
                        if (response.forgotfail == true) {
                            $("#forgotfail").html("Something went wrong !");
                            $("#forgotfail").show();
                            $("#forgot_email").focus();
                            $("#forgotfail").delay(4000).fadeOut("slow");
                            return false;
                        } else if (response.notfound == true) {
                            $("#forgotfail").html("Email Not Found !");
                            $("#forgotfail").show();
                            $("#forgotfail").delay(4000).fadeOut("slow");
                            return false;
                        } else if (response.forgotsuccess == true) {
                            $("#forgotform")[0].reset();
                            $("#forgotsuccess").html("Please check your email to reset your password");
                            $("#forgotsuccess").show();
                            return false;
                        }
                    },
                });
            }
        });
    </script>


</body>

</html>