<?php 
    require_once('../classes/classCommunication.php');

    $com = new Communication;
    $result = $com->GetCollaborators();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);
?>