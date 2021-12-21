var myArray = function () {
	const apiUrl = "https://script.google.com/macros/s/AKfycbyw40My6pltrf9HvvUwvyE8JsW02DH5KMPsnAVRe1cXzRGrkE80luxex4RO1-LfNjFf/exec";
	const response = await fetch(apiUrl);
	const data = await response.json();
};

function buildTable(data) {


	var table = document.getElementById("myTable")

	for (var i = 0; i < data.length; i++) {
		var row = `<tr>
						<td>${data[i].name}</td>
						<td>${data[i].surname}</td>
						<td>${data[i].aeroclub}</td>
						<td>${data[i].raceclass}</td>
						<td>${data[i].glider}</td>
						<td>${data[i].imatriculation}</td>
					</tr>`;
		table.innerHTML += row

	}

}
