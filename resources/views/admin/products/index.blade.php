@extends('layouts.admin')

@section('content')
<div class="line"></div>
<table class="table table-inverse">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Price</th>
			<th>Stock</th>
			<th class="text-center">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($products as $product)
		<tr>
			<td>{{ $product->id }}</td>
			<td>{{ $product->name }}</td>
			<td>{{ $product->price }}</td>
			<td>{{ $product->stock }}</td>
			<td class="text-center">
				<a type="button" class="btn btn-sm btn-info">View</a>
				<a type="button" class="btn btn-sm btn-warning">Edit</a>
				<a type="button" class="btn btn-sm btn-danger">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection