<table class="table table-bordered text-center mb-1">
	<tr>
		<td>No.</td><td></td><td>氏名</td><td>時間</td><td>給与額</td><td>交通費</td><td>振込金額</td><td></td><td>退職・採用日</td><td>概要</td>
	</tr>
	<tr>
		<td rowspan="3" class="no-name">{{ $payroll_data['no'] }}</td><td rowspan="3"></td><td rowspan="3" class="no-name">{{ $payroll_data['name'] }}</td><td>{{ $payroll_data['normal_time'] }}</td><td>{{ $payroll_data['normal_salary'] }}</td><td class="text-end">{{ $payroll_data['days'] }}日</td><td></td><td></td><td rowspan="3">退職年月日</td><td rowspan="3"></td>
	</tr>
	<tr>
		<td>{{ $payroll_data['midnight_time'] }}</td><td>{{ $payroll_data['midnight_salary'] }}</td><td>{{ $payroll_data['total_carfare'] }}</td><td></td><td></td>
	</tr>
	<tr>
		<td>計</td><td>{{ $payroll_data['salary'] }}</td><td>{{ $payroll_data['carfare'] }}</td><td>{{ $payroll_data['total_salary'] }}</td><td></td>
	</tr>
</table>
