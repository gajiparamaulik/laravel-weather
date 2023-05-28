<html>
<head>
	<title>Current User Location</title>
</head>
<body style="text-align: center;">
	<h1>Current User Location</h1>
	<div style="border:1px solid black; margin-left: 300px; margin-right: 300px;">
	<h3>IP: {{ $curLocation->ip }}</h3>
	<h3>Country Name: {{ $curLocation->cityName }}</h3>
	<h3>Country Code: {{ $curLocation->countryCode }}</h3>
	<h3>Region Code: {{ $curLocation->regionCode }}</h3>
	<h3>Region Name: {{ $curLocation->regionName }}</h3>
	<h3>City Name: {{ $curLocation->cityName }}</h3>
	<h3>Zipcode: {{ $curLocation->zipCode }}</h3>
	<h3>Latitude: {{ $curLocation->latitude }}</h3>
	<h3>Longitude: {{ $curLocation->longitude }}</h3>
	</div>
</body>
</html>