<?php Session::init(); ?>
<h1>Register page</h1>

<div style = "padding: 100px 100px 10px;">

    <form class = "bs-example bs-example-form" action="register/run" method="post" id="MyForm">
        <div class = "row">

            <div class = "col-lg-8">
                <div class = "form-inline">
                    <label >Username</label>
                    <input type = "text" class = "form-control" name = "username" placeholder="Enter username" id="username" />
                    <span id="username-error"></span>
                </div>
            </div><br>
            <div class = "col-lg-8">
                <div class = "form-inline">
                    <label >Password</label>
                    <input type="password" name = "password" placeholder="Enter password" class = "form-control" id="password" />
                    <span id="password-error"></span>
                </div>
                <div class = "form-inline">
                    <label >Repeat Password</label>
                    <input type = "password" class = "form-control" name = "password1" placeholder="Repeat password" id="password1"/>
                    <span id="password1-error"></span>
                </div>
                <div class = "form-inline">
                    <label >First Name</label>
                    <input type = "text" class = "form-control" name = "first_name" placeholder="Enter first name" id="firstname"/>
                </div>
                <div class = "form-inline">
                    <label >Last Name</label>
                    <input type = "text" class = "form-control" name = "last_name" placeholder="Enter last name" id="lastname"/>
                </div>
                <div class = "row">
                    <div class="col-lg-12">
                        <label></label><span id="error"></span>
                    </div>
                </div>
                <div class="checkbox">
                    <label></label><label><input type="checkbox" name="remember" id="remember"> Remember me</label>
                </div>
                <br />
                <label></label><input class="btn btn-primary"  type="submit" value="Register" name="register"/>
            </div>
        </div>
    </form>

</div>

<script>
    $(document).ready(function () {

        $('#MyForm').submit(function (event) {
            event.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();
            var password1 = $('#password1').val();
            var first_name = $('#firstname').val();
            var last_name = $('#lastname').val();
            if($('#remember').is(":checked")) {
                var remember =1;
            } else {
                remember =0;
            }
            if (!$.trim(username)||!$.trim(password) ||$.trim(password).length < 5 ||password1 !== password)
            {
            if (!$.trim(username) )
            {
                $('#username-error').html("<span class='text-danger'>Username is required</span>");
                document.getElementById("username").style.borderColor = "red";
                return false;
            }
            if (!$.trim(password) )
            {
                $('#password-error').html("<span class='text-danger'>Password is required</span>");
                document.getElementById("password").style.borderColor = "red";
                return false;
            }
            if ($.trim(password).length < 5)
            {
                $('#password-error').html("<span class='text-danger'>The minimum password length is 5</span>");
                document.getElementById("password").style.borderColor = "red";
                return false;
            }
            if (password1 !== password)
            {
                $('#password1-error').html("<span class='text-danger'>Please repeat the same password</span>");
                document.getElementById("password1").style.borderColor = "red";
                return false;
            }
            }
            if ($.trim(username).length > 0 && $.trim(password).length > 5 && password1 == password)
            {
                $.ajax({
                    url:"<?php echo URL; ?>register/run",
                    method:"POST",
                    data:{username:username, password:password,password1:password1,first_name:first_name,last_name:last_name,
                    remember:remember},
                    cashe:false,
                    success:function (data) {
                        if (data)
                        {
                            $('#error').html("<span class='text-success'>Registered successfully</span>");
                            $("body").hide().fadeIn(1500);
                            window.location.href= "<?php echo URL; ?>dashboard";
                        }
                        else
                        {
                            $('#error').html("<span class='text-danger'>Given username is already taken, please choose another one</span>");
                            document.getElementById("username").style.borderColor = "red";
                        }
                    }
                });
            }
        });
    });
</script>
