<?php 
    require_once('../classes/classCommunication.php');

    $com = new Communication;
    $id = $com->GetCollaboratorsMaxId();
    echo $id;
?>