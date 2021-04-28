@extends('layouts.base')

@section('title','トップ')

@section('content')
<!-- シフト管理 -->
@can('staff-higher')
@component('components.nav')
	@slot('nav')
	シフト管理
	@endslot
@endcomponent
@endcan
@each('components.nav_item',$data_shift,'data')
<!-- 勤怠管理 -->
@component('components.nav')
	@slot('nav')
	勤怠管理
	@endslot
@endcomponent
@each('components.nav_item',$data_attendance,'data')
<!-- ユーザー管理 -->
@can('owner-higher')
@component('components.nav')
	@slot('nav')
	ユーザー管理
	@endslot
@endcomponent
@each('components.nav_item',$data_user,'data')
@endcan
<!-- アカウント管理 -->
@component('components.nav')
	@slot('nav')
	アカウント管理
	@endslot
@endcomponent
@each('components.nav_item',$data_account,'data')
@endsection