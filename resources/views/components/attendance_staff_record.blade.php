<div class="row py-2 text-center border-bottom">
	<div class="col-4">
		{!! $staff_records['name'] !!}
	</div>
	<div class="col-4">
		{!! $staff_records['status'] !!}
	</div>
	<div class="col-4">
		<a href="{{ route('owner.attendance_info') }}">選択</a>
	</div>
</div>