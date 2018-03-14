<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 25/01/2018
 * Time: 09:51
 */
?>

<div class="w3-display-container">
    <img src="/img/space-banner.jpg" class="w3-animate-opacity" alt="Lights" style="width: 100%;max-height: 200px">
        <div class="w3-top">
            <div class="w3-bar w3-indigo w3-card">
                <!-- left -->
                <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
                <a href="/home.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
                <a href="/presentation.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Presentation</a>
                <a href="/download.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Download</a>
                <div class="w3-dropdown-hover w3-hide-small">
                    <button class="w3-padding-large w3-button" title="More">More <i class="fa fa-caret-down"></i></button>
                    <div class="w3-dropdown-content w3-indigo w3-bar-block w3-card-4">
                        <a href="/about.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">About us</a>
                        <a href="/contact.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Contact</a>
                        <a href="/bug.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Report Bug</a>
                    </div>
                </div>

                <!-- right -->
                <span class="w3-bar-item w3-button w3-padding-large w3-right" onclick="document.getElementById('id01').style.display='block'">Login</span>
                <a href="/profile.php" class="w3-bar-item w3-button w3-padding-large w3-right">Profile</a>
            </div>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-indigo w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
            <a href="/presentation.php" class="w3-bar-item w3-button w3-padding-large">Presentation</a>
            <a href="/download.php" class="w3-bar-item w3-button w3-padding-large">Download</a>
            <a href="/about.php" class="w3-bar-item w3-button w3-padding-large">About us</a>
            <a href="/contact.php" class="w3-bar-item w3-button w3-padding-large">Contact</a>
            <a href="/bug.php" class="w3-bar-item w3-button w3-padding-large">Report Bug</a>

        </div>
</div>



<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    }
    else {
    x.className = x.className.replace(" w3-show", "");
    }
}
</script>

<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

        <div class="w3-center"><br>
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            <img src="/img/defaut-profile.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
        </div>

        <form class="w3-container" action="/login.php">
            <div class="w3-section">
                <label><b>Username</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required>
                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="psw" required>
                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
                <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
            </div>
        </form>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
            <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
        </div>

    </div>
</div>