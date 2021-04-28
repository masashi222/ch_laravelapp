@extends('layouts.base')

@section('title','勤怠確認の従業員選択')

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
	勤怠確認の従業員選択
	@endslot
@endcomponent

<div class="row d-flex justify-content-center">
	@include('components.calendar')
</div>

<table class="table text-center border-top">
	<tr>
    	<th>氏名</th>
    	<th>給与</th>
    	<th></th>
	</tr>
	@each('components.staff_select_table_row',$data,'item')
</table>

@endsection
