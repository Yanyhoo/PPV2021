var interval = window.setInterval('meteoUpdate()',60000); 
meteoUpdate();

function meteoUpdate() {
	$.get('http://www.aeroklub.cz/wpscripts/weather.php', function(data) {
		console.log(data);
		var weather = data.split(';'),
			vCur = numeric(weather[2]), 
			vMin = Math.round(numeric(weather[4])).toString(), 
			vMax = Math.round(numeric(weather[5]) * 10) / 10, 
			vSmer = numeric(weather[3]),
			tlak = Math.round(numeric(weather[16])).toString();
			rQNH = Math.round(numeric(weather[17])).toString();

		$('.data-date').html(weather[0]);
		$('.data-wind-cur').html(vSmer + '/' + vMin);
		$('.data-wind-max').html(vMax);
		$('.data-QNH').html(tlak);
		$('.data-rQNH').html(rQNH);
		$('.data-temp').html(numeric(weather[11]));
		$('.data-SRS').html(weather[18] + ' - ' + weather[19]);

		// $('.data-wind-peak').html(vMin);
		// $('.data-wind-smer').html(vSmer);
		// $('.data-time').html(weather[1]);
		// $('.data-SR').html(weather[18]);
		// $('.data-SS').html(weather[19]);
		});

	//$('#kamera-1').attr('src','http://www.aeroklub.cz/wpscripts/camera_1.php?' + Math.random());
	//$('#kamera-2').attr('src','wpscripts/camera_2.php?' + Math.random());
	//$('#kamera-3').attr('src','http://www.aeroklub.cz/wpscripts/camera_3.php?' + Math.random());
	}
	
function numeric(data_string) {
	return data_string.replace(/[a-z]+/ig, ''); 
}

console.log('script.js running');