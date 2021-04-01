@extends('layouts.base') @section('title','Admin/OwnerInfoRegister')

@section('header_left_content')
@component('components.header_left_content')
@slot('data_url')
{{ $data_url }}
@endslot
@endcomponent @endsection

@section('content') @component('components.menu_main')
@slot('menu_main') オーナー情報登録画面 @endslot @endcomponent
<form method="post" action="{{ route('admin.owner_info_register_send') }}" class="row py-2 my-3">
	@csrf
	<div class="col-12 mb-3">
		<label for="email" class="form-label">Email</label> <input
			type="email" class="form-control" id="email"
			aria-describedby="emailHelp">
	</div>
	<div class="col-12 mb-3">
		<label for="check-email" class="form-label">確認&ensp;Email</label> <input
			type="email" class="form-control" id="check-email"
			aria-describedby="emailHelp">
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