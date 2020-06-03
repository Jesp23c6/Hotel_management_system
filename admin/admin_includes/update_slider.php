<?php 
	$id=$_GET['id'];

	$slider = $db->get_slider($id);

	$res = $slider->fetch_assoc();

	$img = $res['image'];

	$path = "../image/Slider/$img";


	if(isset($update)){

		$imgNew=$_FILES['img']['name'];

		if($imgNew==""){

			$db->update_slider($cap, $id);

			header('location:dashboard.php?option=slider');	

		}
		else{

			$db->update_slider_img($cap, $imgNew, $id);

			//delete old image
			unlink($path);
			move_uploaded_file($_FILES['img']['tmp_name'],"../image/Slider/".$_FILES['img']['name']);

			header('location:dashboard.php?option=slider');	

		}
		
	}
?>
<form method="post" enctype="multipart/form-data">
<table class="table table-bordered">
	<tr style="height:40">
		<th>Caption</th>
		<td><input type="text" name="cap" value="<?php echo $res['caption']; ?>" class="form-control"/></td>
	</tr>
	<tr>	
		<th>Image</th>
		<td><input type="file" name="img" accept="image/*" class="form-control"/>
		<img src="<?php echo $path; ?>" height="100px" width="100px"/>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" class="btn btn-primary" value="Update" name="update"/>
		</td>
	</tr>
</table> 
</form>