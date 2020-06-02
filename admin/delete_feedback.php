<?php

    require('../classes/db.php');

    $db = new DB();

    $id=$_GET['id'];

    $db->delete_feedback($id);

    header('location: dashboard.php?option=feedback');

?>