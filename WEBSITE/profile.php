<?php
include_once 'Includes/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Includes/circle.css">
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

    $bdd = Database();
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
            <button class="w3-hide-large w3-hide-medium w3-bar-item w3-button w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
            <img src="/img/logo.png" class="w3-bar-item w3-left w3-hide-small" style="width: 110px;height: 90px;"/>
            <span class="w3-bar-item"><h1>Player info </h1></span>
        </div>
        <?php
        if(isset($_SESSION['gameToSave']) && !empty($_SESSION['gameToSave'])) {
            $player1 = $_SESSION['gameToSave'][0];
            $haswon = $_SESSION['gameToSave'][1];
            $_SESSION['gameToSave'] = null;
            $URL="/game/insertmatch.php?p2=".$player1."&p1won=".$haswon;
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
        }
        ?>
        <!-- Sidebar/menu -->
        <div class="w3-container w3-third w3-collapse w3-white w3-animate-left" id="mySidebar"><br>
            <div class="w3-container w3-row">
                <div class="w3-col s4">
                    <img src="/img/defaut-profile.png" class="w3-circle w3-margin-right" style="width: 100%">
                </div>
                <div class="w3-col s8">
                    <?php
                    if (UserIsOnHisProfile($id)) { ?>
                        <h3><span>Hi <strong><?php echo $pseudo; ?></strong></span></h3>
                    <?php } else { ?>
                        <h3><span><strong><?php echo $pseudo; ?></strong>'s profile</span></h3>
                    <?php }
                    if(isset($id) && !empty($id)){
                        echo '<img style="width:110px" src="'.GetPathRank($power).'">';
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
                <br> <br> <br>
                <?php } ?>
            </div>
        </div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main w3-rest" style="margin-left:300px;margin-top:20px;">
            <div class="w3-container tab_content" id="tab_overview">
                <?php
                $bdd = Database();
                try {
                    $reqMatches = $bdd->prepare("SELECT player1won FROM matches WHERE player1=:id");
                    $reqMatches->execute(array(
                        "id" => $id));
                }
                catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }
                $won = 0;
                $lost = 0;
                $played = 0;
                $wratio = 0;
                while ($donnees = $reqMatches->fetch()) {
                    if($donnees['player1won'] == "0" || $donnees['player1won'] == "2")
                        $won++;
                    else if($donnees['player1won'] == "1")
                        $lost++;
                    else
                        $played++;
                }
                $played += $won + $lost;
                if($played == 0)
                    $wratio = 0;
                else
                    $wratio = round(($won / $played)*100);
                $colorCircle = "red";
                if($wratio >= 66)
                    $colorCircle = "green";
                else if ($wratio >= 33)
                    $colorCircle = "orange";
                ?>
                <h2>Overview of your account : </h2>
                <h3 class="w3-margin-bottom"><b>Winning ratio :</b></h3>
                <div style="width: 100%;">
                    <div class="c100 big <?php echo 'p'.+$wratio.' '.$colorCircle ?>">
                        <span><?php echo $wratio ?>%</span>
                        <div class="slice">
                            <div class="bar" style=""></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
                <div class="w3-half">
                    <p style="font-size: large"><b>Played matches : </b><?php echo $played ?></p>
                    <p style="font-size: large"><b>Won matches : </b><?php echo $won ?></p>
                    <p style="font-size: large"><b>Lost matches : </b><?php echo $lost ?></p>
                </div>

            </div>

            <div class="w3-container tab_content" id="tab_general" style="display: none">
                <h2>General information : </h2>
                <h4><b>Basic information's : </b></h4>
                <p><?php echo $fname.', '.$lname.'<br>AKA '.$pseudo ;?></p>
                <h4><b>Contact the user : </b></h4>
                <p><?php echo 'email : '.$email?></p>
                <h4><b>Account creation date :</b></h4>
                <p><?php echo 'Account created : '.$signup; ?></p>
            </div>

            <div class="w3-container tab_content" id="tab_history" style="display: none">
                <h2>History of played matches : </h2>
                <?php
                $bdd = Database();
                try {
                    $reqMatches = $bdd->prepare("SELECT * FROM matches WHERE player1=:id ORDER BY id DESC LIMIT 40");
                    $reqMatches->execute(array(
                            "id" => $id));
                }
                catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }
                if($reqMatches->rowCount() == 0) {
                    echo '<div class="w3-container w3-content w3-light-blue w3-margin w3-padding w3-card w3-round-large"><h3><em>This account has not any match history ... </em><br><b>Yet !</b></h3></div>';
                }
                while ($donneesMatches = $reqMatches->fetch()) {
                    $win = !($donneesMatches['player1won'] == 1);
                    ?>
                    <div class="w3-container w3-margin w3-light-blue w3-border-black w3-round-large w3-card-4">
                        <div class="w3-col w3-half"><h3><b>User:</b></h3><p style="font-size: 20px;"><em><?php echo $pseudo;?></em></p></div>
                        <div class="w3-col w3-half"><h3><b>Opponent:</b></h3><p style="font-size: 20px;"><em><?php echo $donneesMatches['player2'];?></em></p></div>
                        <div style="width: 100%"><p style="font-size: 20px"><em class="w3-padding w3-round-large w3-<?php if($win){ echo 'green';}else{echo 'red';}?>"><?php if($win){ echo '  Win  ';} else {echo '  Loose  ';} ?></em></p></div>
                    </div>
                <?php } ?>
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

            <?php
            }
            if(UserIsOnHisProfile($id) || HasAccess(max(3, $power), $_SESSION['power'])) {?>

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
