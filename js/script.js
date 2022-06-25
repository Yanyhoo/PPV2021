(function ($) {

	addHeader();
	addMenu();
	addFooter();


})(jQuery);

function addHeader() {
	$('#header').load('./template.html #header-content');
}

function addMenu() {
	$('#navbarNav').load('./template.html #menu-content>ul');
}


function addFooter() {
	$('#footer').load('./template.html #footer-content');
}
