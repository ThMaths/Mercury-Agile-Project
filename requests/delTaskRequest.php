<?php 
    require_once('../classes/classCommunication.php');

    $com = new Communication;
    $id = $_POST['id'];
    $com->DelTask($id);
?>