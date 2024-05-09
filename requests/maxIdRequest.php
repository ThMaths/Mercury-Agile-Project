<?php 
    require_once('../classes/classCommunication.php');

    $com = new Communication;
    $id = $com->GetLastId();
    echo $id;
?>