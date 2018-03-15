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
        <div class="w3-container">
            <div class="w3-row">
                <a href="javascript:void(0)" onclick="openCity(event, 'New');">
                    <div class="w3-xxlarge w3-red w3-bottombar w3-third tablink w3-hover-opacity w3-padding">New</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Processing');">
                    <div class="w3-xxlarge w3-orange w3-bottombar w3-third tablink w3-hover-opacity w3-padding">Processing</div>
                </a>
                <a href="javascript:void(0)" onclick="openCity(event, 'Fixed');">
                    <div class="w3-xxlarge w3-green w3-bottombar w3-third tablink w3-hover-opacity w3-padding">Fixed</div>
                </a>
            </div>

            <div id="New" class="w3-container bug" style="display:none">
                <table class="w3-table-all">
                    <tr>
                        <th>Bug ID</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                    <tr>
                        <td>#0001</td>
                        <td>Some Bug title</td>
                        <td>Some bug description</td>
                    </tr>
                    <tr>
                        <td>#0002</td>
                        <td>Some Bug title</td>
                        <td>Some bug description</td>
                    </tr>
                    <tr>
                        <td>#0003</td>
                        <td>Some Bug title</td>
                        <td>Some bug description</td>
                    </tr>
                    <tr>
                        <td>#0004</td>
                        <td>Some Bug title</td>
                        <td>Some bug description</td>
                    </tr>
                </table>
            </div>

            <div id="Processing" class="w3-container bug" style="display:none">
                <table class="w3-table-all">
                    <tr>
                        <th>Bug ID</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
                </table>
            </div>

            <div id="Fixed" class="w3-container bug" style="display:none">
                <table class="w3-table-all">
                    <tr>
                        <th>Bug ID</th>
                        <th>Title</th>
                        <th>Description</th>
                    </tr>
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

    </main>

    <footer>
        <?php include_once 'Includes/Footer.php'  ?>
    </footer>
</body>

</html>
