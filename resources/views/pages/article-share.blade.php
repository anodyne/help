<?php $initialMessage = $_currentUser->present()->name." thinks you might be interested in the article \"".$article->present()->title."\" on the Anodyne Help Center. You can view the article by following the link below.\r\n\r\n".route('article.show', [$article->product->slug, $article->slug])."\r\n\r\n";?>
<form action="{{ route('article.share') }}" class="form-horizontal" method="POST">
	<div class="form-group">
		<label class="control-label col-md-3">Recipient(s)</label>
		<div class="col-md-9">
			{!! Form::textarea('recipients', null, ['class' => 'form-control input-lg', 'rows' => 3]) !!}
			<p class="help-block">Separate email addresses with semicolons (;)</p>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Message</label>
		<div class="col-md-9">
			{!! Form::textarea('message', $initialMessage, ['class' => 'form-control input-lg', 'rows' => 10]) !!}
		</div>
	</div>

	{!! Form::token() !!}

	<div class="form-group">
		<div class="col-md-9 col-md-offset-3">
			<div class="visible-xs visible-sm">
				{!! Form::button("Share Article", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}
			</div>
			<div class="visible-md visible-lg">
				{!! Form::button("Share Article", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
			</div>
		</div>
	</div>
</form>