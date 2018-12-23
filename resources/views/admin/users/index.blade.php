@extends('layouts.admin')

@section('content')
<table class="table table-inverse">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Email</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
		<tr>
			<td>{{ $user->id }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>
			<td class="text-center">
				<button type="button" class="btn btn-sm btn-info">View</button>
				<button type="button" class="btn btn-sm btn-warning">Edit</button>
				<button type="button" class="btn btn-sm btn-danger">Delete</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection