@extends('layouts.master')

@section('title')
	{{ $article->present()->title }}
@stop

@section('content')
	<div class="row">
		<div class="col-sm-8 col-md-9">
			<h1>{{ $article->present()->title }}</h1>
			<p>
				{{ $article->present()->productLabel }}
				{{ $article->present()->tagsLabel }}
			</p>

			<div class="author-metadata">
				<a href="{{ route('account.profile', [$article->author->username]) }}" class="author-avatar">{{ $article->author->present()->avatar(['type' => false, 'class' => 'avatar avatar-sm img-circle']) }}</a>
				<a href="{{ route('account.profile', [$article->author->username]) }}" class="author-name">{{ $article->present()->author }}</a>
				<div class="article-date text-muted">{{ $article->present()->updated }}</div>
			</div>
		</div>
		<div class="col-sm-4 col-md-3">
			<div class="visible-xs visible-sm">
				@if (Auth::check())
					@if ($_currentUser->can('help.admin') or $article->isOwner($_currentUser))
						<p><a href="#" class="btn btn-lg btn-block btn-default">Edit Article</a></p>
					@endif
				@endif

				<p><a href="#" class="btn btn-lg btn-block btn-warning">Article Needs Review</a></p>
			</div>
			<div class="visible-md visible-lg">
				@if (Auth::check())
					@if ($_currentUser->can('help.admin') or $article->isOwner($_currentUser))
						<p><a href="#" class="btn btn-block btn-default">Edit Article</a></p>
					@endif
				@endif

				<p><a href="#" class="btn btn-block btn-warning">Article Needs Review</a></p>
			</div>

			<hr class="partial-split">

			<div class="text-center">
				<p class="text-muted text-sm"><strong>Was this article helpful?</strong></p>
				
				<div class="visible-xs visible-sm">
					<p><a href="#" class="btn btn-lg btn-block btn-success">{{ $_icons['thumbsUp'] }}</a></p>
					<p><a href="#" class="btn btn-lg btn-block btn-danger">{{ $_icons['thumbsDown'] }}</a></p>
				</div>
				<div class="visible-md visible-lg">
					<p>
						<a href="#" class="btn btn-success">{{ $_icons['thumbsUp'] }}</a>
						<a href="#" class="btn btn-danger">{{ $_icons['thumbsDown'] }}</a>
					</p>
				</div>

				<p class="text-sm text-muted">{{ $article->present()->helpfulFull }} found this helpful</p>
			</div>
		</div>
	</div>

	{{ $article->present()->content }}

	<hr class="partial-split">

	<h2>Comments</h2>

	<div class="btn-toolbar">
		<div class="btn-group">
			<a href="#" rel="comment" class="btn btn-default">Add a Comment</a>
		</div>
	</div>

	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default hide" id="commentPanel">
				<div class="panel-heading">
					<button type="button" class="close">&times;</button>
					<h2 class="panel-title"><span class="tab-icon tab-icon-up1">{{ $_icons['comment'] }}</span>Add a Comment</h2>
				</div>
				<div class="panel-body">
					<p>If you have an issue with this article, please make sure to flag it for review with the Flag For Review button at the top of the page. Comments should be used to ask questions or commend the author on their work.</p>
					
					<form ng-submit="addComment()">
						<div class="row">
							<div class="col-md-10 col-lg-10">
								<div class="form-group">
									{{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5, 'ng-model' => 'newCommentContent']) }}
									<p class="help-block text-sm">{{ $_icons['markdown'] }} Parsed as Markdown</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								{{ Form::button('Submit', ['type' => 'submit', 'id' => 'commentSubmit', 'class' => 'btn btn-default']) }}
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<blockquote>
		<div ng-bind-html="comment.content"></div>
		<div ng-bind-html="comment.author"></div>
	</blockquote>

	<div class="panel panel-default hide" id="reviewPanel">
		<div class="panel-heading">
			<button type="button" class="close">&times;</button>
			<h2 class="panel-title"><span class="tab-icon tab-icon-up2">{{ $_icons['flag'] }}</span>Article Review Request</h2>
		</div>
		<div class="panel-body">
			<p>If you've found information in this article that is incorrect or you think should be reviewed for accuracy or appropriateness, please submit a review request. The author and Anodyne Productions will review the article and make any necessary updates. You can also leave comments about what you feel should be reviewed below.</p>
			
			<form ng-submit="addComment()">
				<div class="row">
					<div class="col-md-10 col-lg-10">
						<div class="form-group">
							{{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5, 'ng-model' => 'newCommentContent']) }}
							<p class="help-block text-sm">{{ $_icons['markdown'] }} Parsed as Markdown</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						{{ Form::button('Submit', ['type' => 'submit', 'id' => 'commentSubmit', 'class' => 'btn btn-default']) }}
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="panel panel-default hide" id="sharePanel">
		<div class="panel-heading">
			<button type="button" class="close">&times;</button>
			<h2 class="panel-title"><span class="tab-icon tab-icon-up2">{{ $_icons['share'] }}</span>Share Article</h2>
		</div>
		<div class="panel-body">
			<form ng-submit="addComment()">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email address']) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							{{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Message']) }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						{{ Form::button('Send', ['type' => 'submit', 'id' => 'commentSubmit', 'class' => 'btn btn-default']) }}
					</div>
				</div>
			</form>
		</div>
	</div>
@stop

@section('scripts')
	<script>

		$('.close').on('click', function()
		{
			$(this).closest('.panel').addClass('hide');
		});

		$('[rel="comment"]').on('click', function(e)
		{
			e.preventDefault();
			$('#commentPanel').removeClass('hide');
		});

	</script>
@stop