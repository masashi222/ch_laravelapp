<table class="table table-bordered mb-1 text-center">
	<tr>
		<td>No.</td><td></td><td>氏名</td><td>時間</td><td>給与額</td><td>交通費</td><td>振込金額</td><td></td><td>退職・採用日</td><td>概要</td>
	</tr>
	<tr>
		<td rowspan="3" id="no">{{ $data['staff_number'] }}</td><td rowspan="3"></td><td rowspan="3" id="name">{{ $data['name'] }}</td><td>{{ $data['normal_time'] }}</td><td>{{ $data['normal_salary'] }}</td><td class="text-end">{{ $data['days'] }}日</td><td></td><td></td><td rowspan="3">退職年月日</td><td rowspan="3"></td>
	</tr>
	<tr>
		<td>{{ $data['midnight_time'] }}</td><td>{{ $data['midnight_salary'] }}</td><td>{{ $data['total_carfare'] }}</td><td></td><td></td>
	</tr>
	<tr>
		<td>計</td><td>{{ $data['salary'] }}</td><td>{{ $data['carfare'] }}</td><td>{{ $data['total_salary'] }}</td><td></td>
	</tr>
</table>
