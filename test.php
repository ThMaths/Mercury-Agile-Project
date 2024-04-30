<?php
require_once("ClassConnexion.php");
$con = new Connexion("mysql:host=localhost;dbname=mercury_db","root","root");
$query = "SELECT * FROM priority_level" ; //On fait une requete pour récuperer
$ligne = $con->GetPdo()->query($query) ;
if ($ligne) {
    // Itération sur les résultats
    while ($row = $ligne->fetch(PDO::FETCH_ASSOC)) {
        // Affichage des données
        foreach ($row as $key => $value) {
            echo "$key : $value<br>";
        }
        echo "<br>";
    }
} else {
    // Gestion de l'erreur si la requête échoue
    echo "Erreur lors de l'exécution de la requête.";
}
?>