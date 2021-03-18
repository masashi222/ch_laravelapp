@extends('layouts.base')

@section('title','Owner/Shift')

@section('link')
<link rel="stylesheet" href="{{asset('css/shift.css')}}">
@endsection

@section('header_left_content')
@component('components.header_left_content')
@endcomponent
@endsection

@section('content')
<div class="row my-3">
	<div class="col-auto mx-auto">
		@component('components.calendar_btn_prev')
		@endcomponent
		<span class="h1 me-2 ms-5" id="month"></span><span class="text-black-50 me-5" id="year"></span>
		@component('components.calendar_btn_next')
		@endcomponent
	</div>
</div>
<div class="row" id="calendar">
    <table class="table table-bordered table-responsive">
    	<tr>
    		<td>日</td><td>月</td><td>火</td><td>水</td><td>木</td><td>金</td><td>土</td>
    	</tr>
    	<tr>
    		<th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th><th>21</th>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th><th>29</th>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<th>23</th><th>24</th><th>25</th><th>26</th><th>27</th><th>28</th><th>29</th>
    	</tr>
    	<tr>
    		<td class="bg-primary">梶原</td><td class="bg-primary">梶原</td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td class="bg-info">瀬良垣</td><td class="bg-warning">本田</td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td class="bg-danger">左衛門..</td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td class="text-dark">他2人</td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<th>30</th><th>31</th><th></th><th></th><th></th><th></th><th></th>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    	<tr>
    		<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    	</tr>
    </table>
</div>
@endsection
@section('script')
<script src="{{asset('js/shift.js')}}"></script>
@endsection