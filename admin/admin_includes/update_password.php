<?php 

    if(isset($update)){

        $login_check = $db->admin_login($admin, $op);

        if($login_check > 0){

            if($np == $cp){

                $db->update_admin_pass($admin, $np);

                echo("<h3 style='color:blue'>Password updated successfully</h3>");

            }
            else{

                echo("<h3 style='color:red'>New and confirm doesn't match</h3>");

            }

        }
        else{

            echo("<h3 style='color:red'>Old Password doesn't match</h3>");

        }

    }

    /*
	if(isset($update)){
		$sql=mysqli_query($con,"select * from admin where username='$admin' and password='$op' ");
		if(mysqli_num_rows($sql)){
			if($np==$cp){
				mysqli_query($con,"update admin set password='$np' where username='$admin' ");	
				echo "<h3 style='color:blue'>Password updated successfully</h3>";
			}
			else{
				echo "<h3 style='color:red'>New and confirm doesn't match</h3>";
			}
		}
		else{
			echo "<h3 style='color:red'>Old Password doesn't match</h3>";	
		}
		
    }
    */
?>
<form method="post" enctype="multipart/form-data">
    <table class="table table-bordered table-striped table-hover">
        <h1>Update Password</h1>
        <hr>
        <tr style="height:40">
            <th>Enter your old password</th>
            <td><input type="password" name="op" class="form-control" required /></td>
        </tr>

        <tr>
            <th>Enter your new password</th>
            <td><input type="password" name="np" class="form-control" required />
            </td>
        </tr>

        <tr>
            <th>Confirm new password</th>
            <td><input type="password" name="cp" class="form-control" required />
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <input type="submit" class="btn btn-primary" value="Update Password" name="update" required />
            </td>
        </tr>
    </table>
</form>