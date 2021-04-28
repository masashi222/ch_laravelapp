@extends('layouts.base')

@section('title','ユーザー情報の変更')

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
	ユーザー情報の変更
	@endslot
@endcomponent

<h5 class="py-3 border-bottom">ユーザー情報</h5>
<table class="table" class="my-3">
	<tr>
		<td scope="row">名前</td>
		<td>{{ $user['name'] }}</td>
	</tr>
	<tr>
		<td scope="row">メール</td>
		<td>{{ $user['email'] }}</td>
	</tr>
	<tr>
		<td scope="row">時給</td>
		<td>{{ $user['hourly_wage'] ?? '' }}</td>
	</tr>
	<tr>
		<td scope="row">従業員番号</td>
		<td>{{ $user['staff_number'] ?? '' }}</td>
	</tr>
	<tr>
		<td scope="row">ログイン権限</td>
		<td>{{ $user['auth_item'] }}</td>
	</tr>
</table>

<h5 class="py-3 border-bottom">ユーザー情報変更</h5>
<form method="post" action="{{ url('user/userid') }}/{{ $user['userid'] }}">
	@csrf
	<div class="row my-3">
		<label for="name" class="col-md-3 col-4 col-form-label">名前</label>
		<div class="col-md-9 col-8">
			<input
			type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ $user['name'] }}" name="name" value="{{ old('name') }}">
		</div>
		@error('name')
		<div class="col-md-3 col-4"></div>
		<div class="col-md-9 col-8 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="hourly-wage" class="col-md-3 col-4 col-form-label">時給</label>
		<div class="col-md-9 col-8">
			<input
			class="form-control @error('hourly_wage') is-invalid @enderror" type="number" id="hourly-wage" name="hourly_wage"
			placeholder="{{ $user['hourly_wage'] }}" value="{{ old('hourly_wage') }}">
		</div>
		@error('hourly-wage')
		<div class="col-md-3 col-4"></div>
		<div class="col-md-9 col-8 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="staff_number" class="col-md-3 col-4 col-form-label">従業員番号</label>
		<div class="col-md-9 col-8">
			<input class="form-control @error('staff_number') is-invalid @enderror" type="number" id="staff-number"
				placeholder="{{ $user['staff_number'] }}" name="staff_number" value="{{ old('staff_number') }}">
		</div>
		@error('staff-number')
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
					id="radio-owner" value="4" {{ old('auth') == '4' || $user['auth'] == '4' ? 'checked' : '' }}>
					<label class="form-check-label" for="radio-staff">オーナー</label>
			</div>
			@endcan
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="auth"
					id="radio-staff" value="7" {{ old('auth') == '7' || $user['auth'] == '7' ? 'checked' : '' }}>
					<label class="form-check-label" for="radio-staff">従業員</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio"
					name="auth" id="radio-accountant" value="10" {{ old('auth') == '10' || $user['auth'] == '10' ? 'checked' : '' }}>
					<label class="form-check-label" for="radio-tax-accountant">税理士</label>
			</div>
		</div>
	</div>
	<button type="submit" class="btn bg-light btn-outline-success" name="submit-btn">送信</button>

</form>
@endsection
