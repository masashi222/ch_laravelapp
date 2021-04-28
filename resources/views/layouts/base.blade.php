<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title')</title>
<!-- css -->
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/all.min.css')}}">
@yield('link')

<!-- script -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/page_nav.js')}}"></script>
@yield('script')
</head>
<body>
<div class="container-fluid">
    <div class="row bg-success no-print header">
    	<div class="col py-3 clearfix">
    		@yield('header')
    		<div class="float-end">
    			<a href="{{ route('logout') }}" class="btn btn-secondary">ログアウト</a>
    		</div>
    	</div>
    </div>
	@yield('content')
</div>
</body>
</html>