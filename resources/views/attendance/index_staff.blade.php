@extends('layouts.base')

@section('title','勤怠一覧')

@section('link')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
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

<table class="table table-bordered text-center my-3">
	<tr class="table-light">
		<td></td>
		<td>出勤</td>
		<td>退勤</td>
		<td>交通費</td>
		<td>給与</td>
	</tr>
    @each('components.attendance_data_staff',$data,'data')
    @empty($data)
    @component('components.none_attendance_data')
    @endcomponent
    @endempty
    @endsection
</table>
