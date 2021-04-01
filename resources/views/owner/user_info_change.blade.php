@extends('layouts.base') @section('title','Owner/UserInfoChange')

@section('link')
<link rel="stylesheet" href="{{asset('css/user_info_change.css')}}">
@endsection

@section('header_left_content')
@component('components.header_left_content')
@slot('data_url')
{{ $data_url }}
@endslot
@endcomponent @endsection

@section('content') @component('components.menu_main')
@slot('menu_main') ユーザー情報変更画面 @endslot @endcomponent
<div class="row my-3 position-relative height-40">
	@component('components.attendance_staff_tag')
	@slot('attendance_staff_tag') 梶原 @endslot @endcomponent
</div>
<form method="post" action="{{ route('owner.user_info_change_send') }}" class="row py-2 border-top">
	@csrf
	<div class="col-12 mb-3">
		<label for="staff_number" class="form-label">従業員番号</label> <input
			class="form-control" type="number" id="staff-number"
			name="staff-number" value="">
	</div>
	<div class="col-12 mb-3">
		<label for="email" class="form-label">Email</label> <input
			type="email" class="form-control" id="email"
			aria-describedby="emailHelp" disabled>
	</div>
	<div class="col-md-6 mb-3">
		<label for="family-name" class="form-label">姓</label> <input
			type="text" id="family-name" class="form-control" placeholder="">
	</div>
	<div class="col-md-6 mb-3">
		<label for="first-name" class="form-label">名</label> <input
			type="text" id="first-name" class="form-control" placeholder="">
	</div>
	<div class="col-12 mb-3">
		<label for="hour-wage" class="form-label">時給</label> <input
			class="form-control" type="number" id="hour-wage" name="hour-wage"
			value="" min="0" max="2000" step="10">
	</div>
	<legend class="col-form-label col">ログイン権限</legend>
	<div class="col-12 mb-3">
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio"
				name="radio-staff" id="radio-staff" value=""> <label
				class="form-check-label" for="radio-staff">従業員</label>
		</div>
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio"
				name="radio-tax-accountant" id="" value=""> <label
				class="form-check-label" for="radio-tax-accountant">税理士</label>
		</div>
	</div>
	<div class="col">
		<button type="submit" class="btn bg-light btn-outline-success">送信</button>
	</div>
</form>
@endsection
