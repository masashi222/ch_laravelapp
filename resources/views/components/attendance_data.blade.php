<tr>
	<td>{{ $data['go_date'] }}</td>
	<td>{{ $data['go_time'] }}</td>
	<td>{{ $data['leave_time'] ?? '' }}</td>
	<td>{{ $data['carfare'] }}</td>
	<td>{{ $data['salary'] ?? '' }}</td>
	@can('owner-higher')
	<td>	
		<a href="{{ route('attendance.edit') }}/{{ $data['stampid'] }}" class="btn btn-light border border-secondary change-btn" >変更</a>
	</td>
	<td>
		<button type="button" class="btn btn-light border border-secondary delete-btn" data-bs-toggle="modal" data-bs-target="#deleteCheckModal">削除</button>
	</td>
	@endcan
</tr>

<!-- Modal -->
@can('owner-higher')
<div class="modal fade" id="deleteCheckModal" data-bs-backdrop="static"
	data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					<i class="fas fa-exclamation-triangle">&ensp;注意喚起</i>
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"
					aria-label="Close"></button>
			</div>
			<div class="modal-body">
				{{ $data['name'] }}さんの{{ $data['go_date'] }}の勤怠データを削除しますか？
			</div>
			<div class="modal-footer">
				<a href="{{ route('attendance.delete') }}/{{ $data['stampid'] }}" class="btn btn-secondary">実行</a>
				<button type="button" class="btn btn-success"
					data-bs-dismiss="modal">中止</button>
			</div>
		</div>
	</div>
</div>
@endcan
