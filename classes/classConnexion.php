<?php 

class Connexion 
{
    private static $instance;
    private $pdo;
    private $options = array(
      PDO::ATTR_PERSISTENT => true, // Activation de la connexion persistante
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Activation du mode d'erreur exception
  );

    public function __construct($host,$login,$password)
    {
        try{
        $this->pdo = new PDO( $host,$login,$password,$this->options ) ;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        error_log("Connexion BDD");

        }
      catch (Exception $e)
       {
        die ($e->getMessage()) ;
       }   
     }

     public static function GetInstance()
     {
      if(!self::$instance) {self::$instance = new Connexion("mysql:host=sql11.freemysqlhosting.net;dbname=sql11703179","sql11703179","XAgMIurL9R");error_log("New Instance");}
      return self::$instance;
     }

     public function GetPdo()
     {
      return $this->pdo;
     }
}
?>