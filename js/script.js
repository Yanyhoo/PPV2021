(function ($) {

	addHeader();
	addFooter();


})(jQuery);

function addHeader() {
	$('#header').load('./template.html #header-content');
}

function addFooter() {
	$('#footer').load('./template.html #footer-content');
}
