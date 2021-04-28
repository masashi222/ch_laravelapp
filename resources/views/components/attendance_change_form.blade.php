<form method="post" action="{{ route($form_action) }}@isset($data['stampid'])/{{ $data['stampid'] }}@endisset" class="border-top">
	@csrf
	<div class="row my-3">
		<label for="go-time" class="col-3 col-form-label">出勤</label>
		<div class="col-9 ">
			<input class="form-control @error('go_time') is-invalid @enderror" type="datetime-local" id="goTime" name="go_time" value="{{ old('go_time') }}" 
			min="{{ $data['min_go_time'] ?? '' }}" max="{{ $data['max_go_time'] ?? '' }}">
		</div>
		@error('go_time')
		<div class="col-3"></div>
		<div class="col-9 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="leave-time" class="col-3 col-form-label">退勤</label>
		<div class="col-9 ">
			<input class="form-control @error('leave_time') is-invalid @enderror" type="datetime-local" id="leaveTime" name="leave_time" value="{{ old('leave_time') }}"
			min="{{ $data['min_go_time'] ?? '' }}">
		</div>
		@error('leave_time')
		<div class="col-3"></div>
		<div class="col-9 text-danger">{{ $message }}</div>
		@enderror
		@error('format_leave_time')
		<div class="col-3"></div>
		<div class="col-9 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<div class="row mb-3">
		<label for="carfare" class="col-3 col-form-label">交通費</label>
		<div class="col-9 ">
			<input class="form-control @error('carfare') is-invalid @enderror" type="number" id="carfare" name="carfare" value="{{ old('carfare') }}">
		</div>
		@error('carfare')
		<div class="col-3"></div>
		<div class="col-9 text-danger">{{ $message }}</div>
		@enderror
	</div>
	<button type="submit" class="btn btn-outline-success bg-light">送信</button>
</form>
