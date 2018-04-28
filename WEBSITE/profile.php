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
    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
    </style>
    <?php
    include_once 'Includes/Header.php'
    ?>
</header>

<main class="w3-light-grey">
    <?php
    $dataexist = false;
    $id = '';
    if (isset($_GET['q']) && !empty($_GET['q']))
        $id = $_GET['q'];
    else if(IsLogged())
        $id = $_SESSION['id'];
    else
        $power = -1;

    $database = "_gplayer";
    $bdd = Database($database);
    try {
        $req = $bdd->prepare("SELECT * FROM informations WHERE id=?");
        $req->execute(array($id));
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    if ($donnees = $req->fetch()) {
        $dataexist = true;
        $pseudo = $donnees['pseudo'];
        $fname = $donnees['firstName'];
        $lname = $donnees['lastName'];
        $email = $donnees['email'];
        $signup = $donnees['dateCreation'];
        $power = $donnees['power'];
    }
    else { ?>
        <script>
            $(document).ready(function () {
                hideProfile()
            })
        </script>
    <?php }  ?>

    <script>
        function showResult(str) {
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            if (window.XMLHttpRequest) {
                xmlhttp=new XMLHttpRequest();
            } else {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("livesearch").innerHTML = this.responseText;
                    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET","/Includes/PHP/livesearch.php?q="+str,true);
            xmlhttp.send();
        }
    </script>




    <!-- search bar menu -->
    <div class="w3-container">
        <h2>Search player :</h2>
        <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for usernames.." onkeyup="showResult(this.value)">
        <div id="livesearch" class="w3-white">

        </div>
        <br>
    </div>

    <div id="myProfile" style="min-height: 700px;">
        <!-- Top container : Bar -->
        <div class="w3-bar w3-black w3-large" style="z-index:4">
            <button class="w3-hide-large w3-bar-item w3-button w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
            <img src="/img/logo.png" class="w3-bar-item w3-left w3-hide-small" style="width: 110px;height: 90px;"/>
            <span class="w3-bar-item"><h1>Player info </h1></span>
        </div>

        <!-- Sidebar/menu -->
        <div class="w3-container w3-third w3-collapse w3-white w3-animate-left" id="mySidebar"><br>
            <div class="w3-container w3-row">
                <div class="w3-col s4">
                    <img src="/img/defaut-profile.png" class="w3-circle w3-margin-right" style="width: 100%">
                </div>
                <div class="w3-col s8">
                    <?php
                    if (UserIsOnHisProfile($id)) { ?>
                    <span><h3>Hi <strong><?php echo $pseudo; ?></strong></h3></span>
                    <?php } else { ?>
                    <span><h3><strong><?php echo $pseudo; ?></strong>'s profile</h3></span>
                    <?php }
                    if(isset($id) && !empty($id)){
                        $url_image_rank = '';
                        switch ($power){
                            case 0:
                                $url_image_rank = 'img\Banned.png';
                                break;
                            case 1:
                                $url_image_rank = 'img\User.png';
                                break;
                            case 2:
                                $url_image_rank = 'img\Sponsor.png';
                                break;
                            case 3:
                                $url_image_rank = 'img\Mod.png';
                                break;
                            case 4:
                                $url_image_rank = 'img\Admin.png';
                                break;
                            default:
                                $url_image_rank = 'img\Banned.png';
                                break;
                        }
                        echo '<img style="width:110px" src="'.$url_image_rank.'">';
                    }
                    ?>
                </div>
            </div>
            <hr>
            <div class="w3-container">
                <h5>Dashboard</h5>
            </div>
            <div class="w3-bar-block">
                <button onclick="Tabselector('tabl_overview', 'tab_overview')" id="tabl_overview" class="tab w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</button>
                <button onclick="Tabselector('tabl_general', 'tab_general')" id="tabl_general" class="tab w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  General</button>
                <button onclick="Tabselector('tabl_history', 'tab_history')" id="tabl_history" class="tab w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</button>
                <?php if(HasAccess(max(3, $power), $_SESSION['power'])) {?>
                <button onclick="Tabselector('tabl_moderation', 'tab_moderation')" id="tabl_moderation" class="tab w3-bar-item w3-button w3-padding"><i class="fa fa-lock fa-fw"></i>  Moderation</button>
                <?php } ?>
                <?php if(UserIsOnHisProfile($id)|| HasAccess(max(3, $power), $_SESSION['power'])) { ?>
                <button onclick="Tabselector('tabl_setting', 'tab_setting')" id="tabl_setting" class="tab w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</button>
                <br> <br>
                <button onclick="Tabselector('tabl_message', 'tab_message')" id="tabl_message" class="tab w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw"></i> Messages</button>
                <?php } ?>
            </div>
        </div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main w3-rest" style="margin-left:300px;margin-top:20px;">
            <div class="w3-container tab_content" id="tab_overview">
                <h2>Overview of your account : </h2>
                <p>This functionality has not been implemented yet !</p>
                <p>
                    Cercle qui presente pourcentage win / tie / loose <br>
                    tableau qui presente en fonction du temps le nombre de parties dans le-dit intervalle de temps <br>
                    Idées? <br>
                </p>
            </div>

            <div class="w3-container tab_content" id="tab_general" style="display: none">
                <h2>General information : </h2>
                <p>This functionality has not been implemented yet !</p>
                <p>Je sais pas encore quoi mettre ici</p>
            </div>

            <div class="w3-container tab_content" id="tab_history" style="display: none">
                <h2>History of played matches : </h2>
                <p>This functionality has not been implemented yet !</p>
                <p>Historique des matchs jouées avec quelques infos qu'on retrouve dans overview en general</p>
            </div>

            <?php
            if(HasAccess(max(3, $power), $_SESSION['power'])) {?>

            <div class="w3-container tab_content" id="tab_moderation" style="display: none">
                <h1>User moderation : </h1>
                <?php if(isset($_SESSION['reponse_edit_moderator']) && !empty($_SESSION['reponse_edit_moderator'])){
                    echo '<div class="w3-padding-top w3-margin-top w3-content w3-center w3-container w3-'.$_SESSION['color_edit_moderator'].'">
                                 <h3>'.$_SESSION['reponse_edit_moderator'].'</h3>
                              </div> <br>';
                    unset($_SESSION['reponse_edit_moderator'],$_SESSION['color_edit_moderator']);
                } ?>
                <h2> User rank : </h2>
                <p>Description : you can change the user's rank !</p>
                <ul>
                    <form method="post" action="Includes/PHP/mod_rank.php">
                        <li>Current User Rank  : </li>
                        <?php echo GetUserRank($power); ?> <br>
                        <li> New User's rank  :</li>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <select name="rank" required>
                            <option value="" disabled selected>Choose a rank</option>
                            <?php
                            for ($i = 0; $i <= $_SESSION['power']; $i++){
                                echo '<option value="'.$i.'">'.GetUserRank($i).'</option>';
                            } ?>
                        </select> <br>
                        <input type="submit">
                    </form>
                </ul>
                <?php if(HasAccess($power+1, $_SESSION['power'])){ ?>
                <h2> Email address : </h2>
                <p>Description : you can change the user's email address here !</p>
                <ul>
                    <form method="post" action="Includes/PHP/mod_email.php">
                        <li>Current email address  : </li>
                        <?php echo $email; ?> <br>
                        <li> New email address  :</li>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="email" placeholder="New Email address" name="email"
                               required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')">
                        <li> Confirm email address  :</li>
                        <input type="email" placeholder="Confirm Email address" name="email_conf"
                               required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')">
                        <br>
                        <input type="submit">
                    </form>
                </ul>
                <h2> Password : </h2>
                <p>Description : you can change the user's password here !</p>
                <ul>
                    <form method="post" action="Includes/PHP/mod_password.php">
                        <li> New password  : </li>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="password" placeholder="Enter new Password" name="newpassword"
                               required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>
                        <li> Confirm password  :</li>
                        <input type="password" placeholder="Confirm new Password" name="newpassword_conf"
                               required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>
                        <input type="submit">
                    </form>
                </ul>
                <?php } ?>
            </div>

            <?php } ?>
            <?php if(UserIsOnHisProfile($id) || HasAccess(max(3, $power), $_SESSION['power'])) {?>

            <div class="w3-container tab_content" id="tab_setting" style="display: none">
                <div>
                    <h1>User Settings : </h1>
                    <?php if(isset($_SESSION['reponse_edit_setting']) && !empty($_SESSION['reponse_edit_setting'])){
                        echo '<div class="w3-padding-top w3-margin-top w3-content w3-center w3-container w3-'.$_SESSION['color_edit_setting'].'">
                                 <h3>'.$_SESSION['reponse_edit_setting'].'</h3>
                              </div> <br>';
                        unset($_SESSION['reponse_edit_setting'],$_SESSION['reponse_edit_setting']);
                    } ?>
                    <h2> Email address : </h2>
                    <p>Description : you can change your email address here !</p>
                    <ul>
                        <form method="post" action="Includes/PHP/user_email.php">
                            <li>Current email address  : </li>
                            <?php echo $email; ?> <br>
                            <li> New email address  :</li>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="email" placeholder="New Email address" name="email"
                                   required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')">
                            <li> Confirm email address  :</li>
                            <input type="email" placeholder="Confirm Email address" name="email_conf"
                                   required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')">
                            <li> Current password  :</li>
                            <input type="password" placeholder="Enter Current Password" name="password"
                                   required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>
                            <input type="submit">
                        </form>
                    </ul>
                </div>
                <div>
                    <h2> Password : </h2>
                    <p>Description : you can change your password here !</p>
                    <ul>
                        <form method="post" action="Includes/PHP/user_password.php">
                            <li> New password  : </li>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="password" placeholder="Enter new Password" name="newpassword"
                                   required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>
                            <li> Confirm password  :</li>
                            <input type="password" placeholder="Confirm new Password" name="newpassword_conf"
                                   required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>
                            <li> Current password  :</li>
                            <input type="password" placeholder="Enter Current Password" name="password"
                                   required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>
                            <input type="submit">
                        </form>
                    </ul>
                </div>
            </div>

            <div class="w3-container tab_content" id="tab_message" style="display: none">
                <h2>All send messages : </h2>
                <p>This functionality has not been implemented yet !</p>
            </div>

            <?php } ?>
            <!-- End page content -->
        </div>
    </div>




    <script>
        function Tabselector(tab, content) {
            var i, x, tablinks;
            x = document.getElementsByClassName("tab_content");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tab");
            for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" w3-blue", "");
            }
            document.getElementById(content).style.display = "block";
            document.getElementById(tab).className += " w3-blue";
        }

        // Toggle between showing and hiding the sidebar, and add overlay effect
        var mySidebar = document.getElementById("mySidebar");
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
            } else {
                mySidebar.style.display = 'block';
            }
        }

        //hides profile section
        function hideProfile() {
            var myProfile = document.getElementById("myProfile");
            myProfile.style.display = 'none';
        }
    </script>
</main>

<footer>
    <?php
    include_once 'Includes/Footer.php'
    ?>
</footer>
</body>
</html>
