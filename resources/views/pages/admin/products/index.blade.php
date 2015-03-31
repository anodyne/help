@extends('layouts.master')

@section('title')
	Products
@stop

@section('content')
	<h1>Products</h1>

	<div class="visible-xs visible-sm">
		<p><a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-lg btn-block">Add a Product</a></p>
	</div>
	<div class="visible-md visible-lg">
		<div class="btn-toolbar">
			<div class="btn-group">
				<a href="{{ route('admin.product.create') }}" class="btn btn-primary">Add a Product</a>
			</div>
		</div>
	</div>

	@if ($products->count() > 0)
		<div class="data-table data-table-bordered data-table-striped">
		@foreach ($products as $product)
			<div class="row">
				<div class="col-md-9">
					<p class="lead{{ ((bool) $product->display === false) ? ' text-muted' : '' }}">{{ $product->present()->name }}</p>
				</div>
				<div class="col-md-3">
					<div class="visible-xs visible-sm">
						<p><a href="{{ route('admin.product.edit', [$product->id]) }}" class="btn btn-default btn-lg btn-block">Edit</a></p>
						<p><a href="#" class="btn btn-danger btn-lg btn-block js-productAction" data-id="{{ $product->id }}" data-action="remove">Remove</a></p>
					</div>
					<div class="visible-md visible-lg">
						<div class="btn-toolbar pull-right">
							<div class="btn-group">
								<a href="{{ route('admin.product.edit', [$product->id]) }}" class="btn btn-default">Edit</a>
							</div>
							<div class="btn-group">
								<a href="#" class="btn btn-danger js-productAction" data-id="{{ $product->id }}" data-action="remove">Remove</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		</div>
	@else
		{!! alert('warning', "No products found") !!}
	@endif
@stop

@section('modals')
	{!! modal(['id' => 'removeProduct', 'header' => "Remove Product"]) !!}
@stop

@section('scripts')
	<script>
		$('.js-productAction').on('click', function(e)
		{
			e.preventDefault();

			var id = $(this).data('id');
			var action = $(this).data('action');

			if (action == 'remove')
			{
				$('#removeProduct').modal({
					remote: "{{ url('admin/product') }}/" + id + "/remove"
				}).modal('show');
			}
		});
	</script>
@stop