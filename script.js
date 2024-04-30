function addTask() {
  var taskInput = document.getElementById("taskInput");
  var taskText = taskInput.value.trim();
  if (taskText !== "") {
    var priority = prompt("Entrez la priorité de la tâche (1: Important et Urgent, 2: Important mais Pas Urgent, 3: Pas Important mais Urgent, 4: Pas Important et Pas Urgent)");
    if (priority === "1" || priority === "2" || priority === "3" || priority === "4") {
      var taskList = document.getElementById("notImportantNotUrgentTasks"); // Par défaut
      if (priority === "1") {
        taskList = document.getElementById("importantUrgentTasks");
      } else if (priority === "2") {
        taskList = document.getElementById("importantNotUrgentTasks");
      } else if (priority === "3") {
        taskList = document.getElementById("notImportantUrgentTasks");
      }
      var li = document.createElement("li");
      li.textContent = taskText;
      taskList.appendChild(li);
      taskInput.value = "";
    } else {
      alert("Erreur : Veuillez entrer une priorité valide (1, 2, 3 ou 4).");
    }
  }
}
