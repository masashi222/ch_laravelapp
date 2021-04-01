var week = ["日", "月", "火", "水", "木", "金", "土"];

// 祝日取得
var request;
window.onload = function() {
	request = new XMLHttpRequest();
	request.open('get', '../csv/syukujitsu.csv', true);
	request.send(null);
	request.onload = function() {
		// 初期表示
		showProcess(today, calendar);
		defaultColor('16');
	};
};

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
				calendar += "<th class='disabled' style='pointer-events: none;'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</th>";
			} else if (count[0] >= endDate) {
				// 最終行で最終日以降、翌月の日付を設定
				count[0]++;
				calendar += "<th class='disabled' style='pointer-events: none;'>" + (count[0] - endDate) + "</th>";
			} else {
				// 当月の日付を曜日に照らし合わせて設定
				count[0]++;
				var dateInfo = checkDate(year, month, count[0]);
				if (dateInfo.isToday && dateInfo.isHoliday) {
					calendar += "<th class='today holiday' title='" + dateInfo.holidayName + "' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[0] + "}'>" + count[0] + "</th>";
				} else if (dateInfo.isToday) {
					calendar += "<th class='today' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[0] + "}'>" + count[0] + "</th>";
				} else if (dateInfo.isHoliday) {
					calendar += "<th class='holiday' title='" + dateInfo.holidayName + "' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[0] + "}'>" + count[0] + "</th>";
				} else {
					calendar += "<th data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[0] + "}'>" + count[0] + "</th>";
				}
			}
		}
		calendar += "</tr>";
		// 従業員氏名挿入の箱の作成
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
						calendar += "<td class='today holiday' title='" + dateInfo.holidayName + "' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[k] + "}'></td>";
					} else if (dateInfo.isToday) {
						calendar += "<td class='today' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[k] + "}'></td>";
					} else if (dateInfo.isHoliday) {
						calendar += "<td class='holiday' title='" + dateInfo.holidayName + "' data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[k] + "}'></td>";
					} else {
						calendar += "<td data-ymd='{\"y\":" + year + ",\"m\":" + (month + 1) + ",\"d\":" + count[k] + "}'></td>";
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


// カレンダークリックした時
$(document).on('click', 'th,td', function() {
	// シフト選択ウィンドウの日付の変更
	var clickYmd = $(this).data('ymd');
	var ymdObj = new Date(clickYmd['y'], (clickYmd['m'] - 1), clickYmd['d']);
	$('.shift-select-window_date').html(`${clickYmd['y']}年${clickYmd['m']}月${clickYmd['d']}日（${week[ymdObj.getDay()]}）`);

	//日付の色の初期化
	initColor();

	// クリックした日付の色付け
	var allElement = $('th,td').filter(function() {
		return $(this).data('ymd');
	});

	allElement.filter(function() {
		var allYmd = $(this).data('ymd');
		return allYmd['d'] == clickYmd['d'];
	}).each(function(index, element) {
		if (index == '0') {
			$(element).css({ 'border': '2px solid #198754', 'border-bottom': 'none'  });
		} else if (index == "4") {
			$(element).css({
				'border': '2px solid #198754', 'border-top': 'none' });
		} else {
				$(element).css({ 'border-right': '2px solid #198754',  'border-left':  '2px solid #198754' });
		}
	});
});

// 日付の色の初期化
function initColor() {
	$('tr').each(function(index, element) {
		if (index == '0') {
			$(element).find('td').css({ 'border': '1px solid #ccc', 'border-bottom': 'none' });
		} else if ((index - 1) % 5 == '0') {
			$(element).find('th').css({ 'border': '1px solid #ccc', 'border-bottom': 'none' });
		} else if (index % 5 == '0') {
			$(element).find('td').css({ 'border': '1px solid #ccc', 'border-top': 'none' });
		} else {
			$(element).find('td').css({ 'border-right': '1px solid #ccc', 'border-left': '1px solid #ccc' });
		}
	});
}

// 日付の色のデフォルト
function defaultColor(arg) {
	var allElement = $('th,td').filter(function() {
		return $(this).data('ymd');
	});

	allElement.filter(function() {
		var allYmd = $(this).data('ymd');
		return allYmd['d'] == arg;
	}).each(function(index, element) {
		if (index == '0') {
			$(element).css({ 'border': '2px solid #198754', 'border-bottom': 'none'  });
		} else if (index == "4") {
			$(element).css({
				'border': '2px solid #198754', 'border-top': 'none' });
		} else {
				$(element).css({ 'border-right': '2px solid #198754',  'border-left':  '2px solid #198754' });
		}
	});
}