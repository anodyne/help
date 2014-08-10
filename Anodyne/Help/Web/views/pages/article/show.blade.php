@extends('layouts.master')

@section('title')
    {{ $article->present()->title }}
@stop

@section('content')
    <div class="btn-toolbar pull-right">
        <div class="btn-group">
            <a href="{{ URL::previous() }}" class="btn btn-default">{{ $_icons['back'] }}</a>
        </div>

        @if (Auth::check())
            <div class="btn-group">
                <a href="#comments" class="btn btn-default">{{ $_icons['comments'] }}</a>
                <a href="#comments" class="btn btn-default">{{ $_icons['flag'] }}</a>
                <a href="#comments" class="btn btn-default">{{ $_icons['share'] }}</a>
            </div>

            @if ($_currentUser->can('help.article.edit') or $_currentUser->id == $article->author->id)
                <div class="btn-group">
                    <a href="#" class="btn btn-default">{{ $_icons['edit'] }}</a>
                </div>
            @endif
        @endif
    </div>

    <h1>{{ $article->present()->title }}</h1>
    <h4>by {{ $article->present()->author }}</h4>
    <p>
        @if ($article->ratings->count() > 0)
            {{ $article->present()->ratingLabel }}
        @endif
        {{ $article->present()->productLabel }}
        {{ $article->present()->tagsLabel }}
    </p>

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

    <hr class="partial-split">

    {{ $article->present()->content }}

    <hr class="partial-split">

    <div ng-controller="CommentsController">
        <a name="comments"></a><h3>Comments <span ng-if="countComments()">(<% countComments() %>)</span></h3>

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

        <blockquote ng-repeat="comment in comments">
            <div ng-bind-html="comment.content"></div>
            <div ng-bind-html="comment.author"></div>
        </blockquote>
    </div>
@stop

@section('scripts')
    <script>

        window.url = "{{ Request::root() }}";
        window.articleId = "{{ $article->id }}";
        window.userId = "{{ $_currentUser->id }}";

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