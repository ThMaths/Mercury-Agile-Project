<?php
session_start();
require_once("classes/classCommunication.php");

$com = new Communication;

if($_POST['current-password'] != "" && $_POST['new-password'] != ""){ 

    if($_POST['new-password'] != $_POST['confirm-password'])
    {
        $_SESSION['erreur'] = 'Les mots de passes ne correpondent pas !';
        header("location: ./profile.php");
        exit();
    }

    $ident = htmlentities($_SESSION['id_user']);
    $collaborators =  $com->SendQuery("SELECT * FROM collaborators WHERE id = '$ident';",true); 

    $pwd = "";

    while ($row = $collaborators->fetch(PDO::FETCH_ASSOC)) {
        $pwd = $row['password'];
    }

    if($pwd == $_POST['current-password'])
    {
        $com->SendQuery("UPDATE collaborators SET password =".$_POST['new-password']." WHERE id =".$ident,false);
        header("location: ./profile.php");
        exit();
    }
    else {
        $_SESSION['erreur'] = 'Erreur : Mauvais mot de passe';
        header("location: ./profile.php");
        exit();
    }
}
else{ //gestion si les champs ne sont pas tous remplis
    $_SESSION['erreur'] = 'Erreur : Vous devez remplir tous les champs !';
    header("location: ./profile.php");
	exit();
}

?>