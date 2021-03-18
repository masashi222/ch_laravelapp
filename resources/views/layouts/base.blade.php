<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title')</title>
<!-- css -->
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('css/header.css')}}">
@yield('link')

<!-- script -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-3.6.0.slim.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row bg-success">
    	<div class="col-12 clearfix header-content-wrap">
    		@yield('header_left_content')
    		<div class="float-end">
    			<button type="button" class="btn btn-secondary">ログアウト</button>
    		</div>
    	</div>
    </div>
	@yield('content')
</div>
</body>
@yield('script')
</html>