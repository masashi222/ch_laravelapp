@extends('layouts.base')

@section('title','勤怠打刻キー')

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
	勤怠打刻キー
	@endslot
@endcomponent

<div class="row my-3">
	<div class="col">
		{{ $data['today_date'] }}の勤怠打刻キーです。
	</div>
</div>
<div class="row">
	<div class="col"><strong>{{ $data['key'] ?? '勤怠打刻キーがありません。' }}</strong></div>
</div>
@endsection