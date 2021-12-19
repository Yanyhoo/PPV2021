function getCompetitorList() {
	const url ="https://script.google.com/macros/s/AKfycbyw40My6pltrf9HvvUwvyE8JsW02DH5KMPsnAVRe1cXzRGrkE80luxex4RO1-LfNjFf/exec";

	fetch(url)
		.then(d => d.json())
		.then(d =>{
			documment.getElementById("app").textContent = d;
		}),

}

documment.getElementById("btn").addEventListener("click",getCompetitorList);




//data.filter((x)=>x.code === "JJ");


/* // Function to define innerHTML for HTML table
function show(data) {
	let tab =
		`<tr>
		<th>ID#</th>
		<th>Name</th>
		<th>Surname</th>
		<th>aeroclub</th>
		<th>raceclass</th>
		<th>glider</th>
		<th>imatriculation</th>
		<th>code</th>
		<th>email</th>
		<th>phone</th>
		<th>paymentDate</th>		
		</tr>`;
	// Loop to access all rows 
	for (let r of data.keys) {
		let { key, item } = r;
		tab += `<tr> 
			<td>${key.Id} </td>
			<td>${key.name}</td>
			<td>${key.surname}</td> 
			<td>${key.aeroclub}</td> 
			<td>${key.raceclass}</td> 
			<td>${key.glider}</td> 
			<td>${key.imatriculation}</td> 
			<td>${key.code}</td> 
			<td>${key.email}</td> 
			<td>${key.phone}</td> 
			<td>${key.paymentDate}</td> 
		</tr>
		<tr>
			<td>Id</td>
			<td>name</td>
			<td>surname</td>
			<td>aeroclub</td>
			<td>raceclass</td>
			<td>glider</td>
			<td>imatriculation</td>
			<td>code</td>
			<td>email</td>
			<td>phone</td>
			<td>paymentDate</td>
		</tr>
		`;
		tab += item.map(({ Id, name, surname, aeroclub, raceclass, glider, imatriculation, code, email, phone, paymentDate }) => `<tr>
				<td>${Id}</td>
				<td>${name}</td>
				<td>${surname}</td>
				<td>${aeroclub}</td>
				<td>${raceclass}</td>
				<td>${glider}</td>
				<td>${imatriculation}</td>
				<td>${code}</td>
				<td>${email}</td>
				<td>${phone}</td>
				<td>${paymentDate}</td>
			</tr>`).join();
		tab += `<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>`;
	}

	// Setting innerHTML as tab variable
	document.getElementBykey("racing").innerHTML = tab;
} */