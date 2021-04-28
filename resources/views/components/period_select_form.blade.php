<form method="post" action="{{ route($form_action) }}" class="row my-3">
	@csrf
	<div class="col-auto">
		<select class="form-select" name="period">
			@isset($data)
			@foreach( $data as $item)
			<option value="{{ $item['value'] }}">{{ $item['display'] }}</option>
			@endforeach
			@endisset
		</select>
	</div>
	<div class="col-auto">
		@isset($data)
		<button type="submit" class="btn btn-outline-success bg-light" name="select_btn">選択</button>
		@endisset
		@empty($data)
		<button type="submit" class="btn btn-outline-success bg-light disabled" name="select_btn">選択</button>
		@endempty
	</div>
</form>