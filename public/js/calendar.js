var week = ["日", "月", "火", "水", "木", "金", "土"];

// 祝日取得
var request;
function requestProcess() {
	request = new XMLHttpRequest();
	request.open('get', '../csv/syukujitsu.csv', true);
	request.send(null);
	request.onload = function() {
		// 初期表示
		showProcess(date);//-引数, calendar
	};
}

// 期間外の日付を選択できないようにする
function clickProcess() {
	var dateTo = new Date(calendarData['year'],calendarData['month'],calendarData['to_date']);
	var dateFrom = new Date(calendarData['year'],calendarData['month'],calendarData['from_date']);

	$('.box,.box1,.box2,.box3,.box4').each(function(){
		var boxYmd = $(this).data('ymd');
		var dateUntouched = new Date(boxYmd['y'],boxYmd['m'] - 1,boxYmd['d']);
		if(dateUntouched < dateFrom || dateUntouched > dateTo){
			$(this).css('pointer-events','none');
			$(this).addClass('bg-light');
		}
	});	
}

// 箱に従業員氏名を登録
function insertProcess() {
	var boxForData = [];
	boxForData[0] = shiftData;
	boxForData[1] = [];
	boxForData[2] = [];
	boxForData[3] = [];
	// box4までに入りきれなかったデータ
	boxForData[4] = [];

	for(var i = 0; i < 4; i++){
		for(var j = 0; j < boxForData[i].length; j++){
			$('.box' + (i+1)).each(function(){
				var boxYmd = $(this).data('ymd');
				var ymdStored = boxYmd['y'] + '-' + ('0' + boxYmd['m']).slice(-2) + '-' + ('0' + boxYmd['d']).slice(-2);
				if(ymdStored == boxForData[i][j]['go_date']){
					if($(this).find('.staff_name').length){
						boxForData[i+1].push(boxForData[i][j]);
					}else{
						$(this).html('<span class=\'d-block border border-white px-1 rounded staff_name\' style=\'background-color:' + boxForData[i][j]['color'] + ';\'>'+ boxForData[i][j]['name'] +'</span>');
					}
					return false;
				}else{
					return true;
				}
			});
		}
	}

	// 箱4に'...'挿入
	for(var k = 0; k < boxForData[4].length; k++){
		$('.box4').each(function(){
			var boxYmd = $(this).data('ymd');
			var ymdStored = boxYmd['y'] + '-' + ('0' + boxYmd['m']).slice(-2) + '-' + ('0' + boxYmd['d']).slice(-2);
			if(ymdStored == boxForData[4][k]['go_date']){
				$(this).html('<span class=\'d-block border border-white bg-info px-1 rounded staff_name\'>...</span>');
				return false;
			}else{
				return true;
			}
		});
	}
}

// カレンダー表示
function showProcess(date) {
	var year = date.getFullYear();
	var month = date.getMonth();
	document.querySelector('#month').innerHTML = (month + 1) + "月";
	document.querySelector('#year').innerHTML = year + "年 ";

	var calendar = createProcess(year, month);
	document.querySelector('#calendar').innerHTML = calendar;
}

// カレンダー作成
function createProcess(year, month) {
	// 曜日
	var calendar = "<table class='table table-borderless table-responsive mb-0'><tr class='dayOfWeek'>";
	for (var i = 0; i < week.length; i++) {
		calendar += "<td class='p-1'>" + week[i] + "</td>";
	}
	calendar += "</tr>";

	var box = 5;
	var count = [];
	for (var i = 0; i < box; i++) {
		count[i] = 0;
	}
	var startDayOfWeek = new Date(year, month, 1).getDay();
	var endDate = new Date(year, month + 1, 0).getDate();
	var lastMonthEndDate = new Date(year, month, 0).getDate();
	var row = Math.ceil((startDayOfWeek + endDate) / week.length);

	// 1行ずつ設定
	for (var i = 0; i < row; i++) {
		calendar += "<tr>";
		// 1colum単位で設定
		for (var j = 0; j < week.length; j++) {
			if (i == 0 && j < startDayOfWeek) {
				// 1行目で1日まで先月の日付を設定
				calendar += "<th class='disabled' style='pointer-events: none;'><span class='d-inline-block px-1'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</span></th>";
			} else if (count[0] >= endDate) {
				// 最終行で最終日以降、翌月の日付を設定
				count[0]++;
				calendar += "<th class='disabled' style='pointer-events: none;'><span class='d-inline-block px-1'>" + (count[0] - endDate) + "</span></th>";
			} else {
				// 当月の日付を曜日に照らし合わせて設定
				count[0]++;
				var dateInfo = checkDate(year, month, count[0]);
				if (dateInfo.isToday && dateInfo.isHoliday) {
					calendar += "<th class='holiday box' title='" + dateInfo.holidayName + "' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[0] + "}'><span class='today d-inline-block text-white bg-success text-center'>" + count[0] + "</span></th>";
				} else if (dateInfo.isToday) {
					calendar += "<th class='box' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[0] + "}'><span class='today d-inline-block text-white bg-success text-center'>" + count[0] + "</span></th>";
				} else if (dateInfo.isHoliday) {
					calendar += "<th class='holiday box' title='" + dateInfo.holidayName + "' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[0] + "}'><span class='d-inline-block text-center'>" + count[0] + "</span></th>";
				} else {
					calendar += "<th class='box' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[0] + "}'><span class='d-inline-block text-center'>" + count[0] + "</span></th>";
				}
			}
		}
		calendar += "</tr>";
		//従業員氏名挿入の箱
		for (var k = 1; k < box; k++) {
			calendar += "<tr>";
			for (var l = 0; l < week.length; l++) {
				if (i == 0 && l < startDayOfWeek) {
					// 1行目で1日まで先月の日付を設定
					calendar += "<td class='disabled' style='pointer-events: none;'></td>";
				} else if (count[k] >= endDate) {
					// 最終行で最終日以降、翌月の日付を設定
					count[k]++;
					calendar += "<td class='disabled' style='pointer-events: none;'></td>";
				} else {
					// 当月の日付を曜日に照らし合わせて設定
					count[k]++;
					var dateInfo = checkDate(year, month, count[k]);
					if (dateInfo.isToday && dateInfo.isHoliday) {
						calendar += "<td class='today holiday box" + k +"' title='" + dateInfo.holidayName + "' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[k] + "}'></td>";
					} else if (dateInfo.isToday) {
						calendar += "<td class='today box" + k +"' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[k] + "}'></td>";
					} else if (dateInfo.isHoliday) {
						calendar += "<td class='holiday box" + k +"' title='" + dateInfo.holidayName + "' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[k] + "}'></td>";
					} else {
						calendar += "<td class='box" + k +"' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[k] + "}'></td>";
					}
				}
			}
			calendar += "</tr>";
		}
	}
	return calendar;
}

// 日付チェック
function checkDate(year, month, day) {

	var checkHoliday = isHoliday(year, month, day);

	if (isToday(year, month, day)) {
		return {
			isToday: true,
			isHoliday: checkHoliday[0],
			holidayName: checkHoliday[1],
		};
	} else {
		return {
			isToday: false,
			isHoliday: checkHoliday[0],
			holidayName: checkHoliday[1],
		};
	}
}

// 当日かどうか
function isToday(year, month, day) {
	return (year == today.getFullYear()
		&& month == (today.getMonth())
		&& day == today.getDate());
}

// 祝日かどうか
function isHoliday(year, month, day) {
	var checkDate = year + '/' + (month + 1) + '/' + day;
	var dateList = request.responseText.split('\n');
	// 1行目はヘッダーのため、初期値1で開始
	for (var i = 1; i < dateList.length; i++) {
		if (dateList[i].split(',')[0] === checkDate) {
			return [true, dateList[i].split(',')[1]];
		}
	}
	return [false, ""];
}