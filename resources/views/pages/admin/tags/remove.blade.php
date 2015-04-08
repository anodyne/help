<p>Are you sure you want to remove the <strong>{{ $tag->present()->name }}</strong> tag? This action is permanent and can't be undone!</p>

{!! Form::model($tag, ['route' => ['admin.tag.destroy', $tag->id], 'method' => 'delete']) !!}
	<div class="visible-xs visible-sm">
		<p>{!! Form::button("Remove Tag", ['type' => 'submit', 'class' => 'btn btn-danger btn-lg btn-block']) !!}</p>
	</div>
	<div class="visible-md visible-lg">
		<p>{!! Form::button("Remove Tag", ['type' => 'submit', 'class' => 'btn btn-danger btn-lg']) !!}</p>
	</div>
{!! Form::close() !!}