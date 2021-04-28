/**
 * calendar.jsを受け継ぐ
 */

var today = new Date();
// 表示するカレンダーの日付を取得
var date = new Date(calendarData['year'],calendarData['month'],1);
// 月末だとずれる可能性があるため、1日固定で取得
var showDate = new Date(today.getFullYear(), today.getMonth(), 1);

window.addEventListener('load', function() {
	new Promise(
		function requestProcess(resolve) {
			request = new XMLHttpRequest();
			request.open('get', '../csv/syukujitsu.csv', true);
			request.send(null);
			request.onload = function() {
				// 初期表示
				showProcess(date);//-引数, calendar
			};
			setTimeout(() => {
				resolve();
			}, 100);
		}
	).then(
		function clickProcess() {
			console.log('in');
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
	).then(
		function insertProcess() {
			// 従業員の氏名の箱1に登録
			for(var i = 0; i < shiftData.length; i++){
				$('.box1').each(function(){
					var box1Ymd = $(this).data('ymd');
					box1Ymd['m'] = ('0' + box1Ymd['m']).slice(-2);
					box1Ymd['d'] = ('0' + box1Ymd['d']).slice(-2);
					var ymdStored = `${box1Ymd['y']}-${box1Ymd['m']}-${box1Ymd['d']}`;
					if(ymdStored == shiftData[i]['go_date']){
						$(this).html('<span class=\'d-block border border-white bg-info px-1 rounded\'>登録</span>');
						return false;
					}else{
						return true;
					}
				});
			}
		}
	)
});

window.clickProcess;

window.showProcess;

window.createProcess;

window.checkDate;

window.isToday;

window.isHoliday;

// カレンダーの日付を押下をした時
$(document).on('click', '#calendar th,#calendar td', function() {
	// シフト提出ウィンドウの日付の変更
	var clickYmd = $(this).data('ymd');
	var ymdObj = new Date(clickYmd['y'], (clickYmd['m'] - 1), clickYmd['d']);
	$('#date').html(`${clickYmd['y']}年${clickYmd['m']}月${clickYmd['d']}日（${week[ymdObj.getDay()]}）`);

	// <input type="hidden"...にデータを登録
	clickYmd['m'] = ('0' + clickYmd['m']).slice(-2);
	clickYmd['d'] = ('0' + clickYmd['d']).slice(-2);
	var goDate = `${clickYmd['y']}-${clickYmd['m']}-${clickYmd['d']}`;
	$('#goDate').val(goDate);

	for(var i = 0; i < shiftData.length; i++) {
		if(shiftData[i]['go_date'] == goDate){
			// <input type="hidden"...にデータを登録
			$('#submittalid').val(shiftData[i]['submittalid']);
			// SELECTボックスの設定
			var goTime = shiftData[i]['go_time'];
			$(`#go_time option[value=\"${goTime}\"]`).prop('selected',true);
			var leaveTime = shiftData[i]['leave_time'];
			$(`#leave_time option[value=\"${leaveTime}\"]`).prop('selected',true);
			// 削除ボタンの設定
			$('#deleteBtn').show();
			break;
		}else{
			// 削除ボタンの設定
			$('#deleteBtn').hide();
			// <input type="hidden"...にデータを登録
			$('#submittalid').val('');
			// SELECTボックスの設定
			$(`#go_time option[value=\"17:00:00\"]`).prop('selected',true);
			$(`#leave_time option[value=\"22:00:00\"]`).prop('selected',true);
			continue;
		}
	}
	// 保存ボタンの設定
	$('#storeBtn').show();
});