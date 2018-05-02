<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 02/05/2018
 * Time: 12:38
 */
$player1 = $_POST['player1'];
$player2 = $_POST['player2'];
$p1won = $_POST['p1won'];

$bdd = Database();
try {
    $req = $bdd->prepare("INSERT INTO matches (player1, player2, player1won) 
                               VALUES(:player1, :player2, :player1won)");
    $req->execute(array(
        'title' => $player1,
        'player2' => $player2,
        'player1won' => $p1won));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    return;
}
if($req)
    echo "true";
else
    echo "false";
?>