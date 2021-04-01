@extends('layouts.base')

@section('title','Owner/User')

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
ユーザー表示画面
@endslot
@endcomponent
<div class="row my-3 py-2 border-top border-bottom bg-light text-center">
	<div class="col-6">
		従業員
	</div>
	<div class="col-6">
	</div>
</div>
@each('components.user_record',$user_record,'user_record')
@component('components.user_register_btn')
@slot('register_href')
{{ $register_href }}
@endslot
@endcomponent
@endsection
