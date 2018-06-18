<?php Session::init(); ?>

<div align="center">
    <button type="button" name="add" id="add" class="btn btn-success">Add</button>
</div>
<br />
<table class="table table-bordered table-striped">
    <tr>
        <th width=\"40%\">Image</th>
        <th width=\"10%\">Text</th>
        <th width=\"10%\">Change</th>
        <th width=\"10%\">Remove</th>
    </tr>

<h1><?php
    $user_id = $_SESSION['user_id'];
    $array = $_SESSION['array'];
    foreach($array as &$data) {
        echo "
				<tr>
				<td>";
        echo '<img  src="data:image/jpeg;base64,' . $data["image"] . '" height="60" width="75" class="img-thumbnail" >';
    echo " </td>";
        echo " </td>
                <td>".$data["text"]."</td>
				<td><button type='button' name='update' class='btn btn-warning bt-xs update' id=" . $data["id"] . ">
				Change</button></td>
				<td><button type='button' name='delete' class='btn btn-danger bt-xs delete' id=" . $data["id"] . ">
				Remove</button></td>
				</tr>
				";
    }
    ?>
</table>
<br />

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
                    <input type="text" name="text" id="text" placeholder="Write a comment"/><br />
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
                        url:"<?php echo URL;?>users/imageInsertEditDelete?user_id=<?php echo $user_id; ?>",
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
            if (confirm("Are you sure you want to remove this image?"))
            {
                $.ajax({
                    url:"<?php echo URL;?>users/imageInsertEditDelete",
                    method:"POST",
                    data:{image_id:image_id,action:action},
                    success:function(data)
                    {
                        alert(data);
                        location.reload();
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