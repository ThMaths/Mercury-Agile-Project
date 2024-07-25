<?php
require_once("ClassConnexion.php");

class Utilisateur {
    private $con;
    private $table_name = "collaborators"; // Remplacez par le nom de votre table

    public $id;
    public $nom;
    public $email;

    public function __construct() {
        $this->con = Connexion::GetInstance();  
    }

    public function getUserInfo($session_id) {
        $query = "SELECT id, name, identifiant FROM " . $this->table_name . " WHERE id =".$session_id;

        $userResult = $this->SendQuery($query, true);
        
        while ($row = $userResult->fetch(PDO::FETCH_ASSOC)) {
            $this->id = $row['id'];
            $this->nom = $row['name'];
            $this->email = $row['identifiant'];
        }

    }

    
    public function SendQuery($query, $return)
    {
        $result = $this->con->GetPdo()->query($query) ;
        if($return)
        {
            return $result;
        }
    }
}


?>
