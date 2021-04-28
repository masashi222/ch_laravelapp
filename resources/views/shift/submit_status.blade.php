@extends('layouts.base')

@section('title','シフト提出状況')

@section('link')
<link rel="stylesheet" href="{{asset('css/calendar.css')}}">
@endsection

@section('script')
<script>
window.shiftData = @json($shift_data);
window.calendarData = @json($calendar_data);
</script>
<script src="{{asset('js/calendar.js')}}"></script>
<script src="{{asset('js/submit_status_calendar.js')}}"></script>
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
	シフト提出状況
	@endslot
@endcomponent

<div class="row d-flex justify-content-center position-relative">
	@component('components.calendar') 
	@endcomponent
	<div class="col-auto position-absolute top-50 end-0 translate-middle-y">
		@isset($closing_data)
		<button type="button" class="btn btn-outline-white rounded-pill shadow text-success btn-sm" data-bs-toggle="modal" data-bs-target="#closingCheckModal">
			<i class="far fa-calendar-alt">&ensp;作成</i>
		</button>
		@endisset
		@empty($closing_data)
		<a href="{{ route('shift.create') }}" class="btn btn-outline-white rounded-pill shadow text-success btn-sm">
			<i class="far fa-calendar-alt">&ensp;作成</i>
		</a>
		@endempty
	</div>
</div>
<!-- Alerts -->
@empty(!$unsubmitters_data)
<div class="alert alert-dismissible fade show border" role="alert">
  <h6>未提出者</h6>
  @each('components.unsubmitted',$unsubmitters_data,'unsubmitter_data')
  <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endempty
<div class="row" id="calendar"></div>

<div class="row bg-success mt-3 text-white" style="height:1.5rem;">
	<div class="col" id="date">日付を選択してください</div>
</div>
@each('components.shift',$shift_data,'shift_item')

<!-- Modal -->
<div class="modal fade" id="closingCheckModal" data-bs-backdrop="static"
	data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					<i class="fas fa-exclamation-triangle">&ensp;注意喚起</i>
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<div class="modal-body">{{ $closing_data['from'] ?? '' }}〜{{ $closing_data['to'] ?? '' }}のシフトの提出を締め切りますか？</div>
			<div class="modal-footer">
				<a href="{{ route('shift.submit.close') }}" class="btn btn-secondary"
					data-url="">実行</a>
				<button type="button" class="btn btn-success"
					data-bs-dismiss="modal">中止</button>
			</div>
		</div>
	</div>
</div>
@endsection
