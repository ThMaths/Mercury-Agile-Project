<?php 
    require_once('../classes/classCommunication.php');

    $com = new Communication;
    $id = $_POST['id'];
    $date = $_POST['date'];

    $com->ChangeTaskDate($date, $id);
?>