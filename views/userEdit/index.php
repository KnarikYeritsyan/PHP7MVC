<?php Session::init(); ?>
<h1>User</h1>

<?php $id = $data['id']; $username = $data['username'];
$password = $data['password'];
$firstname = $data['first_name']; $lastname = $data['last_name'];
?>

<div style = "padding: 100px 100px 10px;">

    <form class = "bs-example bs-example-form" action="users/edit" method="post" id="EditForm">
        <div class = "row">

            <div class = "col-lg-8">
                <div class = "form-inline">
                    <label >Username</label>
                    <input type = "text" class = "form-control" name = "username" placeholder="Enter username" value="<?php echo $username; ?>" id="username" />
                </div>
            </div><br>
            <div class = "col-lg-8">
                <div class = "form-inline">
                    <label >Password</label>
                    <input type="password" name = "password" placeholder="Enter password" class = "form-control" value="<?php echo $password; ?>" id="password"  />
                </div>
                <div class = "form-inline">
                    <label >First Name</label>
                    <input type = "text" class = "form-control" name = "first_name" placeholder="Enter first name" value="<?php echo $firstname; ?>" id="firstname" />
                </div>
                <div class = "form-inline">
                    <label >Last Name</label>
                    <input type = "text" class = "form-control" name = "last_name" placeholder="Enter last name" value="<?php echo $lastname; ?>" id="lastname" />
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
                <label></label><input class="btn btn-primary" type="submit" value="Submit changes" name="submitchanges"/>

            </div>

        </div>

    </form>

</div>

<script>
    $(document).ready(function () {

        $('#EditForm').submit(function (event) {
            event.preventDefault();
            var id = <?php echo $id; ?>;
            var username = $('#username').val();
            var password = $('#password').val();
            var first_name = $('#firstname').val();
            var last_name = $('#lastname').val();
            if($('#remember').is(":checked")) {
                var remember =1;
            } else {
                remember =0;
            }
            if ($.trim(password).length < 5)
            {
                $('#error').html("<span class='text-danger'>The minimum password length is 5</span>");
                document.getElementById("password").style.borderColor = "red";
                return false;
            }
            if ($.trim(username).length > 0 && $.trim(password).length > 5)
            {

                $.ajax({
                    url:"<?php echo URL;?>users/edit",
                    method:"POST",
                    data:{username:username, password:password,first_name:first_name,last_name:last_name,id:id, remember:remember},
                    cashe:false,
                    success:function (data) {
                        if (data)
                        {
                            //confirm("Are you sure you want to submit changes?");
                            $("body").hide();
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
            else
            {
                $('#error').html("<span class='text-danger'>Username and password are mandatory</span>");
                document.getElementById("username").style.borderColor = "red";
                document.getElementById("password").style.borderColor = "red";
                return false;
            }
        });
    });
</script>
