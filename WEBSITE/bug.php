<?php
include_once 'Includes/session.php';
?>
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

    <main class="w3-padding-64">
        <h1 class="w3-center w3-xxxlarge"><b><i class="fa fa-bug"></i> Bug report :</b><br><br></h1>
        <div class="w3-container" style="min-height: 350px">
            <div class="w3-row w3-card-4">
                <a href="javascript:void(0)" onclick="openCity(event, 'New');">
                    <div class="w3-xxlarge w3-red w3-bottombar w3-third tablink w3-hover-opacity w3-padding w3-border-black">New</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Processing');">
                    <div class="w3-xxlarge w3-orange w3-bottombar w3-third tablink w3-hover-opacity w3-padding">Processing</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Fixed');">
                    <div class="w3-xxlarge w3-green w3-bottombar w3-third tablink w3-hover-opacity w3-padding">Fixed</div>
                </a>
            </div>
            <?php
            include_once 'Includes/Database/DbConnect.php';
            $bdd = Database();

            $new = array();
            $processed = array();
            $fixed = array();

            try {
                $req = $bdd->prepare("SELECT * FROM bug WHERE status = 0 ORDER BY id DESC LIMIT 5 ");
                $req->execute();
            }
            catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
            while ($donnees = $req->fetch())
                $new[] = $donnees;
            $donnees = null;

            try {
                $req = $bdd->prepare("SELECT * FROM bug WHERE status = 1 ORDER BY id DESC LIMIT 5");
                $req->execute();
            }
            catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
            while ($donnees = $req->fetch())
                $processed[] = $donnees;
            $donnees = null;

            try {
                $req = $bdd->prepare("SELECT * FROM bug WHERE status = 2 ORDER BY id DESC LIMIT 5");
                $req->execute();
            }
            catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
            while ($donnees = $req->fetch())
                $fixed[] = $donnees;
            $req = null;
            $donnees = null;

            if (IsLogged()) {
                try {
                    $req = $bdd->prepare("SELECT power FROM informations WHERE id=:id LIMIT 1");
                    $req->execute(array(
                        'id' => $_SESSION['id']));
                }
                catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }
                if($donnees = $req->fetch()){
                    $power = $donnees['power'];
                }
            }
            ?>

            <div id="New" class="w3-container bug">
                <table class="w3-table-all w3-card-4 w3-responsive">
                    <tr class="w3-indigo w3-large">
                        <th style="width: 5%;">Bug ID</th>
                        <th style="width: 10%;">Author</th>
                        <th style="width: 10%;">Title</th>
                        <th class="w3-rest">Description</th>
                        <?php if(isset($power) && $power >= 2) { ?>
                        <th style="width: 5%;">Action</th>
                        <?php } ?>
                    </tr>
                    <?php
                    $increm = 0;
                    foreach ($new as $item) {
                        ?>
                        <tr class="w3-<?php if($increm++%2==0){echo'light-gray';}else{echo'light-blue';}?>">
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $item['author']; ?></td>
                            <td><?php echo $item['title']; ?></td>
                            <td><?php echo $item['description']; ?></td>
                            <?php if(isset($power) && $power >= 2) { ?>
                                <td class="w3-right"><i class="material-icons">edit</i></td>
                            <?php } ?>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>

            <div id="Processing" class="w3-container bug" style="display:none">
                <table class="w3-table-all">
                    <tr class="w3-indigo w3-large">
                        <th style="width: 5%;">Bug ID</th>
                        <th style="width: 10%;">Author</th>
                        <th style="width: 10%;">Title</th>
                        <th class="w3-rest">Description</th>
                        <?php if(isset($power) && $power >= 2) { ?>
                            <th style="width: 5%;">Action</th>
                        <?php } ?>                    </tr>
                    <?php
                    $increm = 0;
                    foreach ($processed as $item) {
                        ?>
                        <tr class="w3-<?php if($increm++%2==0){echo'light-gray';}else{echo'light-blue';}?>">
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $item['author']; ?></td>
                            <td><?php echo $item['title']; ?></td>
                            <td><?php echo $item['description']; ?></td>
                            <?php if(isset($power) && $power >= 2) { ?>
                                <td class="w3-right"><i class="material-icons">edit</i></td>
                            <?php } ?>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>

            <div id="Fixed" class="w3-container bug" style="display:none">
                <table class="w3-table-all">
                    <tr class="w3-indigo w3-large">
                        <th style="width: 5%;">Bug ID</th>
                        <th style="width: 10%;">Author</th>
                        <th style="width: 10%;">Title</th>
                        <th class="w3-rest">Description</th>
                        <?php if(isset($power) && $power >= 2) { ?>
                            <th style="width: 5%;">Action</th>
                        <?php } ?>
                    </tr>
                    <?php
                    $increm = 0;
                    foreach ($fixed as $item) {
                        ?>
                        <tr class="w3-<?php if($increm++%2==0){echo'light-gray';}else{echo'light-blue';}?>">
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $item['author']; ?></td>
                            <td><?php echo $item['title']; ?></td>
                            <td><?php echo $item['description']; ?></td>
                            <?php if(isset($power) && $power >= 2) { ?>
                                <td class="w3-right"><i class="material-icons">edit</i></td>
                            <?php } ?>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <script>
            function openCity(evt, bugcategory) {
                var i, x, tablinks;
                x = document.getElementsByClassName("bug");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < x.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" w3-border-black", "");
                }
                document.getElementById(bugcategory).style.display = "block";
                evt.currentTarget.firstElementChild.className += " w3-border-black";
            }
        </script>


        <?php
        if(isset($_POST['title']) && isset($_POST['message']))
            include_once 'Includes/PHP/bug_send.php';
        if (isset($response) && !empty($response)) {
            $color = "red";
            if (isset($errorcode) && !empty($errorcode)) {
                if ($errorcode == '1') {
                    $color = "orange";
                } else if ($errorcode == '2') {
                    $URL="bug.php";
                    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                    $color = "green";
                }
            } ?>
        <div class="w3-padding-top w3-margin-top w3-content w3-center w3-container w3-<?php echo $color?>">
            <h3><?php echo $response;?></h3>
        </div> <br>
        <?php } ?>

        <div class="w3-container w3-content">
            <h1 class="w3-center w3-xxlarge"><b>Have found a bug? </b></h1>
        <?php
        if (isset($_SESSION['isLogged']) && $_SESSION['isLogged']) { ?>
            <h2 class="w3-center w3-large"><i>Please fill in the following form :</i></h2>
            <form action="/bug.php" method="post">
                <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                    <div class="w3-half">
                        <input class="w3-input" type="text" placeholder="Title..." name="title" style="border: 2px solid grey;border-radius: 4px;" <?php if(isset($_POST['title'])){echo 'value="'.$_POST['title'].'"';} ?>
                               required pattern="^.{1, 50}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 1 - 50 letters and numbers !')">
                    </div>
                </div>
                <textarea class="w3-input" type="text" placeholder="Your issue..." name="message" style="border: 2px solid grey;border-radius: 4px;height: 200px;"
                          required oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 1 - 500 characters !')"> <?php if(isset($_POST['message'])){echo $_POST['message'];} ?></textarea>
                <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
            </form>
        <?php } else { ?>
            <div class="w3-panel w3-greyscale w3-content w3-container w3-center">
                <h3>Consider <em>logging in</em> or <em>signing up</em> to submit new bug reports !<br>
                    And guess what? It is free ! <br>
                    <i class="fa fa-smile-o w3-xxlarge"></i></h3>
            </div>
        <?php } ?>
        </div>


    </main>

    <footer>
        <?php include_once 'Includes/Footer.php'  ?>
    </footer>
</body>

</html>
