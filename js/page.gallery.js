document.onkeydown = halt_backspace;
var psw = '', dir = ''; 

$(document).ready(function() {

	$(window).scroll(function() {
		if ($(this).scrollTop() > 100) { 
			$('.btn-top').stop().animate({bottom:'20px'}, 1000); 
		} else { 
			$('.btn-top').stop().animate({bottom:'-100px'}, 1000); 
		}
	});

	$('body')
		.on('click', '.gallery-grid>.click', function(){ 
			dir = $(this).data('folder'); 
			data_update(); 
		})
		.on('click', '.btn-top', function(){ 
			scroll_top(); 
			$('.btn-top').stop().animate({bottom:'-100px'}, 1000); 
		})
		.on('click', '.btn-set', function(){ window.location.href='edit.php'; })
		.on('click', '.btn-send', function(){
			psw = $('.psw').val(); 
			data_update(); 
		})
		.on('click', '.imputs .btn-del', function(){ $(this).parent().remove(); })
		.on('click', '.btn-back, header .click', function(){ data_unload(); });

	$('.btn-back').hide();
	
	dir = $('main').data('dir');
	data_update();
});

function form_submit(form) {
	psw = form.psw.value; 
	data_update();
	return false; 
}

function data_unload() {
	$('.btn-back, .frame-sub').hide(); 
	$('.frame-main').show();
	$('.frame-sub, .gallery-name').html('');
	$('.gallery-top').removeClass('click');
	scrollTop();
}

function data_load(html, name) {
	if (name) { 
		$('.frame-main').hide();
		$('.frame-sub').html(html).show();
		// $('.gallery-container').prepend('<div class="btn-back"><span class="fa fa-angle-left"></span></div>');
		if ($('.images-grid').data('name')) { name = $('.images-grid').data('name'); }
		$('.gallery-container').prepend('<div class="gallery-name"> <span class="btn-back"><span class="fa fa-angle-left"></span></span> Galerie: ' + name + '</div>');
		$('.images-grid a').swipebox();
	} else {  
		$('.btn-back, .gallery-name').remove();
		$('.frame-sub').hide(); 
		$('.frame-main').html(html).show(); 
	}
	scroll_top();
}

function data_update() {
	var fd = new FormData();
	if (dir) { fd.append('dir', dir); }
	if (psw) { fd.append('psw', psw); }
	$.ajax({url:'gallery_engine.php', data:fd, processData:false, contentType:false, type:'POST', success:function(data){ data_load(data, dir); }});
}

function halt_backspace() {
	if (window.event && window.event.keyCode == 8) { data_unload(); return false; }
}

function scroll_top(){ $('html, body').animate({scrollTop: 0}, 'slow'); }