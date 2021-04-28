@extends('layouts.base')

@section('title','勤怠データ登録')

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
	勤怠データ登録
	@endslot
@endcomponent

<div class="row d-flex justify-content-center position-relative">
	@component('components.staff_tag')
    	@slot('data')
    	{{ $data['name'] }}
    	@endslot
    @endcomponent
	@include('components.calendar')
</div>
@include('components.attendance_change_form')

@endsection
