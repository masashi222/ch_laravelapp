@extends('layouts.base')

@section('title','Owner/StampKey')

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
	勤怠打刻キー表示画面
	@endslot
@endcomponent
<div class="row my-3">
	<div class="col">
		<strong>
		3月24日（水）の勤怠打刻キーです。
		</strong>
	</div>
</div>
<div class="row">
	<div class="col"><strong>{{ $stamp_key ?? '勤怠打刻キーがありません。' }}</strong></div>
</div>
@endsection