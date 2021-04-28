@extends('layouts.base')

@section('title','アカウント情報')

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
    アカウント情報
    @endslot
@endcomponent

<h5 class="py-3 border-bottom">アカウント情報</h5>
<table class="table" class="my-3">
	<tr>
		<td scope="row">名前</td>
		<td>{{ $user['name'] }}</td>
	</tr>
	<tr>
		<td scope="row">メール</td>
		<td>{{ $user['email'] }}</td>
	</tr>
</table>

<h5 class="py-3 border-bottom">メールアドレス変更</h5>
<form method="post" action="{{ route('account.update') }}">
	@csrf
	<div class="row my-3">
		<label for="email" class="col-md-3 col-4 col-form-label">メール</label>
		<div class="col-md-9 col-8">
			<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" 
			aria-describedby="emailHelp" value="{{ old('email') }}" name="email">
		</div>
		@error('email')
		<div class="col-3"></div>
		<div class="col-9 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="check-email" class="col-md-3 col-4 col-form-label">確認&nbsp;メール</label>
		<div class="col-md-9 col-8">
			<input type="email" class="form-control @error('check_email') is-invalid @enderror" id="check-email" 
			aria-describedby="emailHelp" value="{{ old('check_email') }}" name="check_email">
		</div>
		@error('check_email')
		<div class="col-3"></div>
		<div class="col-9 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="password" class="col-md-3 col-4 col-form-label">パスワード</label>
		<div class="col-md-9 col-8">
			<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" 
			aria-describedby="" value="{{ old('password') }}" name="password">
		</div>
		@error('password')
		<div class="col-3"></div>
		<div class="col-9 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<button type="submit" class="btn bg-light btn-outline-success mb-3">送信</button>
</form>

<h5 class="py-3 border-bottom">パスワード変更</h5>
<div class="row my-3">
	<div class="col-12">
		<a href="{{ route('password.request') }}" class="btn btn-link">パスワード変更ページ</a>
	</div>
</div>
@endsection
