@extends('partak.users.layout')

@section('inner-content')
	<div class="container table-responsive">
		<h3>Quarantined students</h3>

		<table class="table p-table">
			<thead>
				<tr>
					<th>Student</th>
					<th>Email</th>
					<th>Quarantined until</th>
				</tr>
			</thead>
			<tbody>
			@foreach($users as $exStudent)
				<tr>
					<td>@include('partak.components.user-link', ['user' => $exStudent->person])</td>
					<td>{{ $exStudent->user->email }}</td>
					<td>{{ $exStudent->quarantined_until->formatLocalized(__('formatting.full-date')) }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
@stop