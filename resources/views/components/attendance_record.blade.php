<div class="row py-2 d-flex align-items-center text-center border-bottom">
	<div class="col-3">{{ $attendance_record['date'] }}</div>
	<div class="col-md-2 col-3">
		<div class="row">
			<div class="col-md-6 col-12">{{ $attendance_record['go_work'] }}</div>
			<div class="col-md-6 col-12">{{ $attendance_record['leave_work'] }}</div>
		</div>
	</div>
	<div class="col-3">
		<div class="row">
			<div class="col-md-8 col-12">{{ $attendance_record['carfare'] }}</div>
			<div class="col-md-4 col-12">{{ $attendance_record['salary'] }}</div>
		</div>
	</div>
	<div class="col-md-4 col-3">
		<div class="row">
			<div class="col-md-6 col-12">
				<a href="{{ route('owner.attendance_info_change') }}" class="btn btn-link btn-sm">変更</a>
			</div>
			<div class="col-md-6 col-12">
				<button type="button" class="btn btn-link btn-sm" name="delete" data-bs-toggle="modal" data-bs-target="#staticBackdrop">削除</button>
			</div>
		</div>
	</div>
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
			<div class="modal-body">Are you sure you want to delete the attendance data on 2/21?</div>
			<div class="modal-footer">
				<a href="{{ route('owner.attendance_info_delete') }}" class="btn btn-secondary">Run</a>
				<button type="button" class="btn btn-primary"
					data-bs-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>
