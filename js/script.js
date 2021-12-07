(function ($) {

	addHeader();
	addFooter();


})(jQuery);

function addHeader() {
	$('#header').load('./template.html #header');
}

function addFooter() {
	$('#footer').load('./template.html #footer');
}
