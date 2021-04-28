@extends('layouts.base')

@section('title','勤怠一覧')

@section('link')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('script')
<script>
window.confirmed = @json($confirmed);
</script>
<script src="{{ asset('js/attendance.js') }}"></script>
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
	勤怠一覧
	@endslot
@endcomponent

<div class="row d-flex justify-content-center position-relative">
	@component('components.staff_tag')
    	@slot('data')
			{{ $user['name'] }}
    	@endslot
    @endcomponent
	@include('components.calendar')
	@can('owner-higher')
    <div class="col-auto position-absolute top-50 end-0 translate-middle-y">
		<a href="{{ route('salary.confirm') }}" class="btn btn-outline-white text-success rounded-pill shadow btn-sm {{ $confirmed == '1' || $confirmed == null ? 'disabled' : '' }}" id="confirmBtn">給与確定</a>
	</div>
	@endcan
</div>

<table class="table table-bordered text-center">
	<tr class="table-light">
		<td>日付</td>
		<td>出勤</td>
		<td>退勤</td>
		<td>交通費</td>
		<td>給与</td>
		@can('owner-higher')
		<td colspan="2"></td>
		@endcan
	</tr>
	@if($data->isEmpty())
	@component('components.none_attendance_data')
	@endcomponent
	@else
	@each('components.attendance_data',$data,'data')
	@endif
	@can('owner-higher')
	<tr>
		<td colspan="6"></td>
		<td><a href="{{ route('attendance.create') }}" 
		class="btn btn-light border border-secondary @if($confirmed == '1') disabled @endif" id="registerBtn" 
		name="register_btn">登録</a></td>
	</tr>
	@endcan
</table>

@endsection
