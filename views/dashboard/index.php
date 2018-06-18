<?php Session::init();
if (!isset($_SESSION["user_id"]))
{
    header('location: ' . URL . 'login');
}
?>
<?php
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"]))
{
    $username1 = $_COOKIE["username"];
    $password1 = $_COOKIE["password"];
    echo $username1.','.$password1;
}
?>

<h1><?php
    $id = $_SESSION['user_id'];
    $username = $_SESSION['username']; $password = $_SESSION['password'];
    $firstname = $_SESSION['firstname']; $lastname = $_SESSION['lastname'];
    $profile = $_SESSION['profile'];
    echo '<span style="color:darkred;text-align:center;">Welcome '.$firstname.'  '.$lastname.'</span>' ; ?></h1>

<br />
<?php if (empty($profile)):?>
    <div align="center">
        <button type="button" name="add" id="add" class="btn btn-success">Add a profile picture</button>
    </div>
    <br />
<?php else:?>

    <?php
    $profile = $_SESSION['profile'];
    if (isset($_SESSION['comment']))
    {
    $comment = $_SESSION['comment'];
   }
    if (!empty($comment))
    {
        echo '<table><th rowspan="2">'. $comment.'</th></table>';
    }
    echo '<table><td rowspan="2"><img  src="data:image/jpeg;base64,' . $profile . '" height="300" width="300" class="img-thumbnail" ></td></table>'; ?>
    <table><td><input type='button' name='update' value="Change" class='btn btn-warning bt-xs update' id="<?php echo $id; ?>">
    <input type='button' name='delete' value="Delete" class='btn btn-danger bt-xs delete' id="<?php echo $id; ?>">
    </td></table>
<?php endif; ?>
<div id="image_data">
</div>
<div id="imageModal" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss ="modal">&times</button>
            <h4 class="modal-title">Add image</h4>
        </div>
        <div class="modal-body">
            <form id="image_form" method="post" enctype="multipart/form-data">
                <p><label>Select Image</label><br />
                    <input type="file" name="image" id="image"/></p><br />
                <p><label>Comment</label><br />
                <input type="text" name="text" id="text" placeholder="Write a comment" value="<?php echo (isset($comment))?$comment:''; ?>" /><br />
                <input type="hidden" name="action" id="action" value="insert"/>
                <input type="hidden" name="image_id" id="image_id"/>
                <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss ="modal">Close</button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('#add').click(function () {
            $('#imageModal').modal('show');
            $('#image_form')[0].reset();
            $('.modal-title').text("Add Image");
            $('#image_id').val('');
            $('#action').val('insert');
            $('#insert').val('Insert');
        });
        $('#image_form').submit(function (event) {
            event.preventDefault();
            var image_name = $('#image').val();
            if (image_name == '')
            {
                alert("Please Select Image");
                return false;
            }
            else
            {
                var extention = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extention,['gif','png','jpg','jpeg'])==-1)
                {
                    alert("Invalid Image File");
                    $('#image').val('');
                    return false;
                }
                else
                {
                    $.ajax({
                        url:"<?php echo URL;?>login/profile?user_id=<?php echo $id; ?>",
                        method:"POST",
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function (data) {
                            alert(data);
                            $('#image_form')[0].reset();
                            $('#imageModal').modal('hide');
                            location.reload();
                        }
                    })
                }
            }
        });
        $(document).on('click','.update',function () {
            $('#image_id').val($(this).attr("id"));
            $('#action').val("update");
            $('.modal-title').text("Update Image");
            $('#insert').val("Update");
            $('#imageModal').modal("show");

        });
        $(document).on('click','.delete',function () {
            var image_id = $(this).attr("id");
            var action = "delete";
            if (confirm("Are you sure you want to remove your profile picture?"))
            {
                $.ajax({
                    url:"<?php echo URL;?>login/profile?user_id=<?php echo $id; ?>",
                    method:"POST",
                    data:{image_id:image_id,action:action},
                    success:function(data)
                    {
                        alert(data);
                        window.location.reload();
                    }
                })
            }
            else
            {
                return false;
            }

        });
    });
</script>