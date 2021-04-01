<form method="post" action="{{ $form_items['action'] }}" class="row py-2 border-top">
	@csrf
	<div class="col-12 mb-3">
		<label for="go-time" class="form-label">出勤</label>
		<input class="form-control" type="datetime-local" id="go-time"
       name="go-time" value="2021-02-21T17:28"
       min="2021-02-21T00:00" max="2021-02-21T23:59">
	</div>
	<div class="col-12 mb-3">
		<label for="leave-time" class="form-label">退勤</label>
		<input class="form-control" type="datetime-local" id="leave-time"
       name="leave-time" value="2021-02-21T17:28"
       min="2021-02-21T00:00" max="2021-02-22T23:59">
	</div>
	<div class="col-12 mb-3">
		<label for="carfare" class="form-label">交通費</label>
		<input class="form-control" type="number" id="carfare"
       name="carfare" value=""
       min="0" max="1000" step="10">
	</div>
	<div class="col">
		<button type="submit" class="btn bg-light btn-outline-success">送信</button>
	</div>
</form>
