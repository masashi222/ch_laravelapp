@extends('layouts.base') @section('title','Admin/OwnerInfoChange')

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
	@slot('attendance_staff_tag') 本田 @endslot @endcomponent
</div>
<form method="post" action="{{ route('admin.owner_info_change_send') }}" class="row py-2 border-top">
	@csrf
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
	<div class="col">
		<button type="submit" class="btn bg-light btn-outline-success">送信</button>
	</div>
</form>
@endsection
