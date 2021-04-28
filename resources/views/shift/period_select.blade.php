@extends('layouts.base')

@section('title','シフト作成の期間選択')

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
	シフト作成の期間選択
	@endslot
@endcomponent

@include('components.period_select_form')

@endsection