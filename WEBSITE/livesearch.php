<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 15/03/2018
 * Time: 11:23
 */
//get the q parameter from URL
$q=$_GET["q"];
//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
    $hint="";
    include_once 'Includes/Database/DbConnect.php';
    $database = "_gplayer";
    $query = "SELECT pseudo FROM informations WHERE pseudo REGEXP '^".$q."'";
    $result = Database($database, $query);
    $count = 0;
    while ($donnees = $result->fetch())
    {
        if($count < 6)
        {
            echo $donnees['pseudo'] . '<br />';
            $count++;
        }
    }
}
?>