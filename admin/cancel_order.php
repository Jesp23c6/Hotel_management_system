<?php 
    require('../classes/db.php');

    $db = new DB();

    $oid=$_GET['booking_id'];

    $delete = $db->admin_delete_order($oid);

    header('location:dashboard.php?option=booking_details');

?>  