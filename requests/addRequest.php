<?php 
    require_once('../classes/classCommunication.php');

    $com = new Communication;
    $priorityLevel = $_POST['priorityLevel'];
    $title = $_POST['title'];
    $com->AddNewTask($priorityLevel,$title);
?>