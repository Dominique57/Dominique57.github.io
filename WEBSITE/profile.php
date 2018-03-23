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
    if (isset($_GET['q']) && ($_GET['q']) != null) //if GET data sent
    {
        $database = "_gplayer";
        $bdd = Database($database);
        try {
            $req = $bdd->prepare("SELECT * FROM informations WHERE id=?");
            $req->execute(array($_GET['q']));
        }
        catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        if($req->rowCount() == 1){
            while ($donnees = $req->fetch())
                {
                    $pseudo = $donnees['pseudo']. "<br/>";
                    $fname = $donnees['firstName']. "<br/>";
                    $lname = $donnees['lastName']. "<br/>";
                    $email = $donnees['email']. "<br/>";
                    $signup = $donnees['dateCreation']. "<br/>";
                }
        }else{
            ?>
                <script>
                    $(document).ready(function () {
                        hideProfile()
                    })
                </script>
            <?php
        }
    }
    else
    {
        ?>
            <script>
                $(document).ready(function () {
                    hideProfile()
                })
            </script>
        <?php
    }
    ?>

    <script>
        function showResult(str) {
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("livesearch").innerHTML = this.responseText;
                    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET","livesearch.php?q="+str,true);
            xmlhttp.send();
        }
    </script>

    <!-- search bar menu -->
    <div class="w3-container">
        <h2>Search player :</h2>
        <p>(It is case sensitive)   </p>
        <input class="w3-input w3-border w3-padding" type="text" placeholder="Search for usernames.." onkeyup="showResult(this.value)">
        <div id="livesearch" class="w3-white"></div>
        <br>
    </div>

    <div id="myProfile">
        <!-- Top container -->
        <div class="w3-bar w3-black w3-large" style="z-index:4">
            <button class="w3-hide-large w3-bar-item w3-button w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i> Menu</button>
            <img src="/img/logo.png" class="w3-bar-item w3-left w3-hide-small" style="width: 110px;height: 90px;"/>
            <span class="w3-bar-item"><h1> Player info </h1></span>
            <button class="w3-bar-item w3-button w3-right w3-hover-text-light-grey" ><i class="fa fa-sign-out"></i> Sign out</button>
        </div>

        <!-- Sidebar/menu -->
        <div class="w3-container w3-third w3-collapse w3-white w3-animate-left" id="mySidebar"><br>
            <div class="w3-container w3-row">
                <div class="w3-col s4">
                    <img src="/img/defaut-profile.png" class="w3-circle w3-margin-right" style="width: 100%">
                </div>
                <div class="w3-col s8">
                    <span><h3>Welcome, <strong><?php echo $pseudo; ?></strong></h3></span><br>
                    <span>Firstname : <?php echo $fname; ?><br></span>
                    <span>Lastname : <?php echo $lname; ?><br></span>
                    <span>Email : <?php echo $email; ?><br></span>
                </div>
            </div>
            <hr>
            <div class="w3-container">
                <h5>Dashboard</h5>
            </div>
            <div class="w3-bar-block">
                <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
                <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
                <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  General</a>
                <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>
                <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a><br><br>
                <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw"></i> Messages</a>

            </div>
        </div>


        <!-- Overlay effect when opening sidebar on small screens -->
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main w3-rest" style="margin-left:300px;margin-top:43px;">

            <!-- Header -->
            <header class="w3-container" style="padding-top:22px">
                <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
            </header>
            <div class="w3-container w3-content" style="min-height: 500px">
            <p>
            </p>

        <!-- End page content -->
        </div>
    </div>

    <script>
        // Get the Sidebar
        var mySidebar = document.getElementById("mySidebar");

        // Toggle between showing and hiding the sidebar, and add overlay effect
        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
            } else {
                mySidebar.style.display = 'block';
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
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
