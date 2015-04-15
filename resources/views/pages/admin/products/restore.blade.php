<p>Do you want to restore the <strong>{{ $product->present()->name }}</strong> product?</p>

{!! Form::model($product, ['route' => ['admin.product.restore', $product->id], 'method' => 'put']) !!}
	<div class="visible-xs visible-sm">
		<p>{!! Form::button("Restore Product", ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) !!}</p>
	</div>
	<div class="visible-md visible-lg">
		<p>{!! Form::button("Restore Product", ['type' => 'submit', 'class' => 'btn btn-success btn-lg']) !!}</p>
	</div>
{!! Form::close() !!}