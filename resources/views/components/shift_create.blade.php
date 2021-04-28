<div class="create-window" data-date="{{ $shift_data['go_date'] }}" style="display: none;">
	<fieldset disabled>
		<input type="hidden" name="submittalsid[]" value="{{ $shift_data['submittalid'] }}">
		<div class="row border-bottom border-secondary d-flex align-items-center position-relative" >
			<div class="col-12 clearfix border-bottom py-2">
					<div class="float-start"><i class='fas fa-square fa-fw' style="color:{{ $shift_data['color'] }};"></i></div>
					<div class="float-start">
						{{ $shift_data['name'] }}
					</div>
				</div>
			<div class="col-12 clearfix border-bottom py-2">
				<div class="float-start">登録</div>
				<div class="form-check form-switch float-end mb-0">
					<input class="form-check-input ms-0" type="checkbox" id="registationStatus{{ $shift_data['submittalid'] }}" name="registation_status[{{ $shift_data['submittalid'] }}]">
				</div>
			</div>
			<div class="col-12 border-bottom py-2 clearfix">
				<div class="float-start">出勤</div>
				<div class="float-end">
					<select class="form-select border-0 p-0" style="background-image: none; width: 6rem;" id="goTime{{ $shift_data['submittalid'] }}" name="go_time[{{ $shift_data['submittalid'] }}]">
						<option value="17:00:00">変更：17:00</option>
						<option value="17:30:00">変更：17:30</option>
						<option value="18:00:00">変更：18:00</option>
						<option value="18:30:00">変更：18:30</option>
						<option value="19:00:00">変更：19:00</option>
						<option value="19:30:00">変更：19:30</option>
					</select>
				</div>
			</div>
			<div class="col-12 py-2 clearfix">
				<div class="float-start">退勤</div>
				<div class="float-end">
					<select class="form-select border-0 p-0" style="background-image: none; width: 6rem;" id="leaveTime{{ $shift_data['submittalid'] }}" name="leave_time[{{ $shift_data['submittalid'] }}]">
						<option value="22:00:00">変更：22:00</option>
						<option value="22:30:00">変更：22:30</option>
						<option value="23:00:00">変更：23:00</option>
						<option value="23:30:00">変更：23:30</option>
						<option value="24:00:00">変更：24:00</option>
						<option value="29:00:00">変更：ラスト</option>
					</select>
				</div>
			</div>
		</div>
	</fieldset>
</div>