function stampTime() {
	var week = ['日', '月', '火', '水', '木', '金', '土'];
	var today = new Date();
	var month = (today.getMonth() + 1) + '月';
	var date = today.getDate() + '日';
	var day = '（' + week[today.getDay()] + '）';
	var year = today.getFullYear() + '年';
	var hourMinutes = today.getHours() + '時' + today.getMinutes() + '分';

	$('#month').text(month);
	$('#date').text(date);
	$('#day').text(day);
	$('#year').text(year);
	$('#time').text(hourMinutes);
}

stampTime();
setInterval(stampTime,30000);