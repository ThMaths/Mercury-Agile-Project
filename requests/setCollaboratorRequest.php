<?php 
    require_once('../classes/classCommunication.php');

    $com = new Communication;
    $collaborator = $_POST['collaborator'];
    $id = $_POST['id'];
    $com->SetCollaborator($collaborator,$id);
?>