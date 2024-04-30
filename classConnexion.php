<?php

class Connexion 
{
    private $host = "0";
    
    private $login = "0";
    private $password = "0";
    private $pdo;


    public function __construct($host,$login,$password)
    {
        try{
        $this->pdo = new PDO( $host,$login,$password ) ;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        }
      catch (Exception $e)
       {
        die ($e->getMessage()) ;
       }

    
     }

     public function GetPdo()
     {
        return $this->pdo;
     }
}
?>