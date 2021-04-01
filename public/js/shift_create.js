$(document).on('click','th,td',function(){
	$('.staff-add-window').hide();
	$('.shift-select-window').show();
});

function addWindowOpen(){
	$('.shift-select-window').hide();
	$('.staff-add-window').show();
}

function addWindowClose() {
	$('.staff-add-window').hide();
	$('.shift-select-window').show();
}

