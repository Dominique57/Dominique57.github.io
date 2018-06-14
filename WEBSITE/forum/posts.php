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
    <h1 class="w3-center w3-xxxlarge"><b><i class="material-icons" style="font-size:50px">forum</i> Forum :</b> Messages<br></h1><br>
    <?php
    if(isset($_GET['q']))
        $id = $_GET['q'];
    else
        $id = 1;

    $bdd = Database();
    try {
        $req = $bdd->prepare("SELECT title, date, parentId FROM articles WHERE id=:id LIMIT 1");
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
    $parentid = $donnees['parentId'];
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

    <div class="">
        <div class="w3-container w3-padding w3-gray w3-border w3-card-4">
            <h4><?php echo 'Article : <a href="/forum/articles.php/?q='.$parentid.'" <b>'.$parentTitle.'</b></a><br>created : '.$parentDate ?></h4>
        </div>
        <br>

        <?php
        if (isset($_SESSION['postResponse'])) {
            if(isset($_SESSION['postCode']))
                $color = $_SESSION['postCode'];
            else
                $color = "red";
            ?>
            <div class="w3-content w3-center w3-container w3-<?php echo $color?>">
                <h3><?php echo $_SESSION['postResponse'];?></h3>
            </div>
            <br>
            <?php
            unset($_SESSION['postResponse']);
            unset($_SESSION['postCode']);
        }
        if (isset($_SESSION['articleResponse'])) {
            if(isset($_SESSION['articleCode']))
                $color = $_SESSION['articleCode'];
            else
                $color = "red";
            ?>
            <div class="w3-content w3-center w3-container w3-<?php echo $color?>">
                <h3><?php echo $_SESSION['articleResponse'];?></h3>
            </div>
            <br>
            <?php
            unset($_SESSION['articleResponse']);
            unset($_SESSION['articleCode']);
        }
        ?>

        <br>
        <div class="">
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
                        <img class="w3-col w3-margin-top w3-margin-right" style="width:80px" src="<?php echo GetPathRank($donnees2['power']); ?>">
                        <div class="w3-rest">
                            <p>
                                <span style="font-size: 22px;font-weight: bold"><a href="/profile.php?q=<?php echo $donnees2['id']; ?>"><?php echo $donnees2['pseudo']; ?></a></span>
                                <br>
                                <span style="font-size: 14px;"><?php echo $donnees['date']?></span>
                            </p>
                        </div>
                    </div>
                    <div class="w3-light-grey w3-card w3-padding" style="border: 1px gray solid; min-height: 10px;">
                        <p>
                            <?php echo nl2br($donnees['message']); ?>
                        </p>
                    </div>
                </div>
                <?php
            } ?>
        </div>


        <?php
        if(IsLogged() && HasAccess(1, $_SESSION['power'])) { ?>
            <div class="w3-container w3-padding w3-margin">
                <h2><br><b>Reply to this article : </b></h2>
                <form method="post" action="/forum/PHP/postHandler.php">
                    <input type="hidden" name="articleId" value="<?php echo $id;?>">
                    <textarea style="width: 100%;height: 200px;" placeholder="Your reply... " class="w3-round-large w3-padding" name="textContent" required></textarea>
                    <input style="height: 75px;width: 150px" type="submit" value="Reply" class="w3-green w3-hover-opacity w3-round-large w3-card w3-border-black w3-border w3-left">
                </form>
            </div>
        <?php } else if(IsLogged()&& IsBanned($_SESSION['power'])){ ?>
            <div class="w3-panel w3-greyscale w3-content w3-container w3-center">
                <h3>
                    Your account has been <b>banned</b> for our services ! <br>
                    You <b>can not</b> post answers if you are banned !
                </h3>
                <h4><i>Please consider the contact tab to make us re-consider your ban !</i></h4>
            </div>
        <?php } else { ?>
            <div class="w3-panel w3-greyscale w3-content w3-container w3-center w3-padding">
                <h2><b>Do you want to answer to this article ?</b></h2>
                <h3>Consider <em>logging in</em> or <em>signing up</em> to post comments !<br>
                    And guess what? It is free ! <br>
                    <i class="fa fa-smile-o w3-xxlarge"></i></h3>
            </div>
        <?php }?>

    </div>

</main>

<footer>
    <?php include_once '../Includes/Footer.php' ?>
</footer>
</body>

</html>
