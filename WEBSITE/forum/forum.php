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
    $bdd = Database();
    try {
        $req = $bdd->prepare("SELECT * FROM section");
        $req->execute();
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    ?>

    <div class="w3-container w3-border w3-margin w3-padding w3-round-large">
        <div class="w3-container w3-padding">
            <?php
            while ($donnes = $req->fetch()) { ?>
                <div class="w3-container w3-blue w3-round-large w3-card">
                    <h4><?php echo '-=' . $donnes['title'] . '=-' ?></h4>
                </div>
                <?php
                try {
                    $req2 = $bdd->prepare("SELECT * FROM subsection WHERE parentId=:id");
                    $req2->execute(array(
                        "id" => $donnes['id']));
                } catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    return;
                } ?>
                <div class="" style="border: 2px grey solid">
                    <?php
                    while ($donnes2 = $req2->fetch()) {
                        try {
                            $req3 = $bdd->prepare("SELECT COUNT(id) FROM articles WHERE parentId=:id");
                            $req3->execute(array(
                                "id" => $donnes2['id']));
                        } catch (PDOException $e) {
                            print "Erreur !: " . $e->getMessage() . "<br/>";
                            return;
                        }
                        $donnes3 = $req3->fetch();
                        $numbertopic = $donnes3[0];
                        $req3 = null;
                        ?>
                        <div class="w3-container w3-grey" style="border: 1px gray solid" onclick="document.location='<?php echo '/forum/articles.php?id='.$donnes2['id']; ?>'">
                            <div class="w3-col" style="width: 80px;"><img class="w3-margin" src="/img/news.png"></div>
                            <div class="w3-col w3-right" style="width: 100px;"><span class="w3-right"><?php echo $numbertopic; ?> topics</span>
                            </div>
                            <div class="w3-rest">
                                <p>
                                    <?php echo $donnes2['title'] . '<br>' . $donnes2['description']; ?>
                                </p>
                            </div>
                        </div>
                        <?php
                    }
                    $req2 = null;
                    ?>
                </div>
                <?php
            }
            $req = null;
            ?>
        </div>
    </div>

</main>

<footer>
    <?php include_once '../Includes/Footer.php' ?>
</footer>
</body>

</html>
