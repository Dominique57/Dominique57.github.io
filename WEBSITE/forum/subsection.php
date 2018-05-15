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
    <h1 class="w3-center w3-xxxlarge"><b><i class="material-icons" style="font-size:50px">forum</i> Forum :</b><br></h1><br>
    <?php
    if(isset($_GET['q']))
        $id = $_GET['q'];
    else
        $id = 1;

    $bdd = Database();
    try {
        $req = $bdd->prepare("SELECT * FROM section WHERE id=:id LIMIT 1");
        $req->execute(array(
                "id" => $id ));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return;
    }
    ?>

    <div class="">
        <div class="w3-container w3-padding">
            <?php
            $donnees = $req->fetch(); ?>
            <div class="w3-container w3-blue w3-round-large w3-card">
                <h4><a href="/forum/forum.php"><?php echo '-=' . $donnees['title'] . '=-' ?></a></h4>
            </div>
            <?php
            try {
                $req2 = $bdd->prepare("SELECT * FROM subsection WHERE parentId=:id");
                $req2->execute(array(
                    "id" => $id));
            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                return;
            }
            ?>
            <div class="" style="border: 2px grey solid">
                <?php
                $ids;
                $titles;
                while ($donnees2 = $req2->fetch()) {
                    $ids[] = $donnees2['id'];
                    $titles[] = $donnees2['title'];
                    try {
                        $req3 = $bdd->prepare("SELECT COUNT(id) FROM articles WHERE parentId=:id");
                        $req3->execute(array(
                            "id" => $donnees2['id']));
                    } catch (PDOException $e) {
                        print "Erreur !: " . $e->getMessage() . "<br/>";
                        return;
                    }
                    $donnes3 = $req3->fetch();
                    $numbertopic = $donnes3[0];
                    $req3 = null;
                    ?>
                    <div class="w3-grey" style="border: 1px gray solid"">
                        <div class="w3-col" style="width: 60px;"><img class="w3-margin" src="/img/news.png"></div>
                        <div class="w3-col w3-right" style="width: 100px;"><span class="w3-right"><?php echo $numbertopic; ?> topics</span></div>
                        <div class="w3-rest">
                            <p>
                                <?php echo '<a href="/forum/articles.php?q='.$donnees2['id'].'" <b>'.$donnees2['title'].'</b></a><br>'.$donnees2['description']; ?>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                $req2 = null;
                ?>
            </div>
            <?php
            $req = null; ?>
        </div>

        <?php
        if(IsLogged() && HasAccess(3, $_SESSION['power'])) { ?>
            <div class="w3-container w3-margin w3-padding">
                <h5>Add a subsection : </h5>
                <form method="post" action="/forum/PHP/subsectionHandler.php">
                    <input type="hidden" name="form_add" value="ISSET">
                    <input type="hidden" name="page_id" value="<?php echo $id; ?>">
                    <input type="text" placeholder="Your subsection title" name="title_add"
                        required> <br>
                    <textarea type="text" placeholder="Your new subsection description" name="text_add" style="min-width: 300px;min-height: 50px;resize: none;"
                              required></textarea><br>
                    <input type="submit">
                </form>
                <h5>Edit a subsection : </h5>
                <form method="post" action="/forum/PHP/subsectionHandler.php">
                    <input type="hidden" name="form_edit" value="ISSET">
                    <input type="hidden" name="page_id" value="<?php echo $id; ?>">
                    <select name="edit_choice" required>
                        <option value="" disabled selected>Choose a subsection</option>
                        <?php
                        $length = count($ids);
                        for ($i = 0; $i < $length ; $i++) {
                            echo '<option value="'.$ids[$i].'">'.$titles[$i].'</option>';
                        } ?>
                    </select><br>
                    <input type="text" placeholder="Your new subsection title" name="title_edit"
                           required><br>
                    <textarea type="text" placeholder="Your new subsection description" name="text_edit" style="min-width: 300px;min-height: 50px;resize: none;"
                              required></textarea>
                    <input type="submit">
                </form>
                <h5>Delete a subsection : </h5>
                <form method="post" action="/forum/PHP/subsectionHandler.php">
                    <input type="hidden" name="form_del" value="ISSET">
                    <input type="hidden" name="page_id" value="<?php echo $id; ?>">
                    <select name="del_choice" required>
                        <option value="" disabled selected>Choose a subsection</option>
                        <?php
                        $length = count($ids);
                        for ($i = 0; $i < $length ; $i++) {
                            echo '<option value="'.$ids[$i].'">'.$titles[$i].'</option>';
                        } ?>
                    </select> <br>
                    <input type="submit">
                </form>
            </div>
        <?php } ?>
    </div>

</main>

<footer>
    <?php include_once '../Includes/Footer.php' ?>
</footer>
</body>

</html>
