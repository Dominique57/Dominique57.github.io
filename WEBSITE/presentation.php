<?php
include_once 'Includes/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include_once 'Includes/Head.php';
    ?>
</head>

<body>
    <header>
        <?php include_once 'Includes/Header.php' ?>
    </header>

    <main class="w3-padding-64">

        <h1 class="w3-center w3-xxxlarge"><b><i class="fa fa-file-text-o"></i> Presentation :</b><br><br></h1>
        <div class="w3-container w3-content">
            <div class="w3-half w3-left">
                <h2> The World : </h2>
                <p>
                    <i>
                        December 12th. A meteorite plummets to the Earth. <br>
                        What distinguishes it of another meteorite? It contains a deadly virus that aims to destroy humanity. <br>
                        Two camps will be in confrontation : the virus trying to annihilate humanity, and  humanity trying to eliminate the threat. <br>
                        Will you be able to save humanity, will you protect it? Or... Will you prefer to help to destroy it?
                    </i>
                </p>
            </div>
            <div class="w3-half w3-right">
                <img src="img/game1.PNG" style="width: 500px; height: 300px;">
            </div>
        </div>

        <br><br>

        <div class="w3-container w3-content">
            <div class="w3-half w3-right">
                <h2> Abilities :</h2>
                <p>
                    Both Attacker and Defender have unique abilities. <br>
                    Their respective objectives are to infect as much people as possible, but also to kill them without burying the virus with them and to make researches of the virus to determine its characteristics and find an antidote.<br>
                </p>
            </div>
            <div class="w3-half w3-left">
                <img src="img/presentation_yingyang.png" style="width: 300px; height: 300px;">
            </div>
        </div>

        <br><br>

        <?php /*
        <div class="w3-container w3-content">
            <div class="w3-half">
                <h2> Attacker :</h2>
                <table class="w3-table-all w3-left">
                    <tr class="w3-indigo">
                        <th>Ability : </th>
                        <th>Description : </th>
                        <th>Effect : </th>
                    </tr>

                </table>
            </div>
            <div class="w3-half">
                <h2> Defender</h2>
                <table class="w3-table-all w3-right">
                    <tr class="w3-indigo">
                        <th>Ability : </th>
                        <th>Description : </th>
                        <th>Effect : </th>
                    </tr>
                </table>
            </div>
        </div>
 */ ?>

    </main>

    <footer>
        <?php include_once 'Includes/Footer.php'  ?>
    </footer>
</body>

</html>
