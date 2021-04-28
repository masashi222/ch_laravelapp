@extends('layouts.base')

@section('title','勤怠打刻')

@section('link')
<link rel="stylesheet" href="{{asset('css/stamp.css')}}">
@endsection

@section('script')
<script src="{{asset('js/stamp.js')}}"></script>
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
勤怠打刻
@endslot
@endcomponent

<div class="row py-3">
	<div class="mb-2 mx-auto col-auto">
		<span class="h1" id="month"></span><span class="text-black-50" id="year"></span>
	</div>
	<div class="w-100"></div>
	<div class="mx-auto col-auto">
		<span class="h2" id="date"></span><span class="h2" id="day"></span><span class="h2" id="time"></span>
	</div>
</div>
<form method="post" action="@empty($gone) {{ route('stamp.store') }} @endempty @isset($gone) {{ route('stamp.update') }} @endisset"
 class="row border-top">
	@csrf
	@empty($gone)
	<div class="col-12 mt-3">
		<label for="stamp-key" class="form-label">勤怠打刻キー</label> 
		<input class="form-control @error('key') is-invalid @enderror" type="number" id="stamp-key" name="key" value="{{ old('key') }}">
	</div>
	@error('key')
	<div class="col-12 text-danger">{{ $message }}</div>
	@enderror
	@endempty
	<div class="col-12 mt-3">
		<label for="carfare" class="form-label">交通費</label> 
		<input class="form-control @error('carfare') is-invalid @enderror" type="number" id="carfare" name="carfare"
		 @empty($gone) value="{{ old('carfare') }}" @endempty @isset($gone) value="{{ $carfare }}" @endisset>
	</div>
	@error('carfare')
	<div class="col-12 text-danger">{{ $message }}</div>
	@enderror
	<div class="w-50 position-relative mt-3">
		<button type="button" class="btn btn-success d-block go w-100" data-bs-toggle="modal" data-bs-target="#checkModal" @isset($gone) disabled @endisset></button>
	</div>
	<div class="w-50 position-relative mt-3">
		<button type="button" class="btn btn-secondary d-block leave w-100" data-bs-toggle="modal" data-bs-target="#checkModal" @empty($gone) disabled @endempty></button>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="checkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"	aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">
						<i class="fas fa-exclamation-triangle">&ensp;注意喚起</i>
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
				@empty($gone)
				<div class="modal-body">
					出勤しますか？
				</div>
				@endempty
				@isset($gone)
				<div class="modal-body">
					交通費を入力しましたか？
					<br>
					退勤しますか？
				</div>
				@endisset
				<div class="modal-footer">
					@empty($gone)
					<button type="submit" class="btn btn-secondary" data-url="" name="go" value="go">出勤</button>
					@endempty
					@isset($gone)
					<button type="submit" class="btn btn-secondary" data-url="" name="leave" value="leave">退勤</button>
					@endisset
					<button type="button" class="btn btn-success"
						data-bs-dismiss="modal">中止</button>
				</div>
			</div>
		</div>
	</div>

</form>
@endsection

