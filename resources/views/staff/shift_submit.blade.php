@extends('layouts.base') @section('title','Staff/ShiftSubmit')

@section('link')
<link rel="stylesheet" href="{{asset('css/shift.css')}}">
<link rel="stylesheet" href="{{asset('css/shift_create.css')}}">
@endsection @section('script')
<script src="{{asset('js/shift_submit.js')}}"></script>
<script src="{{asset('js/calendar.js')}}"></script>
<script src="{{asset('js/shift_create.js')}}"></script>
@endsection @section('header_left_content')
@component('components.header_left_content')
@slot('data_url')
{{ $data_url }}
@endslot
@endcomponent @endsection

@section('content') @component('components.menu_main')
@slot('menu_main') シフト提出画面 @endslot @endcomponent
<div class="row my-3 d-flex justify-content-center position-relative">
	@component('components.calendar_year_month') @endcomponent
	<div class="col-auto position-absolute top-50 end-0 translate-middle-y">
		<button type="button"
			class="btn btn-outline-white rounded-pill shadow text-success">
			<i class="far fa-paper-plane">&ensp;提出</i>
		</button>
	</div>
</div>
<div class="row" id="calendar"></div>
<div class="shift-select-window pb-3">
	<div
		class="row mb-3 bg-success text-white shift-select-window_date_wrap">
		<div class="col shift-select-window_date">2021年3月16日（火）</div>
	</div>
	<div
		class="row gx-0 text-center py-2 border-top border-bottom bg-light">
		<div class="col-8">希望時間</div>
		<div class="col-4">登録</div>
	</div>
	<form method="post" action="#"
		class="row gx-0 py-2 d-flex align-items-center text-center border-bottom">
		<div class="col-4 pe-2">
			<select class="form-select form-select-sm">
				<option>16:00</option>
				<option>16:30</option>
				<option>17:00</option>
				<option>17:30</option>
				<option>18:00</option>
				<option>18:30</option>
				<option>19:00</option>
				<option>19:30</option>
				<option>20:00</option>
			</select>
		</div>
		<div class="col-4 ps-3">
			<select class="form-select form-select-sm">
				<option>22:00</option>
				<option>22:30</option>
				<option>23:00</option>
				<option>23:30</option>
				<option>24:00</option>
				<option>ラスト️</option>
			</select>
		</div>
		<div class="col-4">
			<button type="submit" class="btn bg-light btn-outline-success">登録</button>
		</div>
	</form>
</div>
@endsection
