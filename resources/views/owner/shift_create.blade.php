@extends('layouts.base') @section('title','Owner/ShiftCreate')

@section('link')
<link rel="stylesheet" href="{{asset('css/shift.css')}}">
<link rel="stylesheet" href="{{asset('css/shift_create.css')}}">
@endsection @section('script')
<script src="{{asset('js/shift_submit_check.js')}}"></script>
<script src="{{asset('js/calendar.js')}}"></script>
<script src="{{asset('js/shift_create.js')}}"></script>
@endsection @section('header_left_content')
@component('components.header_left_content')
@slot('data_url')
{{ $data_url }}
@endslot
@endcomponent @endsection

@section('content') @component('components.menu_main')
@slot('menu_main') シフト作成画面 @endslot @endcomponent
<div class="row my-3 d-flex justify-content-center position-relative">
	@component('components.calendar_year_month') @endcomponent
	<div class="col-auto position-absolute top-50 end-0 translate-middle-y">
		<button type="button"
			class="btn btn-outline-white rounded-pill shadow text-success">
			<i class="far fa-paper-plane">&ensp;送信</i>
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
		<div class="col-md-2 col-3">氏名</div>
		<div class="col-md-4 col-3">希望時間</div>
		<div class="col-md-4 col-3">確定時間</div>
		<div class="col-md-2 col-3">登録</div>
	</div>
	@each('components.shift_select_record',$shift_select_record,'shift_select_record')
	<div class="row mt-3">
		<div class="col-12 d-flex justify-content-end">
			<div class="col-auto">
				<button type="button" class="btn  bg-light btn-outline-success"
					onclick="addWindowOpen()">
					<i class="fas fa-user-plus"></i>
				</button>
			</div>
			<div class="col-auto ms-3">
				<button type="button" class="btn  bg-light btn-outline-success">登録</button>
			</div>
		</div>
	</div>
</div>
<div class="staff-add-window pb-3">
	<div
		class="row bg-success text-white shift-select-window_date_wrap clearfix">
		<div class="col shift-select-window_date">2021年3月16日（火）</div>
		<div class="col-auto float-end" style="cursor: pointer;"
			onclick="addWindowClose()">
			<i class="fas fa-times"></i>
		</div>
	</div>
	<div class="row my-3">
		<div class="col">
			<strong>シフトに追加する従業員を選択してください。</strong>
		</div>
	</div>
	<div
		class="row gx-0 text-center py-2 border-top border-bottom bg-light">
		<div class="col-4">氏名</div>
		<div class="col-4">希望時間</div>
		<div class="col-4"></div>
	</div>
	<form method="post" action="{{ route('owner.shift_create_add') }}"
		class="row gx-0 py-2 d-flex align-items-center text-center border-bottom">
		@csrf
		<div class="col-4 pe-2">
			<select class="form-select"></select>
		</div>
		<div class="col-4 ps-3">
			<div class="row">
				<div class="col-md-6 col-12 pb-md-0 pb-2">
					<select class="form-select"></select>
				</div>
				<div class="col-md-6 col-12">
					<select class="form-select"></select>
				</div>
			</div>
		</div>
		<div class="col-4">
			<input type="submit" class="btn bg-light btn-outline-success"
				value="追加">
		</div>
	</form>
</div>
@endsection
