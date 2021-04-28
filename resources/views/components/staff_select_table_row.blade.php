<tr>
	<td>{{ $item['name'] }}</td>
	<td>{{ $item['status'] ?? '' }}</td>
	<td><a href="{{ route('attendance.index') }}/{{ $item['userid'] }}">選択</a></td>
</tr>