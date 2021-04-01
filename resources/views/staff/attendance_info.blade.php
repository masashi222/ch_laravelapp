@extends('layouts.base')

@section('title','Staff/AttendanceInfo')

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
勤怠情報画面
@endslot
@endcomponent

<div class="row my-3 d-flex justify-content-center">
	@component('components.calendar_year_month')
    @endcomponent
</div>
<div class="row py-2 border-top border-bottom bg-light text-center d-flex align-items-center">
	<div class="col-3"></div>
	<div class="col-md-2 col-3">勤務時間</div>
	<div class="col-3 text-center">
		<div class="row">
			<div class="col-md-8 col-12">交通費</div>
			<div class="col-md-4 col-12">給与</div>
		</div>
	</div>
</div>
@each('components.attendance_record',$attendance_record,'attendance_record')
@empty($attendance_record)
@component('components.none_attendance_record')
@endcomponent
@endempty
<div class="row my-3 text-center">
	<div class="col-md-8 col-9"></div>
	<div class="col-md-4 col-3">
		<div class="row d-flex justify-content-center">
			<div class="col-md-6">
        	</div>
			<div class="col-md-6 col-12">
    			<button type="button" class="btn btn-link btn-sm">登録</button>
    		</div>
		</div>
	</div>
</div>
@endsection
