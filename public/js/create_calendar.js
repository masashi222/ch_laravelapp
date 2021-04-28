/**
 * calendar.jsを受け継ぐ
 */

 var today = new Date();
 // 表示するカレンダーの日付を取得
 var date = new Date(calendarData['year'],calendarData['month'],calendarData['from_date']);
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
	).then(
        function (){
            // シフト作成ウィンドウのセレクトボックスのoptionタグの書き換え
            for(var l = 0; l < shiftData.length; l++){
                $('#goTime' + shiftData[l]['submittalid'] + ' ' + 'option[value=\'' + shiftData[l]['go_time'] + '\']').text('希望：' + shiftData[l]['split_go_time']);
                $('#goTime' + shiftData[l]['submittalid'] + ' ' + 'option[value=\'' + shiftData[l]['go_time'] + '\']').prop('selected',true);
                $('#leaveTime' + shiftData[l]['submittalid'] + ' ' + 'option[value=\'' + shiftData[l]['leave_time'] + '\']').text('希望：' + shiftData[l]['split_leave_time']);
                $('#leaveTime' + shiftData[l]['submittalid'] + ' ' + 'option[value=\'' + shiftData[l]['leave_time'] + '\']').prop('selected',true);
                // シフト作成データで上書き
                $('#goTime' + shiftData[l]['submittal_submittalid'] + ' ' + 'option[value=\'' + shiftData[l]['creation.go_time'] + '\']').prop('selected',true);
                $('#leaveTime' + shiftData[l]['submittal_submittalid'] + ' ' + 'option[value=\'' + shiftData[l]['creation.leave_time'] + '\']').prop('selected',true);
                $('#registationStatus' + shiftData[l]['submittal_submittalid']).prop('checked',true);
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
 
     // data-dateとdataDateの一致する提出状況確認ウィンドウの表示
     clickYmd['m'] = ('0' + clickYmd['m']).slice(-2);
     clickYmd['d'] = ('0' + clickYmd['d']).slice(-2);
     var dataDate = `${clickYmd['y']}-${clickYmd['m']}-${clickYmd['d']}`;
     $('.create-window').hide();
     $('.create-window fieldset').prop('disabled',true);
     $('.create-window').filter(function () {
        return $(this).data('date') == dataDate;
    }).children('fieldset').prop('disabled',false);
     $('.create-window').filter(function () {
         return $(this).data('date') == dataDate;
     }).show();

     // シフト追加ウィンドウの設定
     $('#goDate').val(dataDate);
        // staff_nameのセレクトボックスの選択肢の設置
        var unsubmittedUsers = [];
        for(var i = 0; i < users.length; i++){
            unsubmittedUsers.push(users[i]['userid'])
        }
        for(var j = 0; j < shiftData.length; j++){
            if(shiftData[j]['go_date'] == dataDate){
                unsubmittedUsers.push(shiftData[j]['userid']);
            }
        }
        var unsubmittedUsers = unsubmittedUsers.filter(function(value,index,array){
            return array.indexOf(value) === array.lastIndexOf(value);
        });
        $('#staffSelect option').slice(1).remove();
        for(var k = 0; k < users.length; k++){
            if(unsubmittedUsers.indexOf(users[k]['userid']) >= 0){
                var option = "<option value='" + users[k]['userid'] + "'>" + users[k]['name'] + "</option>";
                $('#staffSelect').append(option);
            }else{
                continue;
            }
        }
     $('#addWindow').show();

     // 追加ボタンの設定
     $('#addBtn').show();

     // 保存ボタンの設定
     for(var i = 0; i < shiftData.length; i++) {
		if(shiftData[i]['go_date'] == dataDate){
			$('#storeBtnWrap').show()
			break;
		}else{
            $('#storeBtnWrap').hide()
			continue;
		}
	}
 });