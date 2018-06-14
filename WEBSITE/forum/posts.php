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
    if(isset($_GET['q']))
        $id = $_GET['q'];
    else
        $id = 1;

    $bdd = Database();
    try {
        $req = $bdd->prepare("SELECT title, date FROM articles WHERE id=:id LIMIT 1");
        $req->execute(array(
            "id" => $id));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    $donnees = $req->fetch();
    $parentTitle = $donnees['title'];
    $parentDate = $donnees['date'];
    $req = null;
    $donnees = null;
    try {
        $req = $bdd->prepare("SELECT * FROM posts WHERE parentId=:id LIMIT 15");
        $req->execute(array(
            "id" => $id));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    ?>

    <div class="w3-container w3-border w3-margin w3-padding w3-round-large">
        <div class="w3-container w3-dark-gray w3-border w3-round-large">
            <h4><?php echo $parentTitle.'<br>'.$parentDate ?></h4>
        </div>
        <div class="w3-container w3-margin w3-round-large">
            <?php
            while ($donnees = $req->fetch()) {
                try {
                    $req2 = $bdd->prepare("SELECT * FROM informations WHERE id=:id LIMIT 1");
                    $req2->execute(array(
                        "id" => $donnees['author']));
                }
                catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    return;
                }
                $donnees2 = $req2->fetch();
                ?>
                <div class="w3-padding">
                    <div class="w3-grey w3-container" style="border: 1px gray solid; min-height: 50px;">
                        <img class="w3-col w3-margin" style="width:100px" src="<?php echo GetPathRank($donnees2['power']); ?>">
                        <div class="w3-rest">
                            <p>
                                <span style="font-size: 22px;font-weight: bold"><a href="/profile.php?=<?php echo $donnees2['id']; ?>"><?php echo $donnees2['pseudo']; ?></a></span>
                                <br>
                                <span style="font-size: 18px;"><?php echo $donnees['date']?></span>
                            </p>
                        </div>
                    </div>
                    <div class="w3-light-grey w3-card w3-padding" style="border: 1px gray solid; min-height: 10px;">
                        <p>
                            <?php echo $donnees['message'] ?>
                        </p>
                    </div>
                </div>
                <?php
            } ?>
        </iv>
    </div>

</main>

<footer>
    <?php include_once '../Includes/Footer.php' ?>
</footer>
</body>

</html>
