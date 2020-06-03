<?php 

    if(isset($update)){

        $img = $_FILES['img']['name'];

        $add_slide = $db->add_slider($img, $cap);

        if($add_slide > 0){

            move_uploaded_file($_FILES['img']['name', "../image/Slider/" . $_FILES['img']['name']]);

            header('location: dashboard.php?option=slider');

        }

    }

    /*
	if(isset($update)){
		$imgNew=$_FILES['img']['name'];
		
		$sql="insert into slider values('','$img','$cap')";	
		
		if(mysqli_query($con,$sql)){
			move_uploaded_file($_FILES['img']['tmp_name'],"../image/Slider/".$_FILES['img']['name']);	
			header('location:dashboard.php?option=slider');	
		}
		
    }
    */
?>
<form method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
        <tr style="height:40">
            <th>Caption</th>
            <td><input type="text" name="cap" class="form-control" /></td>
        </tr>
        <tr>
            <th>Image</th>
            <td><input type="file" name="img" accept="image/*" class="form-control" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" class="btn btn-primary" value="Add new Slider" name="update" />
            </td>
        </tr>
    </table>
</form>