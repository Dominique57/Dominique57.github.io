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
    include_once 'Includes/Database/DbConnect.php';
    $database = "_gplayer";
    $regex =  '^'.$q;
    $bdd = Database($database);
    try {
        $req = $bdd->prepare("SELECT pseudo, id FROM informations WHERE pseudo REGEXP ?");
        $req->execute(array($regex));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    $count = 0;
    while ($donnees = $req->fetch())
    {
        if($count < 6)
        {
            $link = '/profile.php?q='.$donnees['id'];
            ?>
            <div onclick="document.location='<?php echo $link ?>'" class="w3-container w3-hover-light-blue w3-blue w3-padding w3-margin" style="cursor:pointer;">
                <h5> <?php echo $donnees['pseudo'] . '<br />'; ?></h5>
            </div>
            <?php
            $count++;
        }
    }
}
?>