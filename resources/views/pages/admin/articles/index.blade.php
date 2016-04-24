@extends('layouts.master')

@section('title')
	Articles
@stop

@section('content')
	<h1>Articles</h1>
	
	<div ng-controller="ArticlesLoadingController">
		<div ng-show="loading">
			<h4 class="text-center">{!! HTML::image('images/ajax-loader.gif') !!}</h4>
		</div>

		<div ng-cloak>
			<div class="visible-xs visible-sm">
				<p><a href="{{ route('admin.article.create') }}" class="btn btn-primary btn-lg btn-block">Add an Article</a></p>
				<p><a href="{{ route('admin.review.index') }}" class="btn btn-default btn-lg btn-block">Article Review Queue</a></p>
			</div>
			<div class="visible-md visible-lg">
				<div class="btn-toolbar">
					<div class="btn-group">
						<a href="{{ route('admin.article.create') }}" class="btn btn-primary">Add an Article</a>
					</div>
					<div class="btn-group">
						<a href="{{ route('admin.review.index') }}" class="btn btn-default">Article Review Queue</a>
					</div>
				</div>
			</div>

			<div class="row" id="articles" ng-controller="ArticlesController">
				<div class="col-md-3 col-md-push-9">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Filter Articles</h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label class="control-label">By Product</label>
								<div id="productCheckboxes" ng-repeat="product in productsGroup">
									<div class="checkbox">
										<label><input type="checkbox" ng-model="useProducts[product]"> {% product %}</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label">By Tag</label>
								<div id="tagCheckboxes" ng-repeat="tag in tagsGroup">
									<div class="checkbox">
										<label><input type="checkbox" ng-model="useTags[tag]"> {% tag %}</label>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label">By Title</label>
								{!! Form::text('searchTitle', null, ['class' => 'form-control', 'ng-model' => 'search.title']) !!}
							</div>
						</div>

						<div class="panel-footer">
							<div class="visible-xs visible-sm">
								<a class="btn btn-default btn-lg btn-block" ng-click="search = {}; useProducts = {}; useTags = {}">Reset Filters</a>
							</div>
							<div class="visible-md visible-lg">
								<a class="btn btn-default btn-block" ng-click="search = {}; useProducts = {}; useTags = {}">Reset Filters</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-9 col-md-pull-3">
					<div class="data-table data-table-bordered data-table-striped">
						<div class="row" ng-repeat="article in filteredArticles | filter:search">
							<div class="col-md-8">
								<p class="lead">{% article.title %}</p>
								<p>
									<span class="label label-success">{% article.product %}</span>
									<span ng-repeat="tag in article.tags">
										<span class="label label-default">{% tag %}</span>
									</span>
								</p>
							</div>
							<div class="col-md-4">
								<div class="visible-xs visible-sm">
									<div class="row">
										<div class="col-sm-6">
											<p><a href="{% article.links.view %}" class="btn btn-default btn-lg btn-block">View</a></p>
										</div>
										<div class="col-sm-6">
											<p><a href="{% article.links.edit %}" class="btn btn-default btn-lg btn-block">Edit</a></p>
										</div>
										<div class="col-sm-6" ng-hide="{% article.isTrashed %}">
											<p><a href="#" data-id="{% article.id %}" data-action="remove" class="btn btn-danger btn-lg btn-block js-articleAction">Remove</a></p>
										</div>
										<div class="col-sm-6" ng-show="{% article.isTrashed %}">
											<p><a href="#" data-id="{% article.id %}" data-action="restore" class="btn btn-success btn-lg btn-block js-articleAction">Restore</a></p>
										</div>
									</div>
								</div>
								<div class="visible-md visible-lg">
									<div class="btn-toolbar pull-right">
										<div class="btn-group">
											<a href="{% article.links.view %}" class="btn btn-default">View</a>
										</div>
										<div class="btn-group">
											<a href="{% article.links.edit %}" class="btn btn-default">Edit</a>
										</div>
										<div class="btn-group" ng-hide="{% article.isTrashed %}">
											<a href="#" data-id="{% article.id %}" data-action="remove" class="btn btn-danger js-articleAction">Remove</a>
										</div>
										<div class="btn-group" ng-show="{% article.isTrashed %}">
											<a href="#" data-id="{% article.id %}" data-action="restore" class="btn btn-success js-articleAction">Restore</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('modals')
	{!! modal(['id' => 'removeArticle', 'header' => "Remove Article"]) !!}
	{!! modal(['id' => 'restoreArticle', 'header' => "Restore Article"]) !!}
@stop

@section('scripts')
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.js"></script>
	{!! HTML::script('js/angular/articles.js') !!}
	<script>
		var baseUrl = "{{ Request::root() }}";

		$(document).on('click', '.js-articleAction', function(e)
		{
			e.preventDefault();

			var id = $(this).data('id');
			var action = $(this).data('action');

			if (action == 'remove')
			{
				$('#removeArticle').modal({
					remote: "{{ url('admin/article') }}/" + id + "/remove"
				}).modal('show');
			}

			if (action == 'restore')
			{
				$('#restoreArticle').modal({
					remote: "{{ url('admin/article') }}/" + id + "/restore"
				}).modal('show');
			}
		});
	</script>
@stop