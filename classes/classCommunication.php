<?php
require_once("ClassConnexion.php");

session_start();

class Communication 
{
    private $con;

    public function __construct()
    {
        $this->con = Connexion::GetInstance();  
    }

    public function DisplayTasksFromPriority($priotity)
    {
        $result = $this->GetTasksFromPriority($priotity);

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if($row['done'] == 0){ echo '<li class="list-group-item" id="task'.$row['id'].'">
                                            <input type=checkbox name=checkboxTask id='.$row['id'].'>   '. $row["title"].'<span>&nbsp;&nbsp;&nbsp;</span>';
                                            
                                            if($priotity == 3){ 

                                                if($row['delegate_id'] == $_SESSION['id_user'] && $row['id_creator']){

                                                    $nameResult = $this->getNameById($row['id_creator']);

                                                    echo '<p> Delegate By '.$nameResult['name'].'</p>';
                                                }

                                                else{

                                                echo '  <select id="choix'.$row['id'].'" name="choix" onchange="SendDelegateTaskRequest(this,'.$row["id"].')" disabled>
                                                        <option value="0">Aucun</option>';

                                                $collaborators = $this->GetCollaborators();
                                                while($col = $collaborators->fetch(PDO::FETCH_ASSOC))
                                                {
                                                    if($row['delegate_id'] == $col["id"]) echo'<option value='.$col["id"].' selected>'.$col["name"].'</option>';
                                                    else echo'<option value='.$col["id"].'>'.$col["name"].'</option>';
                                                }
                                            }
                                                 echo'</select>
                                                 <button class="btn btn-primary btn-sm" onclick="deleteTask('.$row["id"].')">X</button>
                                            <span id="lock'.$row['id'].'" class="material-symbols-outlined" onclick="LockUnlockSelect('.$row['id'].')">lock</span> 
                                        </li>';
                                            
                                                }
                                                elseif($priotity == 2)
                                                {
                                                    echo'<input type=date id ="date'.$row['id'].'" onchange="SendTaskDateRequest(this,'.$row["id"].')" value ="'.$row['task_date'].'" disabled><button class="btn btn-primary btn-sm" onclick="deleteTask('.$row["id"].')">X</button>
                                                    <span id="lock'.$row['id'].'" class="material-symbols-outlined" onclick="LockUnlockDate('.$row['id'].')">lock</span> 
                                                </li>';
                                                }
                                                else                                      
                                            echo'   <button class="btn btn-primary btn-sm" onclick="deleteTask('.$row["id"].')">X</button>
                                        </li>';
                                            }

            else {echo '<li class="list-group-item" id="task'.$row['id'].'" style="text-decoration: line-through">
                            <input type=checkbox name=checkboxTask  id='.$row['id'].' checked>'. $row["title"].'<span>&nbsp;&nbsp;&nbsp;</span>' ;
                            
                            if($priotity == 3){ 
                                echo '  <select id="choix'.$row['id'].'" name="choix" onchange="SendDelegateTaskRequest(this,'.$row["id"].')" disabled>
                                        <option value="0">Aucun</option>';

                                $collaborators = $this->GetCollaborators();
                                while($col = $collaborators->fetch(PDO::FETCH_ASSOC))
                                {
                                    if($row['delegate_id'] == $col["id"]) echo'<option value='.$col["id"].' selected>'.$col["name"].'</option>';
                                    else echo'<option value='.$col["id"].'>'.$col["name"].'</option>';
                                }
                                echo'</select>
                                <button class="btn btn-primary btn-sm" onclick="deleteTask('.$row["id"].')">X</button>
                           <span id="lock'.$row['id'].'" class="material-symbols-outlined" onclick="LockUnlockSelect('.$row['id'].')">lock</span> 
                       </li>';
                               }
                               elseif($priotity == 2)
                                                {
                                                    echo'<input type=date id ="date'.$row['id'].'" onchange="SendTaskDateRequest(this,'.$row["id"].')" value ="'.$row['task_date'].'" disabled><button class="btn btn-primary btn-sm" onclick="deleteTask('.$row["id"].')">X</button>
                                                    <span id="lock'.$row['id'].'" class="material-symbols-outlined" onclick="LockUnlockDate('.$row['id'].')">lock</span> 
                                                </li>';
                                                }
                               else                                      
                           echo'   <button class="btn btn-primary btn-sm" onclick="deleteTask('.$row["id"].')">X</button>
                       </li>';
                }
        }
    }

    public function GetDelegate($delegateId)
    {
        $result =$this->SendQuery("SELECT name FROM collaborators WHERE id = $delegateId",true);
        return $result;
    }

    public function GetTasksFromPriority($priotity)
    {
        $result = $this->SendQuery("SELECT * FROM tasks WHERE type_id = $priotity AND (delegate_id =".$_SESSION['id_user']." OR id_creator =".$_SESSION['id_user'].");",true);
        return $result;
    }
/*
    public function GetImportantAndUrgent()
    {
        $query = "SELECT id,title,done FROM tasks WHERE type_id = 1" ; //On fait une requete pour récuperer
        $ligne = $this->con->GetPdo()->query($query) ;
        if ($ligne) {
            // Itération sur les résultats
            $this->DisplayTasks($ligne);
        } else {
            // Gestion de l'erreur si la requête échoue
            echo "Erreur lors de l'exécution de la requête.";
        }
    }

    public function GetImportantNotUrgent()
    {
        $query = "SELECT id,title,done FROM tasks WHERE type_id = 2" ; 
        $ligne = $this->con->GetPdo()->query($query) ;
        if ($ligne) {
            // Itération sur les résultats
            $this->DisplayTasks($ligne);
        } else {
            // Gestion de l'erreur si la requête échoue
            echo "Erreur lors de l'exécution de la requête.";
        }
    }

    public function GetNotImportantUrgent()
    {
        $query = "SELECT id,title,done FROM tasks WHERE type_id = 3" ; 
        $ligne = $this->con->GetPdo()->query($query) ;
        if ($ligne) {
            // Itération sur les résultats
            $this->DisplayTasks($ligne);
        } else {
            // Gestion de l'erreur si la requête échoue
            echo "Erreur lors de l'exécution de la requête.";
        }
    }

    public function GetNotImportantNotUrgent()
    {
        $query = "SELECT id,title,done FROM tasks WHERE type_id = 4" ; 
        $ligne = $this->con->GetPdo()->query($query) ;
        if ($ligne) {
            // Itération sur les résultats
            $this->DisplayTasks($ligne);
        } else {
            // Gestion de l'erreur si la requête échoue
            echo "Erreur lors de l'exécution de la requête.";
        }
    }
*/
    public function GetPriorityLevel()
    {
        $result = $this->SendQuery("SELECT id, name FROM priority_level",true) ; 
        return $result;
    }

    public function DisplayPriorityLevel()
    {
        $result = $this->GetPriorityLevel();
        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='".$row['id']."'>".$row['name']."</option>";
            }
          } else {
            echo "Erreur lors de l'exécution de la requête.";
          }
    }

    public function AddNewTask($priorityLevel, $title)
    {
        $this->SendQuery("INSERT INTO tasks(title,type_id,done,id_creator) VALUES ('$title','$priorityLevel',0, ".$_SESSION['id_user'].")",false) ; 
    }
   
    public function DelAllTasks()
    {
        $this->SendQuery("DELETE FROM tasks WHERE done = 1",false) ; 
    }

    public function TaskDone($id)
    {
        $this->SendQuery("UPDATE tasks SET done = 1 WHERE id = $id;",false);
    }

    public function TaskNotDone($id)
    {
        $this->SendQuery("UPDATE tasks SET done = 0 WHERE id = $id;",false);
    }

    public function GetLastId()
    {
        $lastId = $this->SendQuery("SELECT MAX(id) FROM tasks",true) ; 
        return $lastId->fetch(PDO::FETCH_ASSOC)["MAX(id)"];
    }

    public function DelTask($id)
    {
       $this->SendQuery("DELETE FROM tasks WHERE id = $id", false); 
    }

    public function GetCollaborators()
    {
        $collaborators =  $this->SendQuery("SELECT id,name FROM collaborators",true); 
        return $collaborators;
    }

    public function AddCollaborator($name)
    {
        $identifiant = $name."@gmail.com";
        $this->SendQuery("INSERT INTO collaborators(identifiant,name,password) VALUES ('$identifiant','$name','123')",false); 

    }

    public function SendQuery($query, $return)
    {
        $result = $this->con->GetPdo()->query($query) ;
        if($return)
        {
            return $result;
        }
    }

    public function DisplayCollaborators()
    {
        $result = $this->GetCollaborators();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            echo "<tr> <td>".$row['name']."</td></tr>";
        }
    }

    public function SetCollaborator($collaborator, $id)
    {
        $this->SendQuery("UPDATE tasks SET delegate_id = $collaborator WHERE id = $id;",false);
    }

    public function GetCollaboratorsMaxId()
    {
        $lastid = $this->SendQuery("SELECT MAX(id) FROM collaborators",true);
        return $lastid->fetch(PDO::FETCH_ASSOC)["MAX(id)"];

    }

    public function ChangeTaskDate($date,$id)
    {
        $this->SendQuery("UPDATE tasks SET task_date = '$date' WHERE id = $id;",false);
    }

    public function getNameById($id){
        $name = $this->SendQuery("SELECT name FROM collaborators WHERE id = $id;",true);
        return $name->fetch(PDO::FETCH_ASSOC);
    }

    public function desactivateCollaborator($id){
        $name = $this->SendQuery("UPDATE collaborators SET desactivate = 1 WHERE id = $id;",false);
    }
}
?>