<?php 

include('connection.php');

include('classes/db.php');

$db = new DB();

$oid=$_GET['order_id'];
/* original code
$q=mysqli_query($con,"delete from  room_booking_details where id='$oid' ");

if($q){
header('location:order.php');
}
*/

//my code
$cancel = $db->cancel_order($oid);

header('location: order.php');

?>