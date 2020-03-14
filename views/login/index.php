<?php

Session::init();
if (isset($_SESSION["user_id"]))
{
    header('location:' . URL . 'dashboard');
}
?>
<h1>Login page</h1>
<h1><?php echo $title?></h1>
<div style = "padding: 100px 100px 10px;">
<img src="../../public/images/profile.png">
    <form class = "bs-example bs-example-form"  action="login/run" method="post" id="MyForm" novalidate>
        <div class = "row">
            <div class = "col-lg-8">
                <div class = "form-inline">

                    <label >Username</label>

                    <input type = "text" class = "form-control" name = "username" placeholder="Enter username" id="username" required />
                </div>
                <span class="error"></span>
            </div><br>
            <div class = "col-lg-8">
                <div class = "form-inline">
                    <label >Password</label>
                    <input type="password" name = "password" placeholder="Enter password" class = "form-control" id="password" required />
                </div>
                <div class = "row">
                    <div class="col-lg-8">
                        <label></label><span id="error"></span>
                    </div>
                </div>
                <div class="checkbox">
                    <label></label><label><input type="checkbox" name="remember" id="remember"> Remember me</label>
                </div>
                <br />
                <label></label><input class="btn btn-primary"  type="submit" value="Log In" name="login"/>
            </div>
        </div>
    </form>
</div>
<?php
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"]))
{
    $username = $_COOKIE["username"];
    $password = $_COOKIE["password"];
    echo "<script>
        document.getElementById('username').value ='$username';
        document.getElementById('password').value ='$password';
</script>";
}
?>

<!--<script>
    $(document).ready(function () {

        $('#MyForm').submit(function (event) {
            event.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();
                if($('#remember').is(":checked")) {
                    var remember =1;
                } else {
                     remember =0;
                }
            if ($.trim(username).length > 0 && $.trim(password).length > 0)
            {
                $.ajax({
                    url:"<?php /*echo URL; */?>login/run",
                    method:"POST",
                    data:{username:username, password:password, remember:remember},
                    cashe:false,
                    success:function (data) {
                        if (data)
                        {
                            $("body").hide();
                            window.location.href= "<?php /*echo URL; */?>dashboard";
                        }
                        else
                        {
                            $('#error').html("<span class='text-danger'>Invalid username or password</span>");
                            document.getElementById("username").style.borderColor = "red";
                            document.getElementById("password").style.borderColor = "red";
                        }
                    }
                });
            }
            else
            {
                $('#error').html("<span class='text-danger'>Please fill important fields</span>");
                document.getElementById("username").style.borderColor = "red";
                document.getElementById("password").style.borderColor = "red";
                return false;
            }
        });
    });
</script>-->
