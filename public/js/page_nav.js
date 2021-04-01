$(document).on('click','.page-nav',function(){
	location.href = jQuery(this).attr('data-url');
});