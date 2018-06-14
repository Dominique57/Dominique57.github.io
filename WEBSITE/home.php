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
<?php include_once 'Includes/Header.php' ?>

<main class="w3-padding-32">

    <h1 class="w3-center w3-xxxlarge"><b><i class="fa fa-home"></i> Home :</b><br></h1>
    <div class="w3-container w3-content w3-center">
        <div class="w3-container w3-content" style="padding-bottom: 30px">
            <h1 class="w3-xxxlarge"><em>Hello world</em> by Gotobreak</h1>
        </div>
        <div class="w3-black">
            <!-- Automatic Slideshow Images -->
            <div class="mySlides w3-display-container w3-center">
                <img src="/img/MenuGame.PNG" class="w3-animate-opacity" style="width:100%">
                <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32">
                    <h2><b>Hello World - Menu</b></h2>
                    <p><i>The main Menu of Hello World</i></p>
                </div>
            </div>
            <div class="mySlides w3-display-container w3-center">
                <img src="/img/GameIntro.PNG" class="w3-animate-opacity" style="width:100%">
                <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32">
                    <h2><b>Hello World - Begin</b></h2>
                    <p><i>The first screen when starting a game !</i></p>
                </div>
            </div>
            <div class="mySlides w3-display-container w3-center">
                <img src="/img/GameScreen.PNG" class="w3-animate-opacity" style="width:100%">
                <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32">
                    <h2><b>Hello World - Play</b></h2>
                    <p><i>A screen capture of the game in action !</i></p>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-container w3-content w3-margin-top w3-padding-top">
        <h2> Small presentation :</h2>
        <p>
            <i>
                December 12th. A meteorite plummets to the Earth. <br>
                What distinguishes it of another meteorite? It contains a deadly virus that aims to destroy humanity. <br>
                Two camps will be in confrontation : the virus trying to annihilate humanity, and  humanity trying to eliminate the threat. <br>
                Will you be able to save humanity, will you protect it? Or... Will you prefer to help to destroy it?
            </i>
        </p>
    </div>

</main>

<?php include_once 'Includes/Footer.php' ?>

</body>

<script>
    // Automatic Slideshow - change image every 4 seconds
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 6000);
    }
</script>

</html>
