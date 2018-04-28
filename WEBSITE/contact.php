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

    <main class="w3-padding-64 w3-container">
        <h1 class="w3-center w3-xxxlarge"><b><i class="fa fa-send"></i> Contact section :</b><br><br></h1>
        <div class="w3-container">
            <div class="w3-container w3-half w3-hide-medium w3-hide-small">
                <div class="w3-content w3-container">
                    <h2 class="w3-wide w3-center">Contact Form</h2>
                        <div class="w3-large w3-margin-bottom">
                            <i class="fa fa-map-marker" style="width:30px"></i> Epita Paris<br>
                            <i class="fa fa-phone" style="width:30px"></i> Phone: coming soon<br>
                            <i class="fa fa-envelope" style="width:30px"> </i> Email: comming soon<br>
                        </div>
                        <p class="w3-opacity w3-center"><i>Any issue ? Just fill in the following form :</i></p>
                        <form action="" target="_blank">
                            <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                                <div class="w3-half">
                                    <input class="w3-input w3-border" type="text" placeholder="Username" name="Name"
                                           required pattern="^[0-9a-zA-Z]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters and numbers !')">
                                </div>
                                <div class="w3-half">
                                    <input class="w3-input w3-border" type="email" placeholder="Email adress" name="Email"
                                           required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')">
                                </div>
                            </div>
                            <textarea class="w3-input w3-border" type="text" style="height: 200px;resize: none;" placeholder="Your issue" name="Message"
                                      required pattern="^.{1,500}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 1 - 500 characters !')"></textarea>
                            <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
                        </form>
                </div>
            </div>
            <div class="w3-hide-large">
                <div class="w3-container w3-content">
                    <h2 class="w3-wide w3-center">Contact Form</h2>
                    <p class="w3-container w3-content w3-opacity w3-center w3-margin-bottom"><i>Any issue ? Just fill in the following form :</i></p>
                    <div class="w3-large w3-content w3-third">
                        <i class="fa fa-map-marker" style="width:30px"></i> Epita Paris<br><br class="w3-hide-small">
                        <i class="fa fa-phone" style="width:30px"></i> Phone:<br class="w3-hide-small"> coming soon<br><br class="w3-hide-small">
                        <i class="fa fa-envelope" style="width:30px"> </i> Email:<br class="w3-hide-small"> comming soon<br><br>
                    </div>
                    <form class="w3-twothird" action="" target="_blank">
                        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="text" placeholder="Username" name="Name"
                                       required pattern="^[0-9a-zA-Z]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters and numbers !')">
                            </div>
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="email" placeholder="Email adress" name="Email"
                                       required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')">
                            </div>
                        </div>
                        <textarea class="w3-input w3-border" type="text" style="height: 200px;resize: none;" placeholder="Your issue" name="Message"
                                  required oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter at least one character !)"></textarea>
                        <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
                    </form>
                </div>
            </div>

            <div class="w3-container w3-rest">
                <div id="map" style="width:100%;height:400px">
                </div>
            </div>
        </div>


        <script>
            function myMap() {
                var position = {lat: 48.8155478, lng: 2.3629840999999487};
                var mapOptions = {
                    center: new google.maps.LatLng(position),
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(position),
                    map: map,
                    title: 'Epita'
                });
                marker.setMap(map);
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfDIVWtUr-ceULGSTmDTxGqmkUT-ZFNYE&callback=myMap"></script>

    </main>
    <footer>
        <?php include_once 'Includes/Footer.php'  ?>
    </footer>
</body>

</html>
