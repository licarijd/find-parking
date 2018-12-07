<?php require 'loggedInCheck.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!--Set the viewport content (necessary to get CSS to display correctly on mobile), and attach the CSS in the header.-->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/all.css">
		<script>
			window.lat = parseFloat(localStorage.getItem("lat"));
			window.lng = parseFloat(localStorage.getItem("lng"));
            window.distance = parseFloat(localStorage.getItem("distance"));

			console.log(window.lat, window.lng, window.distance);
		</script>
		<script>
        function home(){
            location.href = "home.php";
        }

        function logout(){
            location.href = "logout.php";
        }
    </script>
	</head>
	<!--The header contains 4 buttons - home, which will return users to home.html, account to access an account page, and saved/favorites pages for parking spots (I will add/modify these depending on assignment 2 requirements)-->	
	<header class="header">
		
	<input class="home-button" onclick="home()" type="image" src="images/home.png"/>
	<input class="account-button" onclick="logout()" type="image" src="images/logout.png"/>
		<script>
            function home(){
                location.href = "home.php";
            }

            function logout(){
                location.href = "logout.php";
            }
		</script>
	</header>
	<!--The document body specifies elements visible to the user-->
	<body class="background">
		<div class="box-xl">
			<h2 class="h2"> Available Spots </h2>
			<h5 class="h2"> Click the markers on the map to view more details about the parking spot! </h5>
			
			<div id="map" class="map"></div>

			<!--parking spot results are displayed in a table with each row containing the name, distance, and price of a spot
			<table id="results-table" class="table">
				<tr>
					<td>Name</td>
					<td>Distance</td>
					<td>Price</td> 
					<td>Rating</td>
				</tr>
					<td></td>
					<td></td> 
					<td></td>
				<tr>
					</tr>
					<td></td>
					<td></td> 
					<td></td>
				<tr>
						<tr>
							</tr>
							<td></td>
							<td></td> 
							<td></td>
						<tr>
				<tr>
					<td><label><input type="radio" name="optradio">&nbsp 69 Main Street driveway</label></td>
					<td>5km</td>
					<td>$175</td> 
					<td>5/10</td>
				</tr>
				<tr>
					<td><label><input type="radio" name="optradio">&nbsp Scenic trail area 1 corner</label></td>
					<td>7km</td>
					<td>$300</td> 
					<td>8/10</td>
				</tr>
				<tr>
					<td><label><input type="radio" name="optradio">&nbsp Subway back lot spot 3</label></td>
					<td>8km</td>
					<td>$100</td> 
					<td>7/10</td>
				</tr>
			</table>
			<br>
			<button class="input-button-small">GO</button>-->
		</div>
		<?php
		try {

				$pdo = new PDO('mysql:host=localhost;dbname=comp4ww3', 'licarijd', '1313781');
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$result = $pdo->query("SELECT * FROM parkings");

				foreach ($result as $parking) { 

                   $lat = $parking['lat'];
                   $lng = $parking['lng'];

                    ?><ul id=<?=$parking['id']?>>
                    
                    <a href=<?=$parking['id']?>>Reserve parking!</a>

                        <li id="name" value=<?=$parking['name']?>><?=$parking['name']?></li>
                        <li id="description" value=<?=$parking['description']?>><?=$parking['description']?></li>
                        <li id="price" value=<?=$parking['price']?>><?=$parking['price']?></li>
                        <li id="lat" value=<?=$parking['lat']?>><?=$parking['lat']?></li>
                        <li id="lng" value=<?=$parking['lng']?>><?=$parking['lng']?></li>
                    </ul>

				<?php                   

				}

		} catch (PDOException $e) {
				echo $e->getMessage();
		}
		?>
		<script>

			// Initialize and add a Google Map
			function initMap() {

                console.log("distance: " + window.distance)
                

                var infoWindows = []
                var markers = []

                 var latitudes = [];
                 var longitudes = [];
				
				  //Hardcode 3 parking spots near the user's location
				  var currentLocation = {lat: window.lat, lng: window.lng};
                  var results = []
				  /*var result1 = {lat: window.lat+0.1, lng: window.lng+0.1};
				  var result2 = {lat: window.lat+0.2, lng: window.lng+0.2};
				  var result3 = {lat: window.lat+0.3, lng: window.lng+0.1};*/

				  // Center the map at the user's location
				  var map = new google.maps.Map(
					  document.getElementById('map'), {zoom: 10, center: currentLocation});

				  //Draw markers
				  /*var marker1 = new google.maps.Marker({position: result1, map: map});
				  var marker2 = new google.maps.Marker({position: result2, map: map});
				  var marker3 = new google.maps.Marker({position: result3, map: map});*/

                  windowContent = [];

                  var parkingSpots = document.getElementsByTagName('ul');

                  for (var i = 0; i < parkingSpots.length; i++) {

                        console.info(parkingSpots[i].childNodes.length);

                        var attribute = 0;
                        var attributes = []

                        for (var j = 0; j < parkingSpots[i].childNodes.length; j++) {

                            var child = parkingSpots[i].childNodes[j];
                            var childval = child.innerHTML;

                            if (!(childval in window)){
                                
                                console.log(childval, " ", attribute);

                                attributes[attribute] = childval;

                                attribute++;
                            }
                        }

                    //Define the content window of each marker
                    windowContent[i] = '<div id="content">'+
                        '<div id="markerData1">'+
                        '</div>'+
                        '<h1 id="firstHeading" class="firstHeading">' + attributes[1] + '</h1>'+
                        '<div id="bodyContent">'+
                        '<p>' + attributes[2] + '</p>'+
                        '<table id="results-table" class="table">'+
                                '<tr>'+
                                    '<td>Distance</td>'+
                                    '<td>Price</td>'+
                                    '<td>Rating</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td>7km</td>'+
                                    '<td>' + attributes[3] + '</td>'+
                                    '<td>8/10</td>'+
                                '</tr>'+
                        '</table>'+
                        '<a href="parking.php?lat=' + attributes[4] + '&lng=' + attributes[5] + '">'+
                        'More Details</a>' +
                        '</div>'+
                        '</div>';

                        latitudes.push(attributes[4])
                        longitudes.push(attributes[5])
                  }


				  //Define the content window of each marker
				  windowContent[1] = '<div id="content">'+
					'<div id="markerData1">'+
					'</div>'+
					'<h1 id="firstHeading" class="firstHeading">69 Main Street driveway</h1>'+
					'<div id="bodyContent">'+
					'<p>A small spot in the lot beside the condo</p>'+
					'<table id="results-table" class="table">'+
							'<tr>'+
								'<td>Distance</td>'+
								'<td>Price</td>'+
								'<td>Rating</td>'+
							'</tr>'+
							'<tr>'+
								'<td>7km</td>'+
								'<td>$300</td>'+
								'<td>8/10</td>'+
							'</tr>'+
					'</table>'+
					'<a href="parking.php?lat=' + latitudes[0] + '&lng=' + longitudes[0] + '">'+
					'More Details</a>' +
					'</div>'+
					'</div>';

					windowContent[2] = '<div id="content">'+
					'<div id="markerData2">'+
					'</div>'+
					'<h1 id="firstHeading" class="firstHeading">Scenic trail area 1 corner</h1>'+
					'<div id="bodyContent">'+
					'<p>Parking spot in the Area 1 scenic trail lot</p>'+
					'<table id="results-table" class="table">'+
							'<tr>'+
								'<td>Distance</td>'+
								'<td>Price</td>'+
								'<td>Rating</td>'+
							'</tr>'+
							'<tr>'+
								'<td>5km</td>'+
								'<td>$175</td>'+
								'<td>5/10</td>'+
							'</tr>'+
					'</table>'+
					'<a href="parking.php?lat=' + latitudes[0] + '&lng=' + longitudes[0] + '">'+
					'More Details</a>'
					'</div>'+
					'</div>';

					windowContent[3] = '<div id="content">'+
					'<div id="markerData3">'+
					'</div>'+
					'<h1 id="firstHeading" class="firstHeading">Subway back lot spot 3</h1>'+
					'<div id="bodyContent">'+
					'<p>A small spot in the lot beside the subway</p>'+
					'<table id="results-table" class="table">'+
							'<tr>'+
								'<td>Distance</td>'+
								'<td>Price</td>'+
								'<td>Rating</td>'+
							'</tr>'+
							'<tr>'+
								'<td>8km</td>'+
								'<td>$100</td>'+
								'<td>7/10</td>'+
							'</tr>'+
					'</table>'+
					'<a href="parking.php?lat=' + latitudes[0] + '&lng=' + longitudes[0] + '">'+
					'More Details</a>'
					'</div>'+
					'</div>';

                  for (var i = 0; i < latitudes.length; i++) {
                        console.log(latitudes[i])
                        console.log(longitudes[i])
                  }

                  for (var i = 0; i < windowContent.length; i++) {(function  (i) {

                      console.log(windowContent[i])

                    var _lat = parseFloat(latitudes[i]);
                    var _lng = parseFloat(longitudes[i]);

                    //results[i] = {lat: _lat, lng: _lng};
                    results[i] = {lat: window.lat+i, lng: window.lng+i};

                    //markers.push(marker)
                    //console.log(markers[i])

                    var infoWindow = new google.maps.InfoWindow({
                        content: windowContent[i]
                    });

                    

                    var marker = new google.maps.Marker({
                        position: results[i],
                        map: map
                    });

                    //infoWindows.push(infoWindow)

                    //console.log(infoWindows[3], "I val ", i)

                    //var inh = infoWindows[i]
                    //var mar = markers[i]

                    marker.addListener('click', function() {
          				infoWindow.open(map, marker);
        			});

                })(i);
                  }

				  //Set the content of each info window
				  /*var infowindow1 = new google.maps.InfoWindow({
						content: windowContent1
					});

				  var infowindow2 = new google.maps.InfoWindow({
						content: windowContent2
					});

				  var infowindow3 = new google.maps.InfoWindow({
						content: windowContent3
					});*/

				  //Make markers clickable such that clicking on markers displays the appropriate info window
				  /*marker1.addListener('click', function() {
          				infowindow1.open(map, marker1);
        			});

				  marker2.addListener('click', function() {
          				infowindow2.open(map, marker2);
        			});

				  marker3.addListener('click', function() {
          				infowindow3.open(map, marker3);
        			});*/
			}
		</script>
		<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbP4svkwQIWh2S5TujdpOKLPI9plVj2s0&callback=initMap">
		</script>
	</body>
	<!--For now, the fotter will contain a contact link to a support email address-->
	<footer class="footer">
			<p class="footer-text">Contact us: <a href="rentals@findparking.com">
					rentals@findparking.com</a></p>
	</footer>
</html>