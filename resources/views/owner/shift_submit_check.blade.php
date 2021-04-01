@extends('layouts.base') @section('title','Owner/ShiftSubmitCheck')

@section('link')
<link rel="stylesheet" href="{{asset('css/shift.css')}}">
@endsection @section('script')
<script src="{{asset('js/shift_submit_check.js')}}"></script>
<script src="{{asset('js/calendar.js')}}"></script>
@endsection @section('header_left_content')
@component('components.header_left_content')
@slot('data_url')
{{ $data_url }}
@endslot
@endcomponent @endsection

@section('content') @component('components.menu_main')
@slot('menu_main') シフト提出状況表示画面 @endslot @endcomponent
<div class="row my-3">
		<div class="col-12">
			<div class="alert alert-warning alert-dismissible fade show"
				role="alert">
				<strong>Warning!</strong>&nbsp;The following members have not submitted.
				梶原,瀬良垣.
				<button type="button" class="btn-close" data-bs-dismiss="alert"
					aria-label="Close"></button>
			</div>
		</div>
	</div>
<div class="row my-3 d-flex justify-content-center position-relative">
	@component('components.calendar_year_month') @endcomponent
	<div class="col-auto position-absolute top-50 end-0 translate-middle-y">
		<button type="button"
			class="btn btn-outline-white rounded-pill shadow text-success"
			data-bs-toggle="modal" data-bs-target="#staticBackdrop">
			<i class="far fa-calendar-alt">&ensp;作成</i>
		</button>
	</div>
</div>
<div class="row" id="calendar"></div>

<div class="shift-select-window pb-3">
	<div
		class="row mb-3 bg-success text-white shift-select-window_date_wrap">
		<div class="col shift-select-window_date">2021年3月16日（火）</div>
	</div>
	<div
		class="row gx-0 text-center py-2 border-top border-bottom bg-light">
		<div class="col-6">氏名</div>
		<div class="col-6">時間</div>
	</div>
	@each('components.shift_record',$shift_record,'shift_record')
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
	data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					<i class="fas fa-exclamation-triangle">&ensp;Heads Up</i>
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<div class="modal-body">Do you want to close the submission of shifts
				from 3/16 to 3/31?</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary page-nav"
					data-url="{{ route('owner.shift_create') }}">Run</button>
				<button type="button" class="btn btn-primary"
					data-bs-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
@endsection
