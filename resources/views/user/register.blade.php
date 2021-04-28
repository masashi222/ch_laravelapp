@extends('layouts.base')

@section('title','ユーザー情報の登録')

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
	ユーザー情報の登録
	@endslot
@endcomponent

<form method="post" action="{{ route('user.store') }}" class="border-top">
	@csrf
	<div class="row my-3">
		<label for="name" class="col-md-3 col-4 col-form-label">名前</label>
		<div class="col-md-9 col-8">
			<input
			type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="" name="name" value="{{ old('name') }}">
		</div>
		@error('name')
		<div class="col-md-3 col-4"></div>
		<div class="col-md-9 col-8 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="email" class="col-md-3 col-4 col-form-label">メール</label>
		<div class="col-md-9 col-8">
			<input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
				aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
		</div>
		@error('email')
		<div class="col-md-3 col-4"></div>
		<div class="col-md-9 col-8 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="check-email" class="col-md-3 col-4 col-form-label">確認&nbsp;メール</label>
		<div class="col-md-9 col-8">
			<input type="email" class="form-control @error('check_email') is-invalid @enderror" id="check-email"
				aria-describedby="emailHelp" name="check_email" value="{{ old('check_email') }}">
		</div>
		@error('check-email')
		<div class="col-md-3 col-4"></div>
		<div class="col-md-9 col-8 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="hourly-wage" class="col-md-3 col-4 col-form-label">時給</label>
		<div class="col-md-9 col-8">
			<input class="form-control @error('hourly_wage') is-invalid @enderror" type="number" id="hourly-wage" name="hourly_wage" value="{{ old('hourly_wage') }}">
		</div>
		@error('hourly_wage')
		<div class="col-md-3 col-4"></div>
		<div class="col-md-9 col-8 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="staff_number" class="col-md-3 col-4 col-form-label">従業員番号</label>
		<div class="col-md-9 col-8">
			<input class="form-control @error('staff_number') is-invalid @enderror" type="number" id="staff-number"
				name="staff_number" value="{{ old('staff_number') }}">
		</div>
		@error('staff_number')
		<div class="col-md-3 col-4"></div>
		<div class="col-md-9 col-8 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<legend class="col-md-3 col-4 col-form-label">ログイン権限</legend>
		<div class="col-md-9 col-8">
			@can('admin')
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="auth"
					id="radio-owner" value="4" {{ old('auth') == '4' ? 'checked' : '' }}> <label class="form-check-label"
					for="radio-staff">オーナー</label>
			</div>
			@endcan
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="auth"
					id="radio-staff" value="7" {{ old('auth') == '7' ? 'checked' : '' }}> <label class="form-check-label"
					for="radio-staff">従業員</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio"
					name="auth" id="radio-accountant" value="10" {{ old('auth') == '10' ? 'checked' : '' }}> <label
					class="form-check-label" for="radio-tax-accountant">税理士</label>
			</div>
		</div>
		@error('auth')
		<div class="col-md-3 col-4"></div>
		<div class="col-md-9 col-8 text-danger">{{ $message }}</div>
		@enderror
	</div>

	<button type="submit" class="btn bg-light btn-outline-success" name="submit-btn">送信</button>

</form>

@endsection