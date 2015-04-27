<p>Do you want to restore the <strong>{{ $tag->present()->name }}</strong> tag?</p>

{!! Form::model($tag, ['route' => ['admin.tag.restore', $tag->id], 'method' => 'put']) !!}
	<div class="visible-xs visible-sm">
		<p>{!! Form::button("Restore Tag", ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) !!}</p>
	</div>
	<div class="visible-md visible-lg">
		<p>{!! Form::button("Restore Tag", ['type' => 'submit', 'class' => 'btn btn-success btn-lg']) !!}</p>
	</div>
{!! Form::close() !!}