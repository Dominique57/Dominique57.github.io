<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 02/05/2018
 * Time: 12:38
 */
include_once '../Includes/session.php';

if(isset($_GET['p1']))
    $player1 = $_GET['p1'];
if(IsLogged())
    $player1 = $_SESSION['id'];
if(isset($_GET['p2']))
    $player2 = $_GET['p2'];
if(isset($_GET['p1won']))
    $p1won = $_GET['p1won'];
if(!IsLogged()) {
    $_SESSION['gameToSave'] = array($player2, $p1won);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <?php
        include_once '../Includes/Head.php';
        ?>
        <title> Saving game to your account </title>
    </head>

    <body>
        <header>
            <?php include_once '../Includes/Header.php' ?>
        </header>

        <main class="w3-container w3-content w3-center">
            <div class="w3-red w3-container w3-content w3-margin">
                <h2>To save your game you need to be logged in !</h2>
            </div>
            <div class="w3-orange w3-container w3-content w3-margin">
                <p>
                    To do so, please click the login button (Top right) <br>
                    If you don't have an account please consider creating one ! <br>
                </p>
            </div>

        </main>

        <footer>
            <?php include_once '../Includes/Footer.php'  ?>
        </footer>
    </body>

    </html>
<?php
}
else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <?php
        include_once '../Includes/Head.php';
        ?>
        <title> Saving game to your account </title>
    </head>

    <body>
    <header>
        <?php include_once '../Includes/Header.php' ?>
    </header>

    <main class="w3-container w3-content w3-center">
        <div class="w3-green w3-container w3-content w3-margin">
            <h2>Your game has been saved to your account !</h2>
        </div>
        <div class="w3-green w3-container w3-content w3-margin">
            <p>
                You can see your stat in your profile in the overview tab ! <br>
                You can see your game history in your profile in the history tab ! <br>
            </p>
        </div>

    </main>

    <footer>
        <?php include_once '../Includes/Footer.php'  ?>
    </footer>
    </body>

    </html>
    <?php

    $bdd = Database();
    try {
        $req = $bdd->prepare("INSERT INTO matches (player1, player2, player1won) 
                               VALUES(:player1, :player2, :player1won)");
        $req->execute(array(
            'player1' => $player1,
            'player2' => $player2,
            'player1won' => $p1won));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    if ($req)
        echo "true";
    else
        echo "false";
}
?>