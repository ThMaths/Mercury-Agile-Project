<?php 
    require_once('../classes/classCommunication.php');

    $com = new Communication;
    $name = $_POST['name'];
    $com->AddCollaborator($name);
?>