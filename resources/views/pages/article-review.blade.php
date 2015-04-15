<p>We want to ensure the articles available on the Help Center are as accurate and helpful as possible. If this article doesn't meet that standard, we encourage you to let us know what you think could be improved so we can make the changes. When an article has been updated, you'll receive an email notification.</p>

<hr class="partial-split">

<form action="{{ route('article.review') }}" class="form-horizontal" method="POST">
	<div class="form-group">
		<label class="control-label col-md-3">The Issue</label>
		<div class="col-md-9">
			<select name="type" class="form-control input-lg">
				<option value="correction">I think something is wrong in the article</option>
				<option value="review">I think this article needs an overall review</option>
				<option value="suggestion">I'm suggesting a change to this article</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-3">Comments</label>
		<div class="col-md-9">
			{!! Form::textarea('comments', null, ['class' => 'form-control input-lg', 'rows' => 10]) !!}
			<p class="help-block">Be sure to let us know what you think should be changed and how we can make this article better. Be as specific as possible!</p>
		</div>
	</div>

	{!! Form::hidden('article', $article->id) !!}
	{!! Form::token() !!}

	<div class="form-group">
		<div class="col-md-9 col-md-offset-3">
			<div class="visible-xs visible-sm">
				{!! Form::button("Submit Review Request", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg btn-block']) !!}
			</div>
			<div class="visible-md visible-lg">
				{!! Form::button("Submit Review Request", ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
			</div>
		</div>
	</div>
</form>