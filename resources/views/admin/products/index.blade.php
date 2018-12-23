@extends('layouts.admin')

@section('content')
<div class="row">
	<div class="col-md-8">
		<h2>Products</h2>
	</div>
	<div class="col-md-4">
		<a href="{{route('products.create')}}">
	  		<button type="button" class="btn btn-primary float-right">Create</button>
		</a>
	</div>
</div>
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
				<button type="button" class="btn btn-sm btn-info">View</button>
				<button type="button" class="btn btn-sm btn-warning">Edit</button>
				<button type="button" class="btn btn-sm btn-danger">Delete</button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection