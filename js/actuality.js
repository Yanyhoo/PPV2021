


(function ($) {
	$(document).ready( () => {
		readActualityList();

	});

})(jQuery);


async function readActualityList () {
	const apiUrl = 'https://script.google.com/macros/s/AKfycbxtZXbNHdgQV7nn7izitD__0jkr3UOOn6IDudN6EMY7phgHSZ2hkL-omXOvgh_AI1Ll8w/exec';
	console.log(0);
	const response = await fetch(apiUrl);
	const responseData = await response.json();
	const displayActuality = responseData[0].data.filter( (item) => 
		item.Show === TRUE);
	
	buildActualityTable({ data: displayActuality, tableId: 'actualityTable' })
	
	
}

function buildCompetitorTable(config) {
	const tableElm = document.getElementById(config.tableId);
	const data = config.data;

	var tableBuffer = [];
	tableBuffer.push('<table class="table">');

	for(var i = 0, n = data.length; i < n; i++) {
		tableBuffer.push('<tr><td>');
		tableBuffer.push(data[i].Date);
		tableBuffer.push(' ');
		tableBuffer.push(data[i].Time);
		tableBuffer.push('</td><td>');
		tableBuffer.push(data[i].Header);
		tableBuffer.push('</td><td>');
		tableBuffer.push(data[i].BodyText);
		tableBuffer.push('</td><td>');
		tableBuffer.push(data[i].LinkText);
		tableBuffer.push(data[i].LinkURL);
		tableBuffer.push('</td></tr>');
	}
	tableBuffer.push('</table>');

	tableElm.innerHTML = tableBuffer.join('');
}
