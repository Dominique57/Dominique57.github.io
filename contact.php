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
                    <p class="w3-opacity w3-center"><i>Any issue ? Just fill in the following form :</i></p>
                    <div class="w3-row w3-padding-32">
                        <div class="w3-col m6 w3-large w3-margin-bottom">
                            <i class="fa fa-map-marker" style="width:30px"></i> Epita Paris - Fr<br>
                            <i class="fa fa-phone" style="width:30px"></i> Phone: coming soon<br>
                            <i class="fa fa-envelope" style="width:30px"> </i> Email: comming soon<br>
                        </div>
                        <div class="w3-col m6">
                            <form action="" target="_blank">
                                <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                                    <div class="w3-half">
                                        <input class="w3-input w3-border" type="text" placeholder="Username" required name="Name">
                                    </div>
                                    <div class="w3-half">
                                        <input class="w3-input w3-border" type="mail" placeholder="Email adress" required name="Email">
                                    </div>
                                </div>
                                <input class="w3-input w3-border" type="text" placeholder="Your issue" required name="Message">
                                <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w3-container w3-hide-large">
                <h2 class="w3-wide w3-center">Contact Form</h2>
                <p class="w3-opacity w3-center"><i>Any issue ? Just fill in the following form :</i></p>
                <div class="w3-row w3-padding-32">
                    <div class="w3-col m6 w3-large w3-margin-bottom">
                        <i class="fa fa-map-marker" style="width:30px"></i> Epita Paris - Fr<br>
                        <i class="fa fa-phone" style="width:30px"></i> Phone: coming soon<br>
                        <i class="fa fa-envelope" style="width:30px"> </i> Email: comming soon<br>
                    </div>
                    <div class="w3-col m6">
                        <form action="" target="_blank">
                            <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                                <div class="w3-half">
                                    <input class="w3-input w3-border" type="text" placeholder="Username" required name="Name">
                                </div>
                                <div class="w3-half">
                                    <input class="w3-input w3-border" type="mail" placeholder="Email adress" required name="Email">
                                </div>
                            </div>
                            <input class="w3-input w3-border" type="text" placeholder="Your issue" required name="Message">
                            <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
                        </form>
                    </div>
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
