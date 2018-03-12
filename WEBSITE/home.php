<!DOCTYPE html>
<html>
<head>
    <?php
    include_once 'Includes/Head.php';
    ?>
</head>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
<!-- Navbar -->
<?php
include_once 'Includes/Header.php'
?>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

    <!-- acceuil -->
    <div class="w3-container w3-content w3-center">

    </div>

    <!-- presentation -->
    <div class="w3-container w3-content w3-center" id="presentation">

    </div>

    <!-- equipe -->
    <div class="w3-container w3-content w3-center" id="equipe">

    </div>


    <!-- End Page Content -->

    <!-- Footer -->
    <?php
    include_once 'Includes/Footer.php'
    ?>
    <!-- The Tour Section -->
    <div class="w3-black" id="tour">
        <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
            <h2 class="w3-wide w3-center">TOUR DATES</h2>
            <p class="w3-opacity w3-center"><i>Remember to book your tickets!</i></p><br>

            <ul class="w3-ul w3-border w3-white w3-text-grey">
                <li class="w3-padding">September <span class="w3-tag w3-red w3-margin-left">Sold out</span></li>
                <li class="w3-padding">October <span class="w3-tag w3-red w3-margin-left">Sold out</span></li>
                <li class="w3-padding">November <span class="w3-badge w3-right w3-margin-right">3</span></li>
            </ul>

            <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
                <div class="w3-third w3-margin-bottom">
                    <img src="/w3images/newyork.jpg" alt="New York" style="width:100%" class="w3-hover-opacity">
                    <div class="w3-container w3-white">
                        <p><b>New York</b></p>
                        <p class="w3-opacity">Fri 27 Nov 2016</p>
                        <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                        <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                    </div>
                </div>
                <div class="w3-third w3-margin-bottom">
                    <img src="/w3images/paris.jpg" alt="Paris" style="width:100%" class="w3-hover-opacity">
                    <div class="w3-container w3-white">
                        <p><b>Paris</b></p>
                        <p class="w3-opacity">Sat 28 Nov 2016</p>
                        <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                        <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                    </div>
                </div>
                <div class="w3-third w3-margin-bottom">
                    <img src="/w3images/sanfran.jpg" alt="San Francisco" style="width:100%" class="w3-hover-opacity">
                    <div class="w3-container w3-white">
                        <p><b>San Francisco</b></p>
                        <p class="w3-opacity">Sun 29 Nov 2016</p>
                        <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                        <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>
