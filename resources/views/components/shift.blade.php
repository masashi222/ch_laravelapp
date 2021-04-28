<div class="row py-2 border-bottom submit-status-window" data-date="{{ $shift_item['go_date'] }}" style="display: none;">
	<div class="col-auto">
		<i class="fas fa-square" style="color: {{ $shift_item['color'] }};"></i>
	</div>
	<div class="col-auto">
		{{ $shift_item['name'] }}
	</div>
	<div class="w-100"></div>
	<div class="col-auto">
		<i class="fas fa-square text-white"></i>
	</div>
	<div class="col-auto">
		{{ $shift_item['split_go_time'] }} - {{ $shift_item['split_leave_time'] }}
	</div>
</div>