@extends('layouts.base')

@section('title','給与計算書')

@section('link')
<link rel="stylesheet" href="{{asset('css/payroll.css')}}">
@endsection

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
給与計算書
@endslot
@endcomponent

<div class="row mt-3">
	<div class="col">
	(株）一客一灯&ensp;給与計算書
	</div>
</div>
<div class="row">
	<div class="col-1">
	1
	</div>
	<div class="col-2">
	本田博人
	</div>
	<div class="col clearfix">
		<div class="float-end">
			{{ $period['from'] }}〜{{ $period['to'] }}
		</div>
	</div>
</div>
@each('components.payroll_table',$data,'data')

@endsection
