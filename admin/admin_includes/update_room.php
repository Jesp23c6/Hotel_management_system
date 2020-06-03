<?php 
    $id=$_GET['id'];
    
	$res = $db->get_room($id);

	extract($_REQUEST);
	if(isset($update)){

        $db->update_room($rno, $type, $price, $details, $id);
		
        header('location:dashboard.php?option=rooms');
        
	}

?>

<form method="post" enctype="multipart/form-data">
    <table class="table table-bordered">

        <tr>
            <th>Room No</th>
            <td><input type="text" name="rno" value="<?php echo $res['room_no']; ?>" class="form-control" />
            </td>
        </tr>

        <tr>
            <th>Room Type</th>
            <td><input type="text" name="type" value="<?php echo $res['type']; ?>" class="form-control" />
            </td>
        </tr>

        <tr>
            <th>Price</th>
            <td><input type="text" name="price" value="<?php echo $res['price']; ?>" class="form-control" />
            </td>
        </tr>

        <tr>
            <th>Details</th>
            <td><textarea name="details" class="form-control"><?php echo $res['details']; ?></textarea>
            </td>
        </tr>


        <tr>
            <td colspan="2">
                <input type="submit" class="btn btn-primary" value="Update Room Details" name="update" />
            </td>
        </tr>
    </table>
</form>