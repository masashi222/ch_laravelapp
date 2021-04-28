@extends('layouts.base')

@section('title','シフト提出')

@section('link')
<link rel="stylesheet" href="{{asset('css/calendar.css')}}">
@endsection

@section('script')
<script>
window.shiftData = @json($data);
window.calendarData = @json($calendar_data);
</script>
<script src="{{asset('js/calendar.js') . '?' . time()}}"></script>
<script src="{{asset('js/submit_calendar.js') . '?' . time()}}"></script>
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
	シフト提出
	@endslot
@endcomponent

<div class="row d-flex justify-content-center position-relative">
	@component('components.calendar') @endcomponent
	<div class="col-auto position-absolute top-50 end-0 translate-middle-y">
    @isset($submitted)
    	<a  href="{{ route('not.submitted') }}" class="btn btn-outline-white rounded-pill shadow text-success btn-sm" id="submitBtn">
			<i class="fas fa-sync">&ensp;未提出</i>
		</a>
    @endisset
	@empty($submitted)
		<a  href="{{ route('submitted') }}" class="btn btn-outline-white rounded-pill shadow text-success btn-sm" id="submitBtn">
			<i class="far fa-paper-plane">&ensp;提出</i>
		</a>
	@endempty
	</div>
</div>
<div class="row" id="calendar"></div>

<form method="post" action="{{ route('shift.submit.store') }}">
@csrf
	<div class="row bg-success text-white mt-3 d-flex align-items-center">
    	<div class="col" id="date">日付を選択してください</div>
        <!-- 出勤時間 -->
    	<input type="hidden" id="goDate" name="go_date" value="">
    	<!-- 'submittalid' -->
    	<input type="hidden" id="submittalid" name="submittalid" value="">

    	<div class="col-auto" style="height: 1.5rem;">
    		@isset($submitted)
    		<button type="button" class="btn text-white p-0 border-0 align-baseline" id="deleteBtn" data-bs-toggle="modal" data-bs-target="#checkModal" style="display: none;">削除</button>
    		@endisset
    		@empty($submitted)
    		<button type="submit" class="btn text-white p-0 border-0 align-baseline" id="deleteBtn" name="delete_btn" value="delete" style="display: none;">削除</button>
    		@endempty
    	</div>
    	<div class="col-auto" style="height: 1.5rem;">
    		@isset($submitted)
    		<button type="button" class="btn text-white p-0 border-0 align-baseline" id="storeBtn" data-bs-toggle="modal" data-bs-target="#checkModal" style="display: none;">
    			<strong>保存</strong>
    		</button>
    		@endisset
    		@empty($submitted)
    		<button type="submit" class="btn text-white p-0 border-0 align-baseline" id="storeBtn" name="store_btn" value="store" style="display: none;">
    			<strong>保存</strong>
    		</button>
    		@endempty
    	</div>
    </div>
    <div class="row border-bottom border-secondary">
    	<div class="col-12 border-bottom py-2 clearfix">
    		<div class="float-start">出勤</div>
    		<div class="float-end">
    			<select id="go_time"
    				class="form-select border-0 p-0" style="background-image: none; width: 3rem;" name="go_time">
    				<option value='17:00:00'>17:00</option>
    				<option value='17:30:00'>17:30</option>
    				<option value='18:00:00'>18:00</option>
    				<option value='18:30:00'>18:30</option>
    				<option value='19:00:00'>19:00</option>
    				<option value='19:30:00'>19:30</option>
    			</select>
    		</div>
    	</div>
    	<div class="col-12 py-2 clearfix">
    		<div class="float-start">退勤</div>
    		<div class="float-end">
    			<select id="leave_time"
    				class="form-select border-0 p-0" style="background-image: none; width: 3rem;" name="leave_time">
    				<option value='22:00:00'>22:00</option>
    				<option value='22:30:00'>22:30</option>
    				<option value='23:00:00'>23:00</option>
    				<option value='23:30:00'>23:30</option>
    				<option value='24:00:00'>24:00</option>
    				<option value='29:00:00'>ラスト</option>
    			</select>
    		</div>
    	</div>
    </div>
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
        		シフトを未提出状態にしますか？
      		</div>
  			<div class="modal-footer">
        		<a href="{{ route('not.submitted') }}" class="btn btn-secondary">実行</a>
        		<button type="button" class="btn btn-success" data-bs-dismiss="modal">中止</button>
      		</div>
    	</div>
  	</div>
</div>

@endsection