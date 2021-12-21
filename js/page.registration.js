var registryForm = document.getElementById("registryForm");
var check = document.getElementById("checkForm");
var fname = document.getElementById("fname");
var sName = document.getElementById("sName");
var club = document.getElementById("club");
var email = document.getElementById("email");
var phone = document.getElementById("phone");
var glider = document.getElementById("glider");
var imat = document.getElementById("imat");
var code = document.getElementById("code");
var gliderClassCombi = document.getElementById("gliderClassCombi");
var gliderClassClub = document.getElementById("gliderClassClub");
var submitBtn = document.getElementById("submitBtn");


function afterSubmit(e) {
	e.preventDefault();

	if (check.value === '') { // honeypot empty

		var info = {
			name: fname.value,
			surname: sName.value,
			aeroclub: club.value,
			email: email.value,
			phone: phone.value,
			glider: glider.value,
			imatriculation: imat.value,
			code: code.value,
			raceclass: ""
		}
		if (gliderClassCombi.checked) {
			info.raceclass = "Kombi"
		} else if (gliderClassClub.checked) {
			info.raceclass = "Klub"
		}

		if (info.surname === '') {
			showError('Prosím vyplňte co nejvíce informací, přinejmenším musí být uvedeno Vaše příjmení a e-mail');
		} else if ( (info.email === '') && (info.phone === '') ) {
			showError('Prosím vyplňte co nejvíce informací, přinejmenším musí být uvedeno Vaše příjmení a e-mail');
		} else {

			var url = "https://script.google.com/macros/s/AKfycbyw40My6pltrf9HvvUwvyE8JsW02DH5KMPsnAVRe1cXzRGrkE80luxex4RO1-LfNjFf/exec";

			fetch(url, {
				method: 'POST', // *GET, POST, PUT, DELETE, etc.
				mode: 'no-cors', // no-cors, *cors, same-origin
				cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
				credentials: 'omit', // include, *same-origin, omit
				headers: {
				  'Content-Type': 'application/json'
				},
				redirect: 'follow', // manual, *follow, error
				body: JSON.stringify(info)
				// body: JSON.stringify({"name":"Test","surname":"Test","aeroclub":"Aeroklub Praha Letňany","raceclass":"Klub","glider":"ASW15b","imatriculation":"OK-1985","code":"XY","email":"UrnerM@seznam.cz","phone":""})
			}).then(res => {
				console.log(res);
				res.text()
			}).then(res => {
				// resolve(res ? JSON.parse(res) : {})
				console.log(res);
				registryForm.reset();
			}).catch(err => {
				console.log(err);
				console.log("Něco se pokazilo: " + JSON.stringify(info));
			});
		}
	}
}

registryForm.addEventListener("submit", afterSubmit);
//https://youtu.be/3UYGAAJQXEE?t=1081


function showError(text) {
	alert(text);
}