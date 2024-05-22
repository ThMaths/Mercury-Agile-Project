<!DOCTYPE html>
<html lang="en">
<?php
  require_once("classes/classCommunication.php");
  $com = new Communication;
  
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion de tâches</title>
  <!-- Bootstrap CSS -->
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" />
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1 class="mt-5 mb-4 text-center">Gestion de tâches</h1>
    <div class="row">
      <!-- Colonne de gauche avec les boutons "Supprimer tout" et "Déléguer" -->
      
      <div class="col-md-2 left-buttons">
        <div class="text-center mb-3">
        <br>
          <button class="btn btn-danger" onclick="deleteAllTasks()">Supprimer tâche terminée</button>
        </div>
        <div class="text-center">
          <button class="btn btn-success" onclick="promptForName()">Déléguer</button>
        </div>
        <div style="text-align: center;">
            <table id="collaboratorsList" style="margin: 0 auto;">
              <th> Collaborateurs</th>
              <?php $com->DisplayCollaborators() ?>
            </table>
        </div>
      </div>
      <!-- Colonne de droite avec la liste des tâches -->
      <div class="col-md-10" id="task">
        <div class="row mt-3">
          <div class="col-md-6">
            <input type="text" id="taskInput" class="form-control" placeholder="Ajouter une tâche...">
          </div>
          <div class="col-md-4">
            <select id="prioritySelect" class="form-select">
            <?php
                $com->DisplayPriorityLevel();
              ?>
            </select>
          </div>
          <div class="col-md-2">
            <!--<button onclick="addTask()" class="btn btn-primary">Ajouter</button> -->
            <button class="animated-button" onclick="addTask()">
              <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
              </svg>
              <span class="text">Ajouter</span>
              <span class="circle"></span>
              <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                ></path>
              </svg>
            </button>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6" >
            <div class="card fixed-height bg-important-urgent task-card">
              <div class="card-body">
                <h2 class="card-title" onclick="ImportantAndUrgent()">Important et Urgent</h2>
                <ul id="importantUrgentTasks" class="list-group list-group-flush">
                <?php
                  $com->DisplayTasksFromPriority(1);
                ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6" >
            <div class="card fixed-height bg-important-not-urgent task-card">
              <div class="card-body">
                <h2 class="card-title" onclick="ImportantNotUrgent()">Important mais Pas Urgent</h2>
                <ul id="importantNotUrgentTasks" class="list-group list-group-flush">
                <?php
                  $com->DisplayTasksFromPriority(2)
                ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6" >
            <div class="card fixed-height bg-not-important-urgent task-card">
              <div class="card-body">
                <h2 class="card-title" onclick="NotImportantButUrgent()">Pas Important mais Urgent</h2>
                <ul id="notImportantUrgentTasks" class="list-group list-group-flush">
                <?php
                  $com->DisplayTasksFromPriority(3)
                ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6" >
            <div class="card fixed-height bg-not-important-not-urgent task-card">
              <div class="card-body">
                <h2 class="card-title" onclick="NotImportantNotUrgent()">Pas Important et Pas Urgent</h2>
                <ul id="notImportantNotUrgentTasks" class="list-group list-group-flush">
                <?php
                  $com->DisplayTasksFromPriority(4)
                ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
  <!-- JavaScript file -->
  <script src="scripts/script.js"></script>
</body>
</html>