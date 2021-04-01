<form method="post" action="#"
	class="row gx-0 py-2 d-flex align-items-center text-center border-bottom">
	<div class="col-md-2 col-3">{{ $shift_select_record['name'] }}</div>
	<div class="col-md-4 col-3">
		<div class="row">
			<div class="col-md-6 col-sm-12 pb-md-0 pb-2">{{ $shift_select_record['go_work'] }}</div>
			<div class="col-md-6 col-sm-12">{{ $shift_select_record['leave_work'] }}</div>
		</div>
	</div>
	<div class="col-md-4 col-3">
		<div class="row">
			<div class="col-md-6 col-12 pb-md-0 pb-2">
				<select class="form-select form-select-sm">
					<option>16:00</option>
					<option>16:30</option>
					<option>17:00</option>
					<option>17:30</option>
					<option>18:00</option>
					<option>18:30</option>
					<option>19:00</option>
					<option>19:30</option>
					<option>20:00</option>
				</select>
			</div>
			<div class="col-md-6 col-12">
				<select class="form-select form-select-sm">
					<option>22:00</option>
					<option>22:30</option>
					<option>23:00</option>
					<option>23:30</option>
					<option>24:00</option>
					<option>ラスト️</option>
				</select>
			</div>
		</div>
	</div>
	<div class="col-md-2 col-3">
		<input type="checkbox" data-toggle="toggle" data-size="sm" data-onstyle="success" data-offstyle="light"
			data-on="In" data-off="Out">
	</div>
</form>