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

function SendTaskDateRequest(date,id)
{
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
          var data = xhr.responseText;
          console.log(data);
      }
  };

  var formData = new FormData();
  formData.append('date', date.value);
  formData.append('id',id)

  xhr.open("POST", "requests/changeTaskDateRequest.php", true);
  xhr.send(formData);
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
          console.log(this.responseText);
      }

  var url = "requests/delRequest.php";
  xhr.open("POST", url, true);
  xhr.send();
}