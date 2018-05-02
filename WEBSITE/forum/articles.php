<?php
include_once '../Includes/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forum : Gotobreak</title>
    <?php
    include_once '../Includes/Head.php';
    ?>
</head>

<body>
<header>
    <?php include_once '../Includes/Header.php' ?>
</header>

<main class="w3-container">
    <h1 class="w3-center w3-xxxlarge"><b><i class="material-icons" style="font-size:50px">forum</i> Forum :</b><br></h1>
    <?php
    if(isset($_GET['id']))
        $id = $_GET['id'];
    else
        $id = 1;

    $bdd = Database();
    try {
        $req = $bdd->prepare("SELECT title, description FROM subsection WHERE id=:id LIMIT 1");
        $req->execute(array(
            "id" => $id));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    $donnees = $req->fetch();
    $parentTitle = $donnees['title'];
    $parentDescription = $donnees['description'];
    $req = null;
    $donnees = null;
    try {
        $req = $bdd->prepare("SELECT * FROM articles WHERE parentId=:id");
        $req->execute(array(
                "id" => $id));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    ?>

    <div class="w3-container w3-border w3-margin w3-padding w3-round-large">
        <div class="w3-container w3-padding">
            <div class="w3-container w3-padding w3-gray w3-border w3-round-large">
                <h4><?php echo $parentTitle.'<br>'.$parentDescription ?></h4>
            </div>
            <div class="w3-container w3-padding w3-margin">
                <?php
                while ($donnees = $req->fetch()) {
                    try {
                        $req3 = $bdd->prepare("SELECT pseudo, power FROM informations WHERE id=:id LIMIT 1");
                        $req3->execute(array(
                            "id" => $donnees['author']));
                    } catch (PDOException $e) {
                        print "Erreur !: " . $e->getMessage() . "<br/>";
                        return;
                    }
                    $donnees3 = $req3->fetch();
                    try {
                        $req2 = $bdd->prepare("SELECT COUNT(id) FROM posts WHERE parentId=:id");
                        $req2->execute(array(
                            "id" => $donnees['id']));
                    } catch (PDOException $e) {
                        print "Erreur !: " . $e->getMessage() . "<br/>";
                        return;
                    }
                    $donnees2 = $req2->fetch();
                    $req2 = null;
                    ?>
                    <div class="w3-container w3-padding w3-margin w3-card" style="border: 1px grey solid" onclick="document.location='<?php echo '/forum/posts.php?id='.$donnees['id']; ?>'">
                        <div class="w3-col w3-right" style="width: 100px;"><span
                                    class="w3-right"><?php echo $donnees2[0]; ?> posts</span></div>
                        <div class="w3-rest">
                            <p>
                                <?php echo '<em style="font-size: 20px;">'.$donnees['title'] . '</em><br>' . $donnees3['pseudo'] . '   <img style="width: 70px" src="'.GetPathRank($donnees3['power']).'"><br>' . $donnees['date']; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                    $req3 = null;
                    $req2 = null;
                } ?>
            </div>
        </div>
    </div>

</main>

<footer>
    <?php include_once '../Includes/Footer.php' ?>
</footer>
</body>

</html>
