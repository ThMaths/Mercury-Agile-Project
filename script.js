function addTask() {
    var taskInput = document.getElementById("taskInput");
    var taskText = taskInput.value.trim();
    if (taskText !== "") {
      var taskList = document.getElementById("notImportantNotUrgentTasks");
      var priority = prompt("Entrez la priorité de la tâche (1: Important et Urgent, 2: Important mais Pas Urgent, 3: Pas Important mais Urgent, 4: Pas Important et Pas Urgent)");
      if (priority === "1") {
        taskList = document.getElementById("importantUrgentTasks");
      } else if (priority === "2") {
        taskList = document.getElementById("importantNotUrgentTasks");
      } else if (priority === "3") {
        taskList = document.getElementById("notImportantUrgentTasks");
      } else if (priority === "4") {
        taskList = document.getElementById("notImportantNotUrgentTasks");
      }
      var li = document.createElement("li");
      li.textContent = taskText;
      taskList.appendChild(li);
      taskInput.value = "";
    }
  }
  