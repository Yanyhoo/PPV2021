(function ($) {


	var interval = window.setInterval('meteoUpdate()', 60000); 
	meteoUpdate();
	readActualityList();




	function meteoUpdate() {
		$.get('./weather.php', function(data) {
			var weather = data.split(';'),
				vCur = numeric(weather[2]), 
				vMin = Math.round(numeric(weather[4])).toString(), 
				vMax = Math.round(numeric(weather[5]) * 10) / 10, 
				vSmer = numeric(weather[3]),
				tlak = Math.round(numeric(weather[16])).toString();
				rQNH = Math.round(numeric(weather[17])).toString();

			$('.data-date').html(weather[0] + ' ' + weather[1]);
			$('.data-wind-cur').html(vSmer + '/' + vMin);
			$('.data-wind-max').html(vMax);
			$('.data-QNH').html(tlak);
			$('.data-rQNH').html(rQNH);
			$('.data-temp').html(numeric(weather[11]));
			$('.data-SRS').html(weather[18] + ' - ' + weather[19]);

		});

		//$('#kamera-1').attr('src','http://www.aeroklub.cz/wpscripts/camera_1.php?' + Math.random());
		//$('#kamera-2').attr('src','wpscripts/camera_2.php?' + Math.random());
		//$('#kamera-3').attr('src','http://www.aeroklub.cz/wpscripts/camera_3.php?' + Math.random());
	}
	
	/**
	 * Extract number from string
	 */
	function numeric(data_string) {
		return data_string.replace(/[a-z]+/ig, ''); 
	}


	async function readActualityList() {
		const apiUrl = 'https://script.google.com/macros/s/AKfycbxtZXbNHdgQV7nn7izitD__0jkr3UOOn6IDudN6EMY7phgHSZ2hkL-omXOvgh_AI1Ll8w/exec';
		console.log(0);
		const response = await fetch(apiUrl);
		const responseData = await response.json();
		const displayActuality = responseData[0].data;

		buildActualityList({ data: displayActuality, actualitiesId: 'actualities' })


	}

	function buildActualityList(config) {
		const actualitiesElm = document.getElementById(config.actualitiesId);
		const data = config.data;

		var tableBuffer = [];
		tableBuffer.push('<ul class="ppv-list">');

		for (var i = 0; i < 7; i++) {
			if (data[i]) {
				tableBuffer.push('<li class="ppv-list-item"><h5 class="ppv-list-item__title"><span class="ppv-list-item__time">');
				tableBuffer.push(data[i].Date);
				tableBuffer.push(' ');
				tableBuffer.push(data[i].Time);
				tableBuffer.push('</span> &nbsp; ');
				tableBuffer.push(data[i].Header);
				tableBuffer.push('</h5><p>');
				tableBuffer.push(data[i].BodyText);
				tableBuffer.push('</p><p><a href="');
				tableBuffer.push(data[i].LinkURL);
				tableBuffer.push('">');
				tableBuffer.push(data[i].LinkText);		
				tableBuffer.push('</a></p></li>');
			}
		}
		tableBuffer.push('</ul>');

		actualitiesElm.innerHTML = tableBuffer.join('');
	}


})(jQuery);