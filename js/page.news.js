(function ($) {

	readActualityList();

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

		for (var i = 0, n = data.length; i < n; i++) {
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
		tableBuffer.push('</ul>');

		actualitiesElm.innerHTML = tableBuffer.join('');
	}


})(jQuery);