@extends('layouts.base')

@section('title','Owner/Shift')

@section('link')
<link rel="stylesheet" href="{{asset('css/shift.css')}}">
@endsection

@section('script')
<script src="{{asset('js/shift.js')}}"></script>
<script src="{{asset('js/calendar.js')}}"></script>
@endsection

@section('header_left_content')
@component('components.header_left_content')
@slot('data_url')
{{ $data_url }}
@endslot
@endcomponent
@endsection

@section('content')
@component('components.menu_main')
	@slot('menu_main')
	シフト確認画面
	@endslot
@endcomponent
<div class="row my-3 d-flex justify-content-center position-relative">
	@component('components.calendar_year_month')
    @endcomponent
	@component('components.calendar_btn_prev')
    @endcomponent
    @component('components.calendar_btn_next')
    @endcomponent
</div>
<div class="row" id="calendar">
</div>
<div class="shift-select-window pb-3">
	<div
		class="row mb-3 bg-success text-white shift-select-window_date_wrap">
		<div class="col shift-select-window_date">2021年3月16日（火）</div>
	</div>
	<div
		class="row gx-0 text-center py-2 border-top border-bottom bg-light">
		<div class="col-6">氏名</div>
		<div class="col-6">時間</div>
	</div>
	@each('components.shift_record',$shift_record,'shift_record')
</div>
@endsection