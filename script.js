function addTask() {
  var taskInput = document.getElementById("taskInput");
  var taskText = taskInput.value.trim();
  var prioritySelect = document.getElementById("prioritySelect");
  var priority = prioritySelect.value;

  if (taskText !== "") {
    if (priority === "") {
      alert("Erreur : Veuillez sélectionner une priorité.");
    } else {
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
      prioritySelect.value = "";
    }
  }
}
