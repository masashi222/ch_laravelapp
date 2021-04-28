@extends('layouts.base')

@section('title','メール送信')

@section('link')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection @section('content')

<div class="row mt-5">
	<div class="col-lg-6 col-md-8 col-12 mx-auto">
		<div class="card">
			<div class="card-header p-4 h2 text-success">
				パスワード変更
			</div>
			<div class="card-body">
				@if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

				<form method="post" action="{{ route('password.email') }}" class="row">
					@csrf
					<div class="col-12">
						<label for="email" class="form-label">メール</label>
						<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="" name="email" value="{{ old('email') }}">
					</div>
					@error('email')
					<div class="col-12 text-danger">{{ $message }}</div>
					@enderror
					<div class="col-auto mt-3">
						<button type="submit" class="btn btn-light btn-outline-success" name="submit_btn">送信</button>
					</div>
					<div class="col-auto mt-3">
						<a href="{{ route('login') }}" class="btn btn-link">ログインページ</a>
					</div>
				</form>
			</div>
			<div class="card-footer text-muted">
				入力したメールアドレス宛にメールが送信されます。<br>
				メール内のリンクよりパスワードの変更を行ってください。<br>
			</div>
		</div>
	</div>
</div>
@endsection
