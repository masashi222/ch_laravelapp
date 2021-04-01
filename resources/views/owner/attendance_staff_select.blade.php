@extends('layouts.base')

@section('title','Owner/AttendanceStaffSelect')

@section('link')
<link rel="stylesheet" href="{{asset('css/attendance_staff_select.css')}}">
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
従業員選択画面
@endslot
@endcomponent
<div class="row my-3  d-flex justify-content-center position-relative">
	@component('components.calendar_year_month')
    @endcomponent
</div>
<div class="row py-2 border-top border-bottom bg-light text-center">
	<div class="col-4">
		従業員
	</div>
	<div class="col-4">
	</div>
	<div class="col-4">
		選択
	</div>
</div>
@each('components.attendance_staff_record',$staff_records,'staff_records')
<div class="row my-3 salary-status-discription">
	<div class="col-12 mb-2">
		<i class="fas fa-minus-circle text-secondary d-inline-block d-flex align-items-center">&ensp;<span class="d-inline-block d-flex align-items-center">給与締め日を迎えていない状態です。</span></i>
	</div>
	<div class="col-12 mb-2">
		<i class="fas fa-minus-circle text-success d-inline-block d-flex align-items-center">&ensp;<span class="d-inline-block d-flex align-items-center">給与が確定されていない状態です。</span></i>
	</div>
	<div class="col-12 mb-2">
		<i class="fas fa-check-circle text-primary d-inline-block d-flex align-items-center">&ensp;<span class="d-inline-block d-flex align-items-center">給与が確定されている状態です。</span></i>
	</div>
	<div class="col-12 mb-2">
		<i class="fas fa-exclamation-circle text-danger d-inline-block d-flex align-items-center">&ensp;<span class="d-inline-block d-flex align-items-center">給与が確定できない状態です。</span></i>
	</div>
</div>
@endsection
