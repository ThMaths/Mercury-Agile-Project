<!DOCTYPE html>
<html lang="en">
<?php
  require_once("ClassConnexion.php");
  $con = new Connexion("mysql:host=localhost;dbname=mercury_db","root","root");
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion de tâches</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .body{
      padding-bottom: 10%;
    }
    .fixed-height {
      height: 30vh; /* Hauteur fixe à 40% de la hauteur de la fenêtre */
      overflow-y: auto; /* Ajout d'une barre de défilement si le contenu dépasse */
    }
    .task-card {
      border: 2px solid #000; /* Bordure noire pour tous les blocs */
      border-radius: 10px; /* Coins arrondis */
    }
    .bg-important-urgent {
      border-color: #dc3545; /* Rouge */
    }
    .bg-important-not-urgent {
      border-color: #ffc107; /* Jaune */
    }
    .bg-not-important-urgent {
      border-color: #007bff; /* Bleu */
    }
    .bg-not-important-not-urgent {
      border-color: #6c757d; /* Gris */
    }

    /* Réduire l'opacité des boutons */
    .left-buttons button {
      opacity: 0.8;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="mt-5 mb-4 text-center">Gestion de tâches</h1>
    <div class="row">
      <!-- Colonne de gauche avec les boutons "Supprimer tout" et "Déléguer" -->
      <div class="col-md-2 left-buttons">
        <div class="text-center mb-3">
          <button class="btn btn-danger" onclick="deleteAllTasks()">Supprimer tout</button>
        </div>
        <div class="text-center">
          <button class="btn btn-success" onclick="promptForName()">Déléguer</button>
        </div>
      </div>
      <!-- Colonne de droite avec la liste des tâches -->
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6">
            <div class="card fixed-height bg-important-urgent task-card">
              <div class="card-body">
                <h2 class="card-title">Important et Urgent</h2>
                <ul id="importantUrgentTasks" class="list-group"></ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card fixed-height bg-important-not-urgent task-card">
              <div class="card-body">
                <h2 class="card-title">Important mais Pas Urgent</h2>
                <ul id="importantNotUrgentTasks" class="list-group"></ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6">
            <div class="card fixed-height bg-not-important-urgent task-card">
              <div class="card-body">
                <h2 class="card-title">Pas Important mais Urgent</h2>
                <ul id="notImportantUrgentTasks" class="list-group"></ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card fixed-height bg-not-important-not-urgent task-card">
              <div class="card-body">
                <h2 class="card-title">Pas Important et Pas Urgent</h2>
                <ul id="notImportantNotUrgentTasks" class="list-group"></ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-6">
        <input type="text" id="taskInput" class="form-control" placeholder="Ajouter une tâche...">
      </div>
      <div class="col-md-4">
        <select id="prioritySelect" class="form-select">
        <?php
          $query = "SELECT id, name FROM priority_level" ; //On fait une requete pour récuperer
          $ligne = $con->GetPdo()->query($query) ;
          if ($ligne) {
            // Itération sur les résultats
            while ($row = $ligne->fetch(PDO::FETCH_ASSOC)) {
              // Affichage des données
              echo "<option value='".$row['id']."'>".$row['name']."</option>";
            }
          } else {
            // Gestion de l'erreur si la requête échoue
            echo "Erreur lors de l'exécution de la requête.";
          }
          ?>
        </select>
      </div>
      <div class="col-md-2">
        <button onclick="addTask()" class="btn btn-primary">Ajouter</button>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
  <!-- JavaScript file -->
  <script src="script.js"></script>
</body>
</html>
