<?php 
    include('../connection.php');

    $id=$_GET['id'];

    $res = $db->get_room($id);
    /*
    $sql=mysqli_query($con,"select * from rooms where room_id='$id' ");
    $res=mysqli_fetch_assoc($sql);
    */
    $img = $res['image'];

    unlink("../image/rooms/$img");

    $db->delete_room($id);

    header('location: dashboard.php?option=rooms');	


?>