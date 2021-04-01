@extends('layouts.base')

@section('title','Accountant/Top')

@section('content')
<!-- 勤怠管理 -->
@component('components.menu_main')
	@slot('menu_main')
	勤怠管理
	@endslot
@endcomponent
@each('components.menu_sub',$menu_sub_attendance,'menu_sub')
<!-- ログイン情報変更画面 -->
@component('components.menu_main')
	@slot('menu_main')
	アカウント管理
	@endslot
@endcomponent
@each('components.menu_sub',$menu_sub_account,'menu_sub')
@endsection