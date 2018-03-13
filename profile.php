<!DOCTYPE html>
<html>
<head>
    <?php
    include_once 'Includes/Head.php';
    ?>
</head>

<body>
<header>
    <?php
    include_once 'Includes/Header.php'
    ?>
</header>

<main>
    <p> Some text :</p>
    <h1> Some big title :</h1>
    <?php
    $data = Database('_gplayer', "SELECT * from informations");
    while ($donnees = $data->fetch()){
        echo 'Player '.$donnees['pseudo'].', also called '.$donnees['firstName'].' '.$donnees['lastName'].' 
        created hist account the '. $donnees['dateCreation'].' and can be contacted via email at '.$donnees['email'].' 
        <br/> Fun fact he is the '.$donnees['id'].' user that registered on this website <br/>';
    }
    $data = null;
    $donnees = null;
    ?>
</main>

<footer>
    <?php
    include_once 'Includes/Footer.php'
    ?>
</footer>
</body>
</html>
