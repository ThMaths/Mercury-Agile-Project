<?php
  require_once("classes/classUtilisateur.php");
    session_start();

  if(!isset($_SESSION['id_user'])){
    $_SESSION["erreur"] = "Déconnecté";
    header("location: ./index.php");
  }

  $user = new Utilisateur();
  $user->getUserInfo($_SESSION["id_user"])

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="container mt-5">
        <div class="header-nav text-center">
            <a href="web.php">Retour à l'accueil</a>
        </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h1>Profil Utilisateur</h1>
            </div>
            <div class="card-body">
                <div class="profile-info mb-4">
                    <p><strong>Nom :</strong> <span id="user-name"><?php echo $user->nom ?></span></p>
                    <p><strong>Adresse mail :</strong> <span id="user-email"><?php echo $user->email ?></span></p>
                </div>
                <div class="change-password">
                    <h2 class="text-center">Changer le mot de passe</h2>
                    <form id="password-form" action="./change_password.php" method="post">
                        <div class="form-group">
                            <label for="current-password">Mot de passe actuel :</label>
                            <input type="password" class="form-control" id="current-password" name="current-password" required>
                        </div>
                        <div class="form-group">
                            <label for="new-password">Nouveau mot de passe :</label>
                            <input type="password" class="form-control" id="new-password" name="new-password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirmer le nouveau mot de passe :</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Changer le mot de passe</button>
                    </form>

                    <?php
                if( isset($_SESSION['erreur'])  && $_SESSION['erreur'] != null){
                    echo '<br><div style="color: red;">'.$_SESSION['erreur'].'</div>';
                    $_SESSION['erreur'] = "";
                }
            ?>  
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
