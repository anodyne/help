<p>Are you sure you want to remove the <strong>{{ $product->present()->name }}</strong> product? This action is permanent and can't be undone!</p>

{!! Form::model($product, ['route' => ['admin.product.destroy', $product->id], 'method' => 'delete']) !!}
	<div class="visible-xs visible-sm">
		<p>{!! Form::button("Remove Product", ['type' => 'submit', 'class' => 'btn btn-danger btn-lg btn-block']) !!}</p>
	</div>
	<div class="visible-md visible-lg">
		<p>{!! Form::button("Remove Product", ['type' => 'submit', 'class' => 'btn btn-danger btn-lg']) !!}</p>
	</div>
{!! Form::close() !!}