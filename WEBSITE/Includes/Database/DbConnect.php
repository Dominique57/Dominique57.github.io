<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 25/01/2018
 * Time: 12:57
 */

// Create connection
function Database($db_name, $db_query){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    try {
        $bdd = new PDO('mysql:host='.$servername.';dbname='.$db_name.'', $username, $password);
        $data = $bdd->query($db_query);
        $dbh = null;
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    return $data;
}
?>