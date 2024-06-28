<?php
session_start();
require_once("classes/classCommunication.php");
$com = new Communication;


if(isset($_POST['Valider']) && $_POST['connexion_id'] != "" && $_POST['connexion_mdp'] != ""){ 

    $ident = htmlentities($_POST['connexion_id']);
    $collaborators =  $com->SendQuery("SELECT * FROM collaborators WHERE identifiant = '$ident';",true); 

    if($collaborators->rowCount() >= 1){
        foreach($collaborators as $valeur){
            if(htmlentities($_POST['connexion_mdp']) == $valeur['password']){
                $_SESSION['id_user'] = $valeur["id"];
                $_SESSION['erreur'] = '';
                header("location: ./web.php");
            }
            else
            {//gestion si mdp incorrect
                $_SESSION['erreur'] = 'Erreur : Mot de passe incorrect';
                header("location: ./form.php");
                exit();
            }
        }
    }
    else //gestion si aucun utilisateur trouvé
    {
        $_SESSION['erreur'] = 'Erreur : Aucun opérateur trouvé (mdp ou id incorrect)';
        header("location: ./form.php");
	    exit();
    }
    
    
}
else{ //gestion si les champs ne sont pas tous remplis
    $_SESSION['erreur'] = 'Erreur : Vous devez remplir tous les champs !';
    header("location: ./form.php");
	exit();
}
?>