<?php 

    include('connection.php');

    include('classes/db.php');

    $db = new DB();

    $oid=$_GET['order_id'];

    $cancel = $db->cancel_order($oid);

    header('location: order.php');

?>