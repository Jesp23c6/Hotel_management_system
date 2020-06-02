<?php 
    include('../connection.php');

    require('../classes/db.php');

    $db = new DB();

    $id=$_GET['id'];

    $result = $db->get_slider($id);

    $img = $result->fetch_assoc();

    unlink('../image/Slider/' . $img['image']);

    $db->delete_slider($id);

    header('location: dashboard.php?option=slider');



    /*
    $sql=mysqli_query($con,"select * from slider where id='$id' ");

    $res=mysqli_fetch_assoc($sql);

    $img=$res['image'];

    unlink("../image/Slider/$img");

    if(mysqli_query($con,"delete from slider where id='$id' ")){
        header('location:dashboard.php?option=slider');	
    }
    */

?>