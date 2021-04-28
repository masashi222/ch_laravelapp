@extends('layouts.base')

@section('title','ログイン')

@section('link')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="row mt-5">
	<div class="col-lg-6 col-md-8 col-12 mx-auto">
		<div class="card">
			<div class="card-header p-4 h2 text-success">
				<i class="fas fa-cogs">&nbsp;業務システムログイン</i>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('login') }}" class="row">
					@csrf
					<div class="col-12">
						<label for="name" class="form-label">名前</label>
						<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="" name="name" value="{{ old('name') }}">
					</div>
					@error('name')
            		<div class="col-12 text-danger">{{ $message }}</div>
            		@enderror
					<div class="col-12 mt-3">
						<label for="password" class="form-label">パスワード</label>
						<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
					</div>
					@error('password')
            		<div class="col-12 text-danger">{{ $message }}</div>
            		@enderror
					<div class="col-auto mt-3">
						<button type="submit" class="btn btn-light btn-outline-success" name="login_btn">ログイン</button>
					</div>
					@if (Route::has('password.request'))
					<div class="col-auto mt-3">
						<a href="{{ route('password.request') }}" class="btn btn-link">パスワードをお忘れですか？</a>
					</div>
					@endif
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
