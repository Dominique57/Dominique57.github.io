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

    <h1 class="w3-center w3-xxxlarge"><b><i class="fa fa-home"></i> Home :</b><br><br></h1>
    <div class="w3-container w3-content w3-center">
        <div class="w3-container w3-content" style="padding-bottom: 30px">
            <h1 class="w3-xxxlarge"> Some text here</h1>
        </div>
        <div class="w3-black">
            <!-- Automatic Slideshow Images -->
            <div class="mySlides w3-display-container w3-center">
                <img src="/img/game1.PNG" class="w3-animate-opacity" style="width:100%">
                <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32">
                    <h2><b>Hello World - Menu</b></h2>
                    <p><i>1st photo of slide</i></p>
                </div>
            </div>
            <div class="mySlides w3-display-container w3-center">
                <img src="/img/game1.PNG" class="w3-animate-opacity" style="width:100%">
                <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32">
                    <h2><b>Hello World - Menu</b></h2>
                    <p><i>2nd photo of slide</i></p>
                </div>
            </div>
            <div class="mySlides w3-display-container w3-center">
                <img src="/img/game1.PNG" class="w3-animate-opacity" style="width:100%">
                <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32">
                    <h2><b>Hello World - Menu</b></h2>
                    <p><i>3rd photo of slide</i></p>
                </div>
            </div>
        </div>
    </div>
    <div class="w3-container w3-content">
        <h2> Insert review / comment here</h2>
    </div>
    <div class="w3-container w3-content">
        <h2> Insert some text and links here</h2>
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
