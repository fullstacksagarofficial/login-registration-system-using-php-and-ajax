<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Registration System Using PHP and Ajax</title>
    <?php include('include/links.php'); ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 center mt-5">
                <div class="wrapper">
                    <div class="title-text">
                        <div class="title login">
                            Login Form
                        </div>
                        <div class="title signup">
                            Signup Form
                        </div>
                    </div>
                    <div class="form-container">
                        <div class="slide-controls">
                            <input type="radio" name="slide" id="login" checked>
                            <input type="radio" name="slide" id="signup">
                            <label for="login" class="slide login">Login</label>
                            <label for="signup" class="slide signup">Signup</label>
                            <div class="slider-tab"></div>
                        </div>
                        <div class="form-inner">

                            <form method="post" class="login" id="loginnowform">
                                <div class="field">
                                    <input type="text" placeholder="Email Address" id="loginemail" name="loginemail" required>
                                </div>
                                <p id="loginerroremail" class="error"></p>
                                <div class="field">
                                    <input type="password" placeholder="Password" id="loginpassword" name="loginpassword" required>
                                </div>
                                <p id="loginerrorpassword" class="error"></p>
                                <div class="pass-link">
                                    <a href="forgot-password.php">Forgot password?</a>
                                </div>

                                <input type="submit" value="Login" class="btnsubmit" id="loginnow">
                                <p id="loginsuccess" class="success"></p>
                                <p id="loginerrorfail" class="error"></p>
                                <div class="signup-link">
                                    Not a member? <a href="">Signup now</a>
                                </div>
                            </form>

                            <form method="post" class="signup" id="registerform">
                                <div class="field">
                                    <input type="text" placeholder="Name" name="registername" id="registername" required>
                                </div>
                                <p id="regerrorname" class="error"></p>
                                <div class="field">
                                    <input type="text" placeholder="Email Address" name="registeremail" id="registeremail" required>
                                </div>
                                <p id="regerroremail" class="error"></p>
                                <div class="field">
                                    <input type="password" placeholder="Password" name="registerpassword" id="registerpassword" required>
                                </div>
                                <p id="regerrorpassword" class="error"></p>
                                <div class="field">
                                    <input type="password" placeholder="Confirm password" id="confirmpassword" name="confirmpassword" required>
                                </div>
                                <p id="regerrorcpassword" class="error"></p>
                                <input type="submit" value="Signup" class="btnsubmit" id="registernow">
                                <p id="successregister" class="success"></p>
                                <p id="regerrorfail" class="error"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('include/script.php'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $("#loginerroremail").hide();
        $("#loginerrorpassword").hide();
        $("#loginsuccess").hide();
        $("#loginerrorfail").hide();
        $("#loginnow").click(function(e) {
            e.preventDefault();
            var loginemail = document.getElementById("loginemail").value;
            var loginpassword = document.getElementById("loginpassword").value;

            if (loginemail == "") {
                $("#loginerroremail").html("Please Enter Your Email");
                $("#loginerroremail").show();
                $("#loginemail").focus();
                $("#loginerroremail").delay(4000).fadeOut("slow");
                return false;
            } else if (loginpassword == "") {
                $("#loginerrorpassword").html("Please Enter Password");
                $("#loginerrorpassword").show();
                $("#loginpassword").focus();
                $("#loginerrorpassword").delay(4000).fadeOut("slow");
                return false;
            } else {
                document.getElementById("loginnow").value = "Please Wait..";
                document.getElementById("loginnow").disabled = true;
                $.ajax({
                    type: "post",
                    url: "http://localhost/login-registration-system-using-php-and-ajax/action/login-action.php",
                    data: $("#loginnowform").serialize(),

                    success: function(response) {
                        document.getElementById("loginnow").value = "Login";
                        document.getElementById("loginnow").disabled = false;

                        var response = JSON.parse(response);
                        if (response.invalidemail == true) {
                            $("#loginerroremail").html("Please Enter Valid Email");
                            $("#loginerroremail").show();
                            $("#loginemail").focus();
                            $("#loginerroremail").delay(4000).fadeOut("slow");
                            return false;
                        } else if (response.emailnotfound == true) {
                            $("#loginerroremail").html("Email Not Found !");
                            $("#loginerroremail").show();
                            $("#loginemail").focus();
                            $("#loginerroremail").delay(3000).fadeOut("slow");
                            return false;
                        } else if (response.passwordincorrect == true) {
                            $("#loginerrorpassword").html("Please Enter Valid Password !");
                            $("#loginerrorpassword").show();
                            $("#loginpassword").focus();
                            $("#loginerrorpassword").delay(3000).fadeOut("slow");
                            return false;
                        } else if (response.notactive == true) {
                            $("#loginerroremail").html("Your Email is not active ! Please check your email to activate your account");
                            $("#loginerroremail").show();
                            $("#loginerroremail").delay(9000).fadeOut("slow");
                            return false;
                        } else if (response.success == true) {
                            $("#loginsuccess").html("Login Successfull ! Redirecting ...");
                            $("#loginsuccess").show();
                            $("#loginsuccess").delay(6000).fadeOut("slow");
                            $("#loginnowform")[0].reset();
                            // window.location.reload();
                            setTimeout(function() {
                                window.location.href = "http://localhost/login-registration-system-using-php-and-ajax/welcome.php";
                            }, 2000);
                        }
                    },
                });
            }
        });
    </script>
    <script>
        $("#regerrorname").hide();
        $("#regerroremail").hide();
        $("#regerrorpassword").hide();
        $("#regerrorcpassword").hide();
        $("#regerrorfail").hide();
        $("#successregister").hide();
        $("#registernow").click(function(e) {
            e.preventDefault();
            var registername = document.getElementById("registername").value;
            var registeremail = document.getElementById("registeremail").value;
            var registerpassword = document.getElementById("registerpassword").value;
            var confirmpassword = document.getElementById("confirmpassword").value;
            if (registername == "") {
                $("#regerrorname").html("Please Enter Your Name");
                $("#regerrorname").show();
                $("#registername").focus();
                $("#regerrorname").delay(4000).fadeOut("slow");
                return false;
            } else if (registeremail == "") {
                $("#regerroremail").html("Please Enter Your Email");
                $("#regerroremail").show();
                $("#registeremail").focus();
                $("#regerroremail").delay(4000).fadeOut("slow");
                return false;
            } else if (registerpassword == "") {
                $("#regerrorpassword").html("Please Enter Your Password");
                $("#regerrorpassword").show();
                $("#registerpassword").focus();
                $("#regerrorpassword").delay(4000).fadeOut("slow");
                return false;
            } else if (confirmpassword == "") {
                $("#regerrorcpassword").html("Please Re-enter Your Password");
                $("#regerrorcpassword").show();
                $("#confirmpassword").focus();
                $("#regerrorcpassword").delay(4000).fadeOut("slow");
                return false;
            } else {
                document.getElementById("registernow").value = "Please Wait..";
                document.getElementById("registernow").disabled = true;
                $.ajax({
                    type: "post",
                    url: "http://localhost/login-registration-system-using-php-and-ajax/action/register-user.php",
                    data: $("#registerform").serialize(),
                    success: function(response) {
                        document.getElementById("registernow").value = "Signup";
                        document.getElementById("registernow").disabled = false;
                        var response = JSON.parse(response);
                        if (response.reginvalid_email == true) {
                            $("#regerroremail").html("Please Enter Valid Email");
                            $("#regerroremail").show();
                            $("#regerroremail").focus();
                            $("#regerroremail").delay(4000).fadeOut("slow");
                            return false;
                        } else if (response.regexist_email == true) {
                            $("#regerroremail").html("Email Already Exist");
                            $("#regerroremail").show();
                            $("#regerroremail").focus();
                            $("#regerroremail").delay(4000).fadeOut("slow");
                            return false;
                        } else if (response.regsuccess == true) {
                            $("#successregister").html(
                                "Please Check your E-mail to Activate your account"
                            );
                            $("#successregister").show();
                            jQuery("#registerform")[0].reset();
                        } else if (response.regfail == true) {
                            $("#regfregerrorfail").html(
                                "Please check your internet connection or Try After Sometime !"
                            );
                            $("#regerrorfail").show();
                            $("#regerrorfail").delay(8000).fadeOut("slow");
                        } else if (response.notmatch == true) {
                            $("#regerrorcpassword").html(
                                "Password Not Match !"
                            );
                            $("#regerrorcpassword").show();
                            $("#regerrorcpassword").delay(8000).fadeOut("slow");
                        }
                    },
                });

            }
        });
    </script>
</body>

</html>