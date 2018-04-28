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

    <?php
    $tabchoice = 0;
    if(isset($_GET['tabchoice']) && !empty($_GET['tabchoice']) && ($_GET['tabchoice'] == 1))
        $tabchoice = 1;
    if(isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['email_conf']) && isset($_POST['pswd']) && isset($_POST['pswd_conf']))
        include_once 'Includes/PHP/login_check.php';
    if(isset($_POST['log_username']) && isset($_POST['log_pswd']))
        include_once 'Includes/PHP/login_identify.php';
    ?>

    <div class="w3-container w3-content w3-padding-32" style="max-width:600px">
        <?php
        if (isset($response) && !empty($response)) {
            $color = "red";
            if (isset($errorcode) && !empty($errorcode)) {
                if ($errorcode == '1') {
                    $color = "orange";
                } else if ($errorcode == '2') {
                    $color = "green";
                }
            }
            ?>
            <div class="w3-content w3-center w3-container w3-<?php echo $color?>">
                <h3><?php echo $response;?></h3>
            </div>
            <br>
            <?php
        }
        ?>

        <div class="w3-bar w3-indigo w3-card">
            <a class="w3-bar-item w3-button w3-left w3-xlarge tablink_page <?php if($tabchoice == 0){echo "w3-grey";}?>" onclick="openTab_page(event,'signin_page')">Log in</a>
            <a class="w3-bar-item w3-button w3-right w3-xlarge tablink_page <?php if($tabchoice == 1){echo "w3-grey";}?>" onclick="openTab_page(event,'signup_page')">Sign up</a>
        </div>
        <div class="w3-center"><br>
            <br>
            <img src="/img/defaut-profile.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
        </div>

        <form method="post" class="w3-container actionType_page" id="signin_page" action="/login.php" style="<?php if($tabchoice == 0){echo "display: block";}else{echo "display: none";} ?>">
            <div class="w3-section">
                <label><b>Username</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="log_username" value="<?php if(isset($_POST['log_username'])) echo $_POST['log_username'];?>"
                       required pattern="^[0-9a-zA-Z.-_!\[\]|]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters and numbers and some special chars!')">
                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="log_pswd"
                       required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>

                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
                <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
            </div>
        </form>

        <form method="post" class="w3-container actionType_page" id="signup_page" action="/login.php?tabchoice=1" style="<?php if($tabchoice == 1){echo "display: block";}else{echo "display: none";}?>">
            <div class="w3-section">
                <label><b>Username</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter Username" name="username"  value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>"
                       required pattern="^[0-9a-zA-Z.-_!\[\]|]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters and numbers and some special chars!')"> <br>
                <label><b>Firstname</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter Firstname" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>"
                       required pattern="^[a-zA-Z]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters !')"> <br>
                <label><b>Lastname</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter Lastname" name="lastname" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']; ?>"
                       required pattern="^[a-zA-Z]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters !')"> <br>
                <label><b>Email</b></label>
                <input class="w3-input w3-border" type="email" placeholder="Enter Email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"
                       required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')"> <br>
                <label><b>Confirm Email</b></label>
                <input class="w3-input w3-border" type="email" placeholder="Confirm Email" name="email_conf" value="<?php if(isset($_POST['email_conf'])) echo $_POST['email_conf']; ?>"
                       required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')"> <br>
                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="pswd"
                       required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>
                <label><b>Confirm Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Confirm Password" name="pswd_conf"
                       required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>

                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Sign up</button>
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
