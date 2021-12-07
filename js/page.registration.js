var registryForm = document.getElementById("registryForm");
var fname = document.getElementById("fname");
var sName = document.getElementById("sName");
var club = document.getElementById("club");
var email = document.getElementById("email");
var phone = document.getElementById("phone");
var glider = document.getElementById("glider");
var imat = document.getElementById("imat");
var code = document.getElementById("code");
var gliderClass = document.getElementById("gliderClass");
var submitBtn = document.getElementById("submitBtn");


function afterSubmit(e) {
	e.preventDefault();

	var info = {
		name: fname.value,
		surname: sName.value,
		aeroclub: club.value,
		email: email.value,
		phone: phone.value,
		glider: glider.value,
		imatriculation: imat.value,
		code: code.value,
		raceclass: gliderClass.value,
	}
	var url = "https://script.google.com/macros/s/AKfycbz31vAWCc9mx95dfJjsIghRa4KyN9OwJG3dQvPDs130i6qr9wr5pgSNHp4hV0igIe2s/exec";
	fetch(url, {
		method: 'POST',
		cache: 'no-cache',
		redirect: 'follow',
		body: JSON.stringify(info)

	})
	.then(res => res.json())
	.then(res => {
		console.log(res);
		registryForm.reset();
	})
	.catch(err => {
		console.log(err);
		console.log("Něco se pokazilo");
	})
}

registryForm.addEventListener("submit", afterSubmit);
//https://youtu.be/3UYGAAJQXEE?t=1081