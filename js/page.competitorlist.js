


(function ($) {
	$(document).ready(() => {
		readCompetitorList();

	});

})(jQuery);


async function readCompetitorList() {
	const apiUrl = 'https://script.google.com/macros/s/AKfycbyw40My6pltrf9HvvUwvyE8JsW02DH5KMPsnAVRe1cXzRGrkE80luxex4RO1-LfNjFf/exec';
	console.log(0);
	const response = await fetch(apiUrl);
	const responseData = await response.json();

	const club = responseData[0].data.filter((item) =>
		(item.raceclass === 'Klub')
		&& (item.paymentDate !== ''));
	const combi = responseData[0].data.filter((item) =>
		(item.raceclass === 'Kombi')
		&& (item.paymentDate !== ''));
	const unPaid = responseData[0].data.filter((item) =>
		item.sub === 'sub');

	//	buildCompetitorTable(unPaid, 'registrationTable');
	//	buildCompetitorTable(combi, 'combiTable');
	//	buildCompetitorTable(club, 'clubTable');

	buildCompetitorTable({ data: club, tableId: 'clubTable' })
	buildCompetitorTable({ data: combi, tableId: 'combiTable' })
	buildCompetitorTable({ data: unPaid, tableId: 'registrationTable' })

}

function buildCompetitorTable(config) {
	const tableElm = document.getElementById(config.tableId);
	const data = config.data;

	// function buildCompetitorTable(data, tableId) {
	//	var tableElm = document.getElementById(tableId);

	var tableBuffer = [];
	tableBuffer.push('<table class="table">');

	tableBuffer.push('<tr><th>');
	tableBuffer.push('Jméno a příjmení');
	tableBuffer.push('</th><th>');
	tableBuffer.push('Aeroklub');
	tableBuffer.push('</th><th>');
	tableBuffer.push('Soutěžní třída');
	tableBuffer.push('</th><th>');
	tableBuffer.push('Kluzák');
	tableBuffer.push('</th><th>');
	tableBuffer.push('Imatrikulace');
	tableBuffer.push('</th><th>');
	tableBuffer.push('Startovní znak');
	tableBuffer.push('</th></tr>');

	for (var i = 0, n = data.length; i < n; i++) {
		tableBuffer.push('<tr><td>');
		tableBuffer.push(data[i].name);
		tableBuffer.push(' ');
		tableBuffer.push(data[i].surname);
		tableBuffer.push('</td><td>');
		tableBuffer.push(data[i].aeroclub);
		tableBuffer.push('</td><td>');
		tableBuffer.push(data[i].raceclass);
		tableBuffer.push('</td><td>');
		tableBuffer.push(data[i].glider);
		tableBuffer.push('</td><td>');
		tableBuffer.push(data[i].imatriculation);
		tableBuffer.push('</td><td>');
		tableBuffer.push(data[i].code);
		tableBuffer.push('</td></tr>');
	}
	tableBuffer.push('</table>');

	tableElm.innerHTML = tableBuffer.join('');
}


/*



	

	for (var i = 0; i < data.length; i++) {
		var row = '<tr>
						<td>${data[i].name}</td>
						<td>${data[i].surname}</td>
						<td>${data[i].aeroclub}</td>
						<td>${data[i].raceclass}</td>
						<td>${data[i].glider}</td>
						<td>${data[i].imatriculation}</td>
					</tr>';
		table.innerHTML += row

	}

}




	/*	function buildTable() {
			const apiUrl = 'https://script.google.com/macros/s/AKfycbyw40My6pltrf9HvvUwvyE8JsW02DH5KMPsnAVRe1cXzRGrkE80luxex4RO1-LfNjFf/exec';
			let data = json.parse(apiUrl);
			var table = document.getElementById('myTable')

			for (var i = 0; i < data.length; i++) {
				var row = `
				<tr>
						<td>${data[i].name}</td>
						<td>${data[i].surname}</td>
						<td>${data[i].aeroclub}</td>
						<td>${data[i].raceclass}</td>
						<td>${data[i].glider}</td>
						<td>${data[i].imatriculation}</td>
				</tr>`;
				table.innerHTML = row
			}
		}
		window.onload = function buildTable()



*/