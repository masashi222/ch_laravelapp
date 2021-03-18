@extends('layouts.base')

@section('title','Owner/Top')

@section('link')
<link rel="stylesheet" href="{{asset('css/top.css')}}">
@endsection

@section('content')
<div class="row bg-light">
<!-- シフト管理 -->
	@component('components.menu_main')
		@slot('menu_main')
		シフト管理
		@endslot
	@endcomponent
	@each('components.menu_sub',$menu_sub_shift,'menu_sub')
<!-- 勤怠管理 -->
	@component('components.menu_main')
		@slot('menu_main')
		勤怠管理
		@endslot
	@endcomponent
	@each('components.menu_sub',$menu_sub_attendance,'menu_sub')
<!-- ユーザー管理 -->
	@component('components.menu_main')
		@slot('menu_main')
		ユーザー管理
		@endslot
	@endcomponent
	@each('components.menu_sub',$menu_sub_user,'menu_sub')
<!-- ログイン情報変更画面 -->
	@component('components.menu_main')
		@slot('menu_main')
		アカウント管理
		@endslot
	@endcomponent
	@each('components.menu_sub',$menu_sub_account,'menu_sub')
</div>
@endsection