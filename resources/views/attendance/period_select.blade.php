@extends('layouts.base')

@section('title','勤怠管理の期間選択')

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
	勤怠管理の期間選択
	@endslot
@endcomponent

@include('components.period_select_form')

@endsection