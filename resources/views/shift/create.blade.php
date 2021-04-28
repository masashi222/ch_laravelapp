@extends('layouts.base')

@section('title','シフト作成')

@section('link')
<link rel="stylesheet" href="{{asset('css/calendar.css')}}">
@endsection

@section('script')
<script>
window.shiftData = @json($shift_data);
window.calendarData = @json($calendar_data);
window.users = @json($users);
</script>
<script src="{{asset('js/calendar.js') . '?' . time()}}"></script>
<script src="{{asset('js/create_calendar.js') . '?' . time()}}"></script>
@endsection

@section('header')
@component('components.header')
	@slot('href')
	{{ $href }}
	@endslot
@endcomponent
@endsection

@section('content')
@component('components.nav')
@slot('nav')
シフト作成
@endslot
@endcomponent

<div class="row d-flex justify-content-center position-relative">
	@component('components.calendar') 
	@endcomponent
	<div class="col-auto position-absolute top-50 end-0 translate-middle-y">
		@if($created == '1')
		<a href="{{ route('not.created') }}" class="btn btn-outline-white rounded-pill shadow text-success btn-sm">
			<i class="fas fa-sync">&nbsp;未完了</i>
		</a>
		@endif
		@if($created == '0')
		<a href="{{ route('created') }}" class="btn btn-outline-white rounded-pill shadow text-success btn-sm">
			<i class="far fa-paper-plane">&ensp;完了</i>
		</a>
		@endif
		@if($created == null)
		<a href="#" class="btn btn-outline-white rounded-pill shadow text-success btn-sm disabled">
			<i class="far fa-paper-plane">&ensp;完了</i>
		</a>
		@endif
	</div>
</div>
<div class="row" id="calendar"></div>

<!-- シフト表示ウィンドウ -->
<form method="post" action="{{ route('shift.store') }}" id="shift-window" class="mt-3">
	@csrf
    <div class="row bg-success text-white d-flex align-items-center">
    	<div class="col" id="date">日付を選択してください</div>
    	<div class="col-auto" style="height: 1.5rem;">
			@if($created == '1')
			<button type="button" class="btn text-white p-0 border-0 align-baseline" id="addBtn" style="display: none;" name="add_btn" value="add"  data-bs-toggle="modal" data-bs-target="#checkModal">追加</button>
			@endif
			@if($created == '0' || $created == null)
			<button type="submit" class="btn text-white p-0 border-0 align-baseline" id="addBtn" style="display: none;" name="add_btn" value="add">追加</button>
			@endif
    	</div>
    	<div class="col-auto" id="storeBtnWrap" style="height: 1.5rem; display: none;">
			@if($created == '1')
			<button type="button" class="btn text-white p-0 border-0 align-baseline" id="storeBtn" name="store_btn" value="store" data-bs-toggle="modal" data-bs-target="#checkModal"><strong>保存</strong></button>
			@endif
			@if($created == '0' || $created == null)
			<button type="submit" class="btn text-white p-0 border-0 align-baseline" id="storeBtn" name="store_btn" value="store"><strong>保存</strong></button>
			@endif
    	</div>
    </div>
    @each('components.shift_create',$shift_data,'shift_data')

    <!-- シフト追加ウィンドウ -->
	<div id='addWindow' style="display: none;">
		<input type="hidden" value="" id="goDate" name="go_date" >
		<div class='row d-flex align-items-center position-relative border-bottom border-secondary'>
			<div class="col-12 clearfix border-bottom py-2">
				<div class="float-start"><i class='fas fa-square text-info fa-fw'></i></div>
				<div class="float-start">
					<select class='form-select border-0 p-0' style='background-image: none;' id="staffSelect" name="staff_select">
						<option value='' style='display: none;' selected disabled>従業員選択</option>
						<!-- valueにuseridを持たせる -->
					</select>
				</div>
			</div>
			<div class="col-12 border-bottom py-2 clearfix">
				<div class="float-start">出勤</div>
				<div class="float-end">
					<select id="go-select" class="form-select border-0 p-0" style="background-image: none; width: 3rem;" name="go_time[add]">
						<option value="17:00:00">17:00</option>
						<option value="17:30:00">17:30</option>
						<option value="18:00:00">18:00</option>
						<option value="18:30:00">18:30</option>
						<option value="19:00:00">19:00</option>
						<option value="19:30:00">19:30</option>
					</select>
				</div>
			</div>
			<div class="col-12 py-2 clearfix">
				<div class="float-start">退勤</div>
				<div class="float-end">
					<select id="leave-select" class="form-select border-0 p-0" style="background-image: none; width: 3rem;" name="leave_time[add]">
						<option value="22:00:00">22:00</option>
						<option value="22:30:00">22:30</option>
						<option value="23:00:00">23:00</option>
						<option value="23:30:00">23:30</option>
						<option value="24:00:00">24:00</option>
						<option value="29:00:00">ラスト</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<!-- ここまで -->

</form>

<!-- Check Modal -->
<div class="modal fade" id="checkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-exclamation-triangle">&ensp;注意喚起</i></h5>
        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      		</div>
      		<div class="modal-body">
        		シフト作成を未完了状態にしますか？
      		</div>
  			<div class="modal-footer">
        		<a href="{{ route('not.created') }}" class="btn btn-secondary">実行</a>
        		<button type="button" class="btn btn-success" data-bs-dismiss="modal">中止</button>
      		</div>
    	</div>
  	</div>
</div>

@endsection
