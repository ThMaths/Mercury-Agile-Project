function addTask() {
  var taskInput = document.getElementById("taskInput");
  var taskText = taskInput.value.trim();
  var prioritySelect = document.getElementById("prioritySelect");
  var priority = prioritySelect.value;

  if (taskText !== "") {
    if (priority === "") {
      alert("Erreur : Veullez sélectionner une priorité.");
    } else {
      SendAddRequest(priority,taskText,function(response){
        if(response !=""){alert(response);return;}
        else{
          var taskList = GetTaskList(priority)   
          SendMaxIdRequest(function(liId)
        {
          if(/[a-zA-Z]/.test(liId)){alert("La tâche ne peux pas être affichée. Veuillez recharger la page pour l'afficher. Cause : ".liId);return;}
          else CreateLineInTaskList(taskList,liId,taskInput,taskText,prioritySelect);
        });
        }       
      })
    }
  }
}

function GetTaskList(priority)
{
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

function CreateLineInTaskList(taskList,liId,taskInput,taskText,prioritySelect)
{
  var li = document.createElement("li");
  li.id = "task"+liId;
  li.classList.add("list-group-item")

  var box = document.createElement("input")
  box.setAttribute("type","checkbox");
  box.name = "checkboxTask";
  box.id = liId;
  box.addEventListener('change', function() {

    CheckboxChange.call(this);
  });


  var button = document.createElement("button");
    button.textContent = "X";
    button.classList.add("btn", "btn-primary", "btn-sm")
    button.onclick = function() {
    deleteTask(liId);
    };

  li.appendChild(box);
  li.appendChild(document.createTextNode("  "+taskText+" "));

  var space = document.createElement("span")
  space.innerHTML = "&nbsp;&nbsp;&nbsp"
  li.append(space)

  if(prioritySelect.value == 3)
    {
      SendGetCollaboratorRequest(function(collaborators)
    {
      var selectElement = document.createElement("select");
      selectElement.id = "choix"+liId;
      selectElement.disabled = false;
      selectElement.name = "choix"
      var aucun = document.createElement("option");
      aucun.text = "Aucun";
      selectElement.add(aucun);

      collaborators.forEach(function (collaborator){

        var option = document.createElement("option");
        option.text = collaborator.name;
        option.value = collaborator.id;
        selectElement.add(option);

      })

      selectElement.addEventListener('change',function(){
        SendDelegateTaskRequest(selectElement,liId)
      })

      var lock = document.createElement("span")
      lock.id = "lock"+liId
      lock.classList.add("material-symbols-outlined")
      lock.textContent = "lock_open"
      lock.addEventListener("click",function(){
        LockUnlockSelect(liId)
      })
                
      li.appendChild(selectElement);
      li.appendChild(button)
      li.appendChild(lock)
      taskList.appendChild(li);
      taskInput.value = "";
    });
    }
    else{
          li.appendChild(button)
          taskList.appendChild(li);
          taskInput.value = "";
  //prioritySelect.value = "";
    }
}

function SendMaxIdRequest(callback)
{
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var idMax = xhr.responseText; 
      callback(idMax);
    }};

  var url = "requests/maxIdRequest.php";
  xhr.open("GET", url, true);
  xhr.send();
}

function SendAddRequest(priority,title,callback)
{
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = xhr.responseText; 
      callback(response);
    }};

  // Ajout des paramètres à l'URL de la requête
  var formData = new FormData();
  formData.append('priorityLevel', priority);
  formData.append('title', title);

  var url = "requests/addRequest.php";
  xhr.open("POST", url, true);
  xhr.send(formData);
}

function SendDelRequest()
{
  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
          // Traitement de la réponse
          console.log(this.responseText);
      }

  var url = "requests/delRequest.php";
  xhr.open("POST", url, true);
  xhr.send();
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
  document.getElementById('importantUrgentTasks').innerHTML = '';
  document.getElementById('importantNotUrgentTasks').innerHTML = '';
  document.getElementById('notImportantUrgentTasks').innerHTML = '';
  document.getElementById('notImportantNotUrgentTasks').innerHTML = '';
  SendDelRequest();
}

function deleteTask(id)
{
  var name = "task"+id
  var task = document.getElementById(name)
  task.remove()
  SendDelTaskRequest(id)
}

function promptForName() {
  var name = prompt("Entrez le nom de la personne à qui vous souhaitez déléguer la tâche :");
  if (name !== null && name !== "") {
    SendAddCollaboratorRequest(name);
    SendGetCollaboratorLastIdRequest(function(id){
      addDelegateToList(name,id);
    })
  }
}

function SendGetCollaboratorLastIdRequest(callback)
{
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        var id = xhr.responseText;
        callback(id)
    }};

  var url = "requests/getCollaboratorLastIdRequest.php";
  xhr.open("GET", url, true);
  xhr.send();
}

function addDelegateToList(name, id) {
  var delegateList = document.getElementById('collaboratorsList');
  var newTr = document.createElement('tr');
  var newTd = document.createElement('td');
  newTd.textContent = name;
  newTr.appendChild(newTd)
  delegateList.appendChild(newTr);

  var optionCollaborator = document.createElement("option")
  optionCollaborator.value = id
  optionCollaborator.textContent = name

  var selects = document.getElementsByName("choix")
  selects.forEach(function(select){
    select.appendChild(optionCollaborator)
  })
}

document.addEventListener("DOMContentLoaded", function() {
    var checkboxes = document.querySelectorAll("input[name='checkboxTask']");

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {

          CheckboxChange.call(this);
        });
    });
});

function LockUnlockSelect(id)
{
  console.log(id)
  var select = document.getElementById("choix"+id)
  var lock = document.getElementById("lock"+id)
  select.disabled = !select.disabled
  lock.textContent =  select.disabled ? "lock" : "lock_open"
}

function CheckboxChange()
{
  var name = "task"+this.id
  console.log(name);
  var task = document.getElementById(name)

    if (this.checked) {
        console.log('Checkbox avec la valeur ' + this.value + ' est cochée');
        SendTaskDoneRequest(this.id)
        task.style.textDecoration = "line-through";
        // Effectuez des actions supplémentaires si nécessaire
    } else {
        console.log('Checkbox avec la valeur ' + this.value + ' est décochée');
        SendTaskNotDoneRequest(this.id)
        task.style.textDecoration = "";
    }
}

function SendTaskDoneRequest(id)
{
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
    }};
      
  var formData = new FormData();
  formData.append('id', id);

  var url = "requests/taskDoneRequest.php";
  xhr.open("POST", url, true);
  xhr.send(formData);
}

function SendTaskNotDoneRequest(id)
{
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
    }};

  var formData = new FormData();
  formData.append('id', id);

  var url = "requests/taskNotDoneRequest.php";
  xhr.open("POST", url, true);
  xhr.send(formData);
}

function SendDelTaskRequest(id)
{
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
    }};

  var formData = new FormData();
  formData.append('id', id);

  var url = "requests/delTaskRequest.php";
  xhr.open("POST", url, true);
  xhr.send(formData);
}

function SendAddCollaboratorRequest(name)
{
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
    }};

  var formData = new FormData();
  formData.append('name', name);

  var url = "requests/addCollaboratorRequest.php";
  xhr.open("POST", url, true);
  xhr.send(formData);
}

function SendGetCollaboratorRequest(callback) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
          var data = JSON.parse(xhr.responseText);
          console.log(data);
          callback(data);
      }
  };
  xhr.open("GET", "requests/getCollaboratorsRequest.php", true);
  xhr.send();
}

function SendDelegateTaskRequest(collaborator,task)
{
  console.log(collaborator.value + " " + task)
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
          var data = xhr.responseText;
          console.log(data);
      }
  };

  var formData = new FormData();
  formData.append('collaborator', collaborator.value);
  formData.append('id',task)

  xhr.open("POST", "requests/setCollaboratorRequest.php", true);
  xhr.send(formData);
}