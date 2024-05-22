document.write('<script src="scripts/requests.js"></script>');

function addTask() {
  var taskInput = document.getElementById("taskInput");
  var taskText = taskInput.value.trim();
  var prioritySelect = document.getElementById("prioritySelect");
  var priority = prioritySelect.value;

  if (taskText !== "") {
    if (priority === "") {
      alert("Erreur : Veullez sélectionner une priorité.");
    } else {
      SendAddRequest(priority, taskText, function (response) {
        if (response != "") {
          alert(response);
          return;
        } else {
          var taskList = GetTaskList(priority);
          SendMaxIdRequest(function (liId) {
            if (/[a-zA-Z]/.test(liId)) {
              alert(
                "La tâche ne peux pas être affichée. Veuillez recharger la page pour l'afficher. Cause : "
                  .liId
              );
              return;
            } else CreateLineInTaskList(taskList, liId, taskInput, taskText, prioritySelect);
          });
        }
      });
    }
  }
}

function GetTaskList(priority) {
  var taskList = document.getElementById("notImportantNotUrgentTasks"); // Par défaut
  if (priority === "1") {
    taskList = document.getElementById("importantUrgentTasks");
  } else if (priority === "2") {
    taskList = document.getElementById("importantNotUrgentTasks");
  } else if (priority === "3") {
    taskList = document.getElementById("notImportantUrgentTasks");
  }
  return taskList;
}

function CreateLineInTaskList(
  taskList,
  liId,
  taskInput,
  taskText,
  prioritySelect
) {
  var li = document.createElement("li");
  li.id = "task" + liId;
  li.classList.add("list-group-item");

  var box = document.createElement("input");
  box.setAttribute("type", "checkbox");
  box.name = "checkboxTask";
  box.id = liId;
  box.addEventListener("change", function () {
    CheckboxChange.call(this);
  });

  var button = document.createElement("button");
  button.textContent = "X";
  button.classList.add("btn", "btn-primary", "btn-sm");
  button.onclick = function () {
    deleteTask(liId);
  };

  li.appendChild(box);
  li.appendChild(document.createTextNode("  " + taskText + " "));

  var space = document.createElement("span");
  space.innerHTML = "&nbsp;&nbsp;&nbsp";
  li.append(space);

  if (prioritySelect.value == 3) {
    SendGetCollaboratorRequest(function (collaborators) {
      var selectElement = document.createElement("select");
      selectElement.id = "choix" + liId;
      selectElement.disabled = false;
      selectElement.name = "choix";
      var aucun = document.createElement("option");
      aucun.text = "Aucun";
      selectElement.add(aucun);

      collaborators.forEach(function (collaborator) {
        var option = document.createElement("option");
        option.text = collaborator.name;
        option.value = collaborator.id;
        selectElement.add(option);
      });

      selectElement.addEventListener("change", function () {
        SendDelegateTaskRequest(selectElement, liId);
      });

      var lock = document.createElement("span");
      lock.id = "lock" + liId;
      lock.classList.add("material-symbols-outlined");
      lock.textContent = "lock_open";
      lock.addEventListener("click", function () {
        LockUnlockSelect(liId);
      });

      li.appendChild(selectElement);
      li.appendChild(button);
      li.appendChild(lock);
      taskList.appendChild(li);
      taskInput.value = "";
    });
  } else if (prioritySelect.value == 2) {
    var date = document.createElement("input");
    date.type = "date";
    date.id = "date" + liId;
    date.disabled = false;
    date.addEventListener("change", function () {
      SendTaskDateRequest(this, liId);
    });

    var lock = document.createElement("span");
    lock.id = "lock" + liId;
    lock.classList.add("material-symbols-outlined");
    lock.textContent = "lock_open";
    lock.addEventListener("click", function () {
      LockUnlockDate(liId);
    });

    li.appendChild(date);
    li.appendChild(button);
    li.appendChild(lock);
    taskList.appendChild(li);
    taskInput.value = "";
  } else {
    li.appendChild(button);
    taskList.appendChild(li);
    taskInput.value = "";
    //prioritySelect.value = "";
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
    for (var i = 0; i <= allTaskLists.length; i++) {
      if (taskList == null) {
        taskList = allTaskLists[i];
      }
    }

    var newCheckBox = document.createElement("input");
    newCheckBox.type = "checkbox";

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
  window.location.href = "tabs/important_and_urgent.html";
}

function ImportantNotUrgent() {
  window.location.href = "tabs/important_not_urgent.html";
}

function NotImportantButUrgent() {
  window.location.href = "tabs/not_important_but_urgent.html";
}

function NotImportantNotUrgent() {
  window.location.href = "tabs/not_important_not_urgent.html";
}

function deleteAllTasks() {
  const element1 = document.getElementById("importantUrgentTasks");
  const element2 = document.getElementById("importantNotUrgentTasks");
  const element3 = document.getElementById("notImportantUrgentTasks");
  const element4 = document.getElementById("notImportantNotUrgentTasks");
  const tab = [];
  tab.push(element1, element2, element3, element4);
  for (const element of tab) {
    for (const child of element.children) {
      if (child.style.getPropertyValue("text-decoration") == "line-through") {
        child.remove();
      }
    }
  }
  SendDelRequest();
}

function deleteTask(id) {
  var name = "task" + id;
  var task = document.getElementById(name);
  task.remove();
  SendDelTaskRequest(id);
}

function promptForName() {
  var name = prompt(
    "Entrez le nom de la personne à qui vous souhaitez déléguer la tâche :"
  );
  if (name !== null && name !== "") {
    const element = document.getElementById("collaboratorsList");
    console.log(element);
    for (const child of element) {
      console.log(child);
      if (child) {
      }
    }
    SendAddCollaboratorRequest(name);
    SendGetCollaboratorLastIdRequest(function (id) {
      addDelegateToList(name, id);
    });
  }
}

function addDelegateToList(name, id) {
  var delegateList = document.getElementById("collaboratorsList");
  var newTr = document.createElement("tr");
  var newTd = document.createElement("td");
  newTd.textContent = name;
  newTr.appendChild(newTd);
  delegateList.appendChild(newTr);

  var optionCollaborator = document.createElement("option");
  optionCollaborator.value = id;
  optionCollaborator.textContent = name;

  var selects = document.getElementsByName("choix");
  selects.forEach(function (select) {
    select.appendChild(optionCollaborator);
  });
}

document.addEventListener("DOMContentLoaded", function () {
  // A Supprimer :  Placer l'event directement dans l'attribut onchange de l'input
  var checkboxes = document.querySelectorAll("input[name='checkboxTask']");

  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
      CheckboxChange.call(this);
    });
  });
});

function LockUnlockSelect(id) {
  console.log(id);
  var select = document.getElementById("choix" + id);
  var lock = document.getElementById("lock" + id);
  select.disabled = !select.disabled;
  lock.textContent = select.disabled ? "lock" : "lock_open";
}

function LockUnlockDate(id) {
  console.log(id);
  var dateInput = document.getElementById("date" + id);
  var lock = document.getElementById("lock" + id);
  dateInput.disabled = !dateInput.disabled;
  lock.textContent = dateInput.disabled ? "lock" : "lock_open";
}

function CheckboxChange() {
  var name = "task" + this.id;
  console.log(name);
  var task = document.getElementById(name);

  if (this.checked) {
    console.log("Checkbox avec la valeur " + this.value + " est cochée");
    SendTaskDoneRequest(this.id);
    task.style.textDecoration = "line-through";
  } else {
    console.log("Checkbox avec la valeur " + this.value + " est décochée");
    SendTaskNotDoneRequest(this.id);
    task.style.textDecoration = "";
  }
}
