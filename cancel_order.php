<?php 

include('connection.php');

include('classes/db.php');

$db = new DB();

$oid=$_GET['order_id'];

//my code
$cancel = $db->cancel_order($oid);

header('location: order.php');

?>