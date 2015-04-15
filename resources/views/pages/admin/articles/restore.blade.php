<p>Do you want to restore the <strong>{{ $article->present()->name }}</strong> article?</p>

{!! Form::model($article, ['route' => ['admin.article.restore', $article->id], 'method' => 'put']) !!}
	<div class="visible-xs visible-sm">
		<p>{!! Form::button("Restore Article", ['type' => 'submit', 'class' => 'btn btn-success btn-lg btn-block']) !!}</p>
	</div>
	<div class="visible-md visible-lg">
		<p>{!! Form::button("Restore Article", ['type' => 'submit', 'class' => 'btn btn-success btn-lg']) !!}</p>
	</div>
{!! Form::close() !!}