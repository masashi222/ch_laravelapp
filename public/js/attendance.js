if(confirmed == '1' || confirmed == null){
    // 給与確定ステータスが1または,打刻中のデータがある場合
    $('#confirmBtn').addClass('disabled');
}

window.addEventListener('load',function(){
    if(confirmed == '1'){
        $('.change-btn').addClass('disabled');
        $('.delete-btn').addClass('disabled');
    }
});