<?php 
    require_once('../classes/classCommunication.php');

    $com = new Communication;
    $id = $_POST['collaborator_id'];
    $com->desactivateCollaborator($id);
?>