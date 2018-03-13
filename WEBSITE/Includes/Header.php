<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 25/01/2018
 * Time: 09:51
 */
?>
<div class="w3-display-container">
    <img src="/img/space-banner.jpg" class="w3-animate-opacity  " alt="Lights" style="width: 100%;max-height: 200px">
        <div class="w3-top">
            <div class="w3-bar w3-indigo w3-card">
                <!-- left -->
                <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
                <a href="/home.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
                <a href="/presentation.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Presentation</a>
                <a href="/about.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">About us</a>
                <a href="/contact.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Contact</a>
                <div class="w3-dropdown-hover w3-hide-small">
                    <button class="w3-padding-large w3-button" title="More">More <i class="fa fa-caret-down"></i></button>
                    <div class="w3-dropdown-content w3-indigo w3-bar-block w3-card-4">
                        <a href="/download.php" class="w3-bar-item w3-button">Download</a>
                    </div>
                </div>

                <!-- right -->
                <a href="/login.php" class="w3-bar-item w3-button w3-padding-large w3-right">Login</a>
                <a href="/profile.php" class="w3-bar-item w3-button w3-padding-large w3-right">Profile</a>
            </div>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-indigo w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
            <a href="/presentation.php" class="w3-bar-item w3-button w3-padding-large">Presentation</a>
            <a href="/about.php" class="w3-bar-item w3-button w3-padding-large">About us</a>
            <a href="/contact.php" class="w3-bar-item w3-button w3-padding-large">Contact</a>
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