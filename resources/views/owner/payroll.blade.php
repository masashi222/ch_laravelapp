@extends('layouts.base') @section('title','Owner/Payroll')

@section('link')
<link rel="stylesheet" href="{{asset('css/payroll.css')}}">
@endsection @section('header_left_content')
@component('components.header_left_content')
@slot('data_url')
{{ $data_url }}
@endslot
@endcomponent @endsection

@section('content') @component('components.menu_main')
@slot('menu_main') 給与計算書画面 @endslot @endcomponent
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
		令和3年&ensp;2／21&ensp;〜&ensp;3／20
		</div>
	</div>
</div>
@each('components.payroll_table',$payroll_data,'payroll_data')
@endsection
