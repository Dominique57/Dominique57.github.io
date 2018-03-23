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

<main class="">

    <script>
    function openTab_page(evt, actionType) {
        var i, x, tablinks;
        x = document.getElementsByClassName("actionType_page");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink_page");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-grey", "");
        }
        document.getElementById(actionType).style.display = "block";
        evt.currentTarget.className += " w3-grey";
    }
    </script>

    <div class="w3-container w3-content w3-padding-32" style="max-width:600px">

        <div class="w3-bar w3-indigo w3-card">
            <a class="w3-bar-item w3-button w3-left w3-xlarge tablink_page w3-grey" onclick="openTab_page(event,'signin_page')">Log in</a>
            <a class="w3-bar-item w3-button w3-right w3-xlarge tablink_page" onclick="openTab_page(event,'signup_page')">Sign up</a>
        </div>
        <div class="w3-center"><br>
            <br>
            <img src="/img/defaut-profile.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
        </div>

        <form class="w3-container actionType_page" id="signin_page" action="/login.php">
            <div class="w3-section">
                <label><b>Username</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="username" required>
                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="psw" required>

                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
                <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
            </div>
        </form>

        <form class="w3-container actionType_page" id="signup_page" action="/login.php" style="display: none">
            <div class="w3-section">
                <label><b>Username</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter Username" name="username" required> <br>
                <label><b>Firstname</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter Firstname" name="firstname" required> <br>
                <label><b>Lastname</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter Lastname" name="last   name" required> <br>
                <label><b>Email</b></label>
                <input class="w3-input w3-border" type="email" placeholder="Enter Email" name="email" required> <br>
                <label><b>Confirm Email</b></label>
                <input class="w3-input w3-border" type="email" placeholder="Confirm Email" name="email_conf" required> <br>
                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="pswd" required> <br>
                <label><b>Confirm Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Confirm Password" name="pswd_conf" required> <br>

                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
                <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
            </div>
        </form>

        <div class="w3-center w3-container w3-border-top w3-padding-16 w3-light-grey">
            <span class="w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
        </div>

    </div>

</main>

<footer>
    <?php include_once 'Includes/Footer.php'  ?>
</footer>
</body>

</html>
