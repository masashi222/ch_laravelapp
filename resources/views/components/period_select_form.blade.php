<form method="post" action="{!! $form_items['action'] ?? '' !!}" class="row">
	@csrf
	<div class="col-4">
		<select class="form-select">{!! $form_items['year'] ?? '' !!}</select>
	</div>
	<div class="col-4">
		<select class="form-select">{!! $form_items['month'] ?? '' !!}</select>
	</div>
	<div class="col-4">
		<input type="submit" class="btn bg-light btn-outline-success" value="送信">
	</div>
</form>