<?php
include_once 'Includes/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include_once 'Includes/Head.php';
    ?>
    <title> Error 404 - where are you even going? </title>
</head>

<body>
    <header>
        <?php include_once 'Includes/Header.php' ?>
    </header>

    <main class="w3-padding-64 w3-container">
        <h1 class="w3-center w3-xxxlarge"><b><i class="fa fa-newspaper-o"></i> Blog section :</b><br></h1>

        <div class="w3-row">
            <div class="w3-col l8 s12">
                <div class="w3-card-4 w3-margin w3-white" style="border: 1px gray solid;">
                    <img src="/img/news_logo.jpg" alt="BREAKING NEWS" style="margin-top: 20px;border-radius: 10px;width:80%; margin-left: 10%; margin-right: 10%; max-height: 150px; max-width: 900px;">
                    <div class="w3-container">
                        <h3><b>The project is slowly becoming playable !</b></h3>
                        <h4>Our progress make a big bump forward, <span class="w3-opacity w3-right">2 mai, 2018</span></h4>
                    </div>
                    <div class="w3-container">
                        <p>
                            Our project continues remarkably it's progress! In fact our Artificial intelligence has made some progress even though it remains pretty basic for the moment. <br>
                            Concerning the gameplay, new abilities are and will be implemented. the only limit is our imagination ! <br>
                            The UI of the game itself has made a huge leap forward with a new In Real Time bar representing region information's ! Furthermore the panels and button are being designed and the final state should be reached soon !
                            Eventually our team has ended the region and country-wide research and can focus on the abilities and random events that will occur during the game. <br>
                            <br>
                            And that's already all folks !<br>
                        </p>
                        <h4><i> Dominique MICHEL,<br>Gotobreak TEAM</i></h4>
                    </div>
                </div>
                <hr>

                <!-- Blog entry -->
                <div class="w3-card-4 w3-margin w3-white" style="border: 1px gray solid;">
                    <img src="/img/news_logo.jpg" alt="BREAKING NEWS" style="margin-top: 20px; ;border-radius: 10px;width:80%; margin-left: 10%; margin-right: 10%; max-height: 150px; max-width: 900px;">
                    <div class="w3-container">
                        <h3><b>Our new-born project learns to walk !</b></h3>
                        <h4>The project we begun in begin 2018 has evolved a lot and thus we want to inform you of our actual progress, <span class="w3-opacity w3-right">17 mars, 2018</span></h4>
                    </div>
                    <div class="w3-container">
                        <p>
                            Our project is starting well. The core gameplay is already working and concerning this part all we need to do is add more abilities to give more content and possibilities for the gameplay ! <br>
                            Concerning the UI, it is functional but has not been designed yet !<br>
                            Finally our team has begun not region-wide information, but country-wide researches. We want to be able to create more possibilities by allowing a higher number of actions to a higner number of countries! <br>
                            <br>
                            And that's already all folks !<br>
                        </p>
                        <h4><i> Dominique MICHEL,<br>Gotobreak TEAM</i></h4>
                    </div>
                </div>
                <!-- END BLOG ENTRIES -->
            </div>

            <!-- Introduction menu -->
            <div class="w3-col l4 ">
                <!-- About Card -->
                <div class="w3-card w3-margin w3-margin-top" style="border: 1px gray solid;">
                    <img src="/img/team.jpg" class="w3-margin" style="width: 90%; max-width: 1000px; max-height: 400px;">
                    <div class="w3-container w3-white">
                        <h4><b>The Gotobreak team :</b></h4>
                        <p>The Gotobreak team has been created during a school projet at Epita in 2018. <br>
                        Our goal is to create a game that completely differs with the modern standards to attract the players. <br>
                        To learn more about the Gotobreak team, please consider the "About us" tab in the navigation bar !</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include_once 'Includes/Footer.php'  ?>
    </footer>
</body>

</html>
