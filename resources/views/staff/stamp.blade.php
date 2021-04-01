@extends('layouts.base')

@section('title','Staff/Stamp')

@section('link')
<link rel="stylesheet" href="{{asset('css/stamp.css')}}">
@endsection

@section('header_left_content')
@component('components.header_left_content')
@slot('data_url')
{{ $data_url }}
@endslot
@endcomponent
@endsection

@section('content')
@component('components.menu_main')
@slot('menu_main')
勤怠打刻画面
@endslot
@endcomponent

<div class="row my-3 d-flex justify-content-center">
	@component('components.calendar_year_month')
    @endcomponent
</div>
<form method="post" action="#" class="row py-2 border-top">
	<div class="col-12 mb-3">
		<label for="stamp-key" class="form-label">勤怠打刻キー</label> <input
			class="form-control" type="number" id="stamp-key"
			name="stamp-key" value="">
	</div>
	<div class="col-12 mb-3">
		<label for="carfare" class="form-label">交通費</label> <input
			class="form-control" type="number" id="carfare"
			name="carfare" value="" min="0" max="2000" step="10">
	</div>
	<div class="w-50 position-relative">
		<button type="submit" class="btn btn-success d-block go w-100"></button>
	</div>
	<div class="w-50 position-relative">
		<button type="submit" class="btn btn-light d-block leave w-100"></button>
	</div>
</form>
@endsection
@section('script')
<script src="{{asset('js/stamp.js')}}"></script>
@endsection
