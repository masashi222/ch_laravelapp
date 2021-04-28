@extends('layouts.base')

@section('title','パスワード変更画面')

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
				<form method="post" action="#">
            		@csrf
            		<div class="col-12 mt-2 mb-3">
            			<label for="password" class="form-label">パスワード</label> <input
            				type="password" class="form-control" id="password" name="password">
            		</div>
            		<div class="col-12 mb-3">
            			<label for="password" class="form-label">確認&nbsp;パスワード</label> <input
            				type="password" class="form-control" id="password" name="password">
            		</div>
            		<div class="col">
            			<button type="submit" class="btn bg-light btn-outline-success" name="submit_btn">送信</button>
            		</div>
            	</form>
			</div>
			<div class="card-footer text-muted">
				登録するパスワードを入力して、送信してください。<br>
			</div>
		</div>
	</div>
</div>

@endsection
