@extends('layouts.base')

@section('title','Owner/AttendanceInfoRegister')

@section('link')
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
勤怠情報登録画面
@endslot
@endcomponent

<div class="row my-3 d-flex justify-content-center position-relative">
	@component('components.attendance_staff_tag')
    	@slot('attendance_staff_tag')
    	梶原
    	@endslot
    @endcomponent
	@component('components.calendar_year_month')
    @endcomponent
</div>
@include('components.attendance_form',['form_items'=>$form_items])
@endsection
