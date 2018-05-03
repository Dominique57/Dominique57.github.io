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
        <?php include_once 'Includes/Header.php';
        function human_filesize($bytes, $decimals = 2) {
            $sz = 'BKMGTP';
            $factor = floor((strlen($bytes) - 1) / 3);
            return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
        }
        ?>
    </header>

    <main class="w3-padding-64">
        <h1 class="w3-center w3-xxxlarge"><b><i class="	fa fa-download"></i> Download :</b><br><br></h1>
        <div class="w3-container" style="width: 90%;display: block; margin-left: auto;margin-right: auto;">
            <h2 class="w3-content w3-center">Download links :</h2><br><br>
            <div class="w3-responsive w3-card-4">
                <table class="w3-table-all">
                    <tr class="w3-indigo">
                        <th>Download type : </th>
                        <th>Platform : </th>
                        <th>Architecture : </th>
                        <th>Link : </th>
                    </tr>
                    <tr>
                        <td class="w3-blue">Github</td>
                        <td>Windows</td>
                        <td>32bits / 64 bits</td>
                        <td class="w3-green"><p><a href="https://github.com/SanderJSA/HelloWorld" target="_blank">Download here</a></p></td>
                    </tr>
                    <tr>
                        <?php
                        $filepathGame = 'img/HelloWorld_by_GotoBreak.zip';
                        $filesizeGame = 0;
                        if(file_exists($filepathGame)) { $filesizeGame = filesize($filepathGame); }
                        $filesizeGame = human_filesize($filesizeGame, 3);
                        ?>
                        <td class="w3-blue">Direct download</td>
                        <td>Windows</td>
                        <td>32bits / 64 bits</td>
                        <td class="w3-green"><p><a href="img/HelloWorld_by_GotoBreak.zip" download="HelloWorld_by_GotoBreak.zip">Download here (<?php echo $filesizeGame;?>)</a></p></td>
                    </tr>
                    <tr>
                        <td class="w3-blue">Download installer</td>
                        <td>Windows</td>
                        <td>32bits / 64 bits</td>
                        <td class="w3-red">Not avaible for the moment</td>
                    </tr>
                    <tr>
                        <td class="w3-blue">Torrent Download</td>
                        <td>Windows</td>
                        <td>32bits / 64 bits</td>
                        <td class="w3-red">Not avaible for the moment</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="w3-container" style="width: 90%;display: block; margin-left: auto;margin-right: auto;">
            <br><br><br>
            <h2 class="w3-content w3-center">Other component download links :</h2><br><br>
            <div class="w3-responsive w3-card-4">
                <table class="w3-table-all">
                    <tr class="w3-indigo">
                        <th style="width: 15%">Component : </th>
                        <th style="width: 45%">Description : </th>
                        <th style="width: 15%">Size : </th>
                        <th style="width: 35%">Link : </th>
                    </tr>
                    <tr>
                        <?php
                        $filepath = 'img/KENNYPLAGUE.mp3';
                        $filesize = 0;
                        if(file_exists($filepath)) { $filesize = filesize($filepath); }
                        $filesize = human_filesize($filesize, 3);
                        ?>
                        <td class="w3-blue">Music</td>
                        <td>This is the background music of the game that has been made especially four our game.</td>
                        <td><?php echo $filesize; ?></td>
                        <td class="w3-green"><p><a href="<?php echo $filepath; ?>" download="music-gotobreak.mp3">Download now</a></p></td>
                    </tr>
                </table>
            </div>
        </div>
    </main>

    <footer>
        <?php include_once 'Includes/Footer.php'  ?>
    </footer>
</body>

</html>
