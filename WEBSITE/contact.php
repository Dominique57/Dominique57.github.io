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

    <main class="w3-content w3-padding-64">

        <div class="w3-container w3-content" style="max-width:800px" id="contact">
            <h2 class="w3-wide w3-center">Contact</h2>
            <p class="w3-opacity w3-center"><i>Any issue ? Just fill in the following form :</i></p>
            <div class="w3-row w3-padding-32">
                <div class="w3-col m6 w3-large w3-margin-bottom">
                    <i class="fa fa-map-marker" style="width:30px"></i>Epita Paris - Fr<br>
                    <i class="fa fa-phone" style="width:30px"></i> Phone: coming soon<br>
                    <i class="fa fa-envelope" style="width:30px"> </i> Email: comming soon<br>
                </div>
                <div class="w3-col m6">
                    <form action="" target="_blank">
                        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="text" placeholder="Username" required name="Name">
                            </div>
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="mail" placeholder="Email adress" required name="Email">
                            </div>
                        </div>
                        <input class="w3-input w3-border" type="text" placeholder="Your issue" required name="Message">
                        <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <?php include_once 'Includes/Footer.php'  ?>
    </footer>
</body>

</html>
