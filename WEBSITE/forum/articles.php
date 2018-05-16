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
    <h1 class="w3-center w3-xxxlarge"><b><i class="material-icons" style="font-size:50px">forum</i> Forum :</b> Articles<br></h1><br>
    <?php
    if(isset($_GET['q']))
        $id = $_GET['q'];
    else
        $id = 1;

    $bdd = Database();
    try {
        $req = $bdd->prepare("SELECT title, description, parentId FROM subsection WHERE id=:id LIMIT 1");
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
    $parentId = $donnees['parentId'];
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

    <div class="">
        <div class="w3-container w3-padding w3-dark-gray w3-border w3-border-black w3-card-4">
            <h4><?php echo '<a href="/forum/subsection.php?q='.$parentId.'"><b>'.$parentTitle.'</b></a><br>'.$parentDescription ?></h4>
        </div>
        <br>
        <?php
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

        <div class="">
            <?php
            while ($donnees = $req->fetch()) {
                try {
                    $req3 = $bdd->prepare("SELECT pseudo, power, id FROM informations WHERE id=:id LIMIT 1");
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
                <div class="w3-container w3-padding w3-margin w3-card" style="border: 1px grey solid">
                    <div class="w3-col w3-right" style="width: 100px;"><span
                                class="w3-right"><?php echo $donnees2[0]; ?> posts</span></div>
                    <div class="w3-rest">
                        <p>
                            <?php echo '<a href="/forum/posts.php?q='.$donnees['id'].'" style="font-size: 20px;">'.$donnees['title'] . '</a><br><a href="/profile.php?q='.$donnees3['id'].'">'.$donnees3['pseudo'].'</a> : <img style="width: 70px" src="'.GetPathRank($donnees3['power']).'"><br>' . $donnees['date']; ?>
                        </p>
                    </div>
                </div>
                <?php
                $req3 = null;
                $req2 = null;
            } ?>
        </div>


        <?php
        if(IsLogged() && HasAccess(1, $_SESSION['power'])) { ?>
            <script>
                function CreateArticleButton() {
                    var articleform = document.getElementById("articleForm");
                    var buttonshow = document.getElementById("buttonShow");
                    if (articleform.style.display === "none") {
                        articleform.style.display = "block";
                        buttonshow.textContent = "Hide article creation window !";
                        buttonshow.className = buttonshow.className.replace("w3-green ", "w3-red ");
                    } else {
                        articleform.style.display = "none";
                        buttonshow.textContent = "Show article creation window !";
                        buttonshow.className = buttonshow.className.replace("w3-red ", "w3-green ");
                    }
                }
            </script>

            <h2><br><b>Create new article : </b></h2>
            <button class="w3-green w3-button w3-round w3-card w3-hover-opacity w3-margin-left" onclick="CreateArticleButton()" id="buttonShow">Show article creation window !</button>
            <div class="w3-container w3-padding w3-margin" id="articleForm" style="display: none">
                <form method="post" action="/forum/PHP/articleHandler.php">
                    <input type="hidden" name="subsectionId" value="<?php echo $id;?>">
                    <input style="width: 50%;height: 40px;" placeholder="Your new topic title" class="w3-round w3-padding w3-margin-bottom w3-animate-input" name="titleArticle"
                           required pattern="^.{4,50}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 4 - 50 characters !')"> <br>
                    <textarea style="width: 100%;height: 200px;" placeholder="Your first topic message" class="w3-round-large w3-padding" name="textContent" required></textarea>
                    <input style="height: 80px;width: 200px" type="submit" value="Create new Article" class="w3-green w3-hover-opacity w3-round-large w3-card w3-border-black w3-border w3-left">
                </form>
            </div>
        <?php } else if(IsLogged()&& IsBanned($_SESSION['power'])){ ?>
            <div class="w3-panel w3-greyscale w3-content w3-container w3-center">
                <h3>
                    Your account has been <b>banned</b> for our services ! <br>
                    You <b>can not</b> post articles if you are banned !
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
        <br> <br>
    </div>

</main>

<footer>
    <?php include_once '../Includes/Footer.php' ?>
</footer>
</body>

</html>
