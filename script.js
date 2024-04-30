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

function addTask2() {
  var taskInput = document.getElementById("taskInput");
  var taskText = taskInput.value.trim();

  if (taskText !== "") {
      taskList1 = document.getElementById("importantUrgentTasks");
      taskList2 = document.getElementById("notImportantNotUrgentTasks");
      taskList3 = document.getElementById("importantNotUrgentTasks");
      taskList4 = document.getElementById("notImportantUrgentTasks");

      allTaskLists = [taskList1, taskList2, taskList3, taskList4];
      
      var taskList = null;
      for (var i=0; i<=allTaskLists.length; i++) {
        if(taskList == null) {
          taskList = allTaskLists[i];
        }
      }

      var newCheckBox = document.createElement('input');
      newCheckBox.type = 'checkbox';

      var label = document.createElement("label");
      label.textContent = taskText;

      var div = document.createElement("div");
      div.appendChild(newCheckBox);
      div.appendChild(label);
      taskList.appendChild(div);

      taskInput.value = "";
  }
}

function ImportantAndUrgent() {
  window.location.href = "/important_and_urgent.html";
}

function ImportantNotUrgent() {
  window.location.href = "/important_not_urgent.html";
}

function NotImportantButUrgent() {
  window.location.href = "/not_important_but_urgent.html";
}

function NotImportantNotUrgent() {
  window.location.href = "/not_important_not_urgent.html";
}
