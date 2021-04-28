@extends('layouts.base')

@section('title','勤怠データ変更')

@section('header')
@component('components.header')
	@slot('href')
	{{ $href }}
	@endslot
@endcomponent
@endsection

@section('script')
<script>
window.data = @json($data);
</script>
<script src="{{ asset('js/attendance_change.js') }}"></script>
@endsection

@section('content')
@component('components.nav')
	@slot('nav')
	勤怠データ変更
	@endslot
@endcomponent

<div class="row d-flex justify-content-center position-relative">
	@component('components.staff_tag')
    	@slot('data')
    	{{ $data['name'] }}
    	@endslot
    @endcomponent
	<div class="col-auto py-3">
		<span id="year">{{ $calendar['year'] }}</span>
		<span id="month">{{ $calendar['month'] }}</span>
		<span id="date">{{ $calendar['date'] }}</span>
		<span id="day">{{ $calendar['day'] }}</span>
	</div>
</div>
@include('components.attendance_change_form')

@endsection
