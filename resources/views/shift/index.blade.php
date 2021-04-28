@extends('layouts.base')

@section('title','シフト一覧')

@section('link')
<link rel="stylesheet" href="{{asset('css/calendar.css')}}">
@endsection

@section('script')
<script>
window.shiftData = @json($shift_data);
</script>
<script src="{{asset('js/calendar.js')}}"></script>
<script src="{{asset('js/display_calendar.js')}}"></script>
@endsection

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
	シフト一覧
	@endslot
@endcomponent

<div class="row d-flex justify-content-center position-relative">
	@component('components.calendar')
    @endcomponent
	<div class="col-auto position-absolute top-50 start-0 translate-middle-y">
    	<button type="button" class="btn btn-light" id="prev" onclick="prev()"><i class="fas fa-chevron-left text-success"></i></button>
    </div>
        <div class="col-auto position-absolute top-50 end-0 translate-middle-y">
    	<button type="button" class="btn btn-light" id="next" onclick="next()"><i class="fas fa-chevron-right text-success"></i></button>
    </div>
</div>

<div class="row" id="calendar">

</div>

<div class="row bg-success mt-3 text-white">
	<div class="col" id="date" style=" height: 1.5rem">日付を選択してください</div>
</div>
@each('components.shift',$shift_data,'shift_item')

@endsection