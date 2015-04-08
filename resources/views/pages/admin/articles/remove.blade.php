<p>Are you sure you want to remove the <strong>{{ $article->present()->title }}</strong> article?</p>

{!! Form::model($article, ['route' => ['admin.article.destroy', $article->id], 'method' => 'delete']) !!}
	<div class="visible-xs visible-sm">
		<p>{!! Form::button("Remove Article", ['type' => 'submit', 'class' => 'btn btn-danger btn-lg btn-block']) !!}</p>
	</div>
	<div class="visible-md visible-lg">
		<p>{!! Form::button("Remove Article", ['type' => 'submit', 'class' => 'btn btn-danger btn-lg']) !!}</p>
	</div>
{!! Form::close() !!}