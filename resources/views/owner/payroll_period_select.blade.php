@extends('layouts.base')

@section('title','Owner/PayrollPeriodSelect')

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
	給与計算書期間選択画面
	@endslot
@endcomponent
<div class="row my-3">
	<div class="col">
		<strong>表示する給与計算書の期間を選択してください。</strong>
	</div>
</div>
@include('components.period_select_form',['form_items'=>$form_items])
@endsection