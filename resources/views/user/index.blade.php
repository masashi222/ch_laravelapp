@extends('layouts.base')

@section('title','ユーザー一覧')

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
ユーザー一覧
@endslot
@endcomponent

<table class="table my-3 text-center">
	<tr>
    	<th>従業員</th>
    	<th colspan="2"></th>
	</tr>
	@each('components.user_table_row',$data,'data')
	@component('components.register_btn')
	@endcomponent
</table>

@endsection
