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
  <link href="css/style.css" rel="stylesheet">
</head>
<body>


<div class="overlay" id="overlay">
        <div class="window">
            <h2>Creer une tâche</h2>
            <input type="text" id="taskInputOverlay" class="form-control" placeholder="Ajouter une tâche...">
            <button id="create" onclick="addTaskOverlay()">Valider</button>
            <button id="closeButton" onclick="closeWindow()">Fermer</button>
        </div>
    </div>

  <div class="container page-content">
    <div class="title-container" style="display: flex; align-items: center; justify-content: center; margin-top: 20px; margin-bottom: 10px">
      <dotlottie-player src="https://lottie.host/62031d7b-0744-4397-b7d3-7d3f7b0e2f21/8k0qftz8l7.json" background="transparent" style="width: 3em; height: 3em; margin-right: 10px; margin-bottom: 5px" speed="1" loop autoplay></dotlottie-player>
      <h1 stule="margin: 0; font-size: 2em;">Gestion de tâches</h1>
    </div>
    <div class="row">
      <div class="col-md-2 left-buttons">
        <br>
        <div class="text-center">
          <button class="btn btn-success" onclick="promptForName()">Ajouter des délégués</button>
        </div>
        <div style="text-align: center;">
          <table id="collaboratorsList" style="margin: 0 auto;">
            <th> Collaborateurs</th>
            <?php $com->DisplayCollaborators() ?>
          </table>
        </div>
      </div>
      <div class="col-md-10" id="task">
        <div class="row mt-3">
          <div class="col-md-6">
            <input type="text" id="taskInput" class="form-control" placeholder="Ajouter une tâche...">
          </div>
          <div class="col-md-4">
            <select id="prioritySelect" class="form-select">
              <?php $com->DisplayPriorityLevel(); ?>
            </select>
          </div>
          <div class="col-md-2">
            <button class="animated-button" onclick="addTask()">
              <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
              </svg>
              <span class="text">Ajouter</span>
              <span class="circle"></span>
              <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
              </svg>
            </button>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
          <div id ="1" class = "clickable-zone">
            <div class="card fixed-height bg-important-urgent task-card">
              <div class="card-body">
                  <h2 class="card-title" onclick="ImportantAndUrgent()">Important et Urgent</h2>
                  <ul id="importantUrgentTasks" class="list-group list-group-flush">
                    <?php $com->DisplayTasksFromPriority(1); ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
          <div id ="2" class = "clickable-zone">
            <div class="card fixed-height bg-important-not-urgent task-card">
              <div class="card-body">
                <h2 class="card-title" onclick="ImportantNotUrgent()">Important mais Pas Urgent</h2>
                <ul id="importantNotUrgentTasks" class="list-group list-group-flush">
                  <?php $com->DisplayTasksFromPriority(2); ?>
                </ul>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6">
          <div id ="3" class = "clickable-zone">
            <div class="card fixed-height bg-not-important-urgent task-card">
              <div class="card-body">
                <h2 class="card-title" onclick="NotImportantButUrgent()">Pas Important mais Urgent</h2>
                <ul id="notImportantUrgentTasks" class="list-group list-group-flush">
                  <?php $com->DisplayTasksFromPriority(3); ?>
                </ul>
              </div>
            </div>
          </div>
          </div>
          <div class="col-md-6">
          <div id ="4" class = "clickable-zone">
            <div class="card fixed-height bg-not-important-not-urgent task-card">
              <div class="card-body">
                <h2 class="card-title" onclick="NotImportantNotUrgent()">Pas Important et Pas Urgent</h2>
                <ul id="notImportantNotUrgentTasks" class="list-group list-group-flush">
                  <?php $com->DisplayTasksFromPriority(4); ?>
                </ul>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="text-center mb-3">
          <br>
          <button class="btn btn-danger" onclick="deleteAllTasks()">Supprimer tâches terminées</button>
        </div>
      </div>
    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="position: fixed; bottom: 0; left: 0; width: 100%; height: auto; z-index: -1;">
    <path fill="#0099ff" fill-opacity="1" d="M0,224L40,197.3C80,171,160,117,240,122.7C320,128,400,192,480,197.3C560,203,640,149,720,144C800,139,880,181,960,176C1040,171,1120,117,1200,117.3C1280,117,1360,171,1400,197.3L1440,224L1440,320L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
  </svg>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"></script>
  <!-- JavaScript file -->
  <script src="scripts/script.js"></script>
</body>
</html>
