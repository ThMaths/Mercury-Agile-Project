<?php
session_start();
unset($_SESSION['id_user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/form.css">
    <title>Connexion</title>
</head>
<body>
    <div class="content">
        <h1>Connexion</h1>
        <form class="form" action="./connexion_form.php" method="post">
            <p>
                <label for="">Identifiant</label><br>
                <input type="email" id="connexion_id" name="connexion_id" required>
            </p>
            <p>
                <label for="">Mot de passe</label><br>
                <input type="password" id="connexion_mdp" name="connexion_mdp" required><br>
            </p>

            <button type="submit" id="Valider" name="Valider">Se connecter</button><br>
            <?php
                if( isset($_SESSION['erreur'])  && $_SESSION['erreur'] != null){
                    echo '<br><div style="color: red;">'.$_SESSION['erreur'].'</div>';
                    $_SESSION['erreur'] = "";
                }
            ?>  

        </form>
    </div>   
</body>
</html>