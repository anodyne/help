var helpApp = angular.module('helpApp', ['ngSanitize'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});

function CommentsController($scope, $http, $window) {

	$http.get($window.url + '/comments/' + $window.articleId).success(function(comments)
	{
		$scope.comments = comments.data;
	});

	$scope.countComments = function()
	{
		var count = 0;

		angular.forEach($scope.comments, function(comment)
		{
			count += 1;
		});

		return count;
	}

	$scope.addComment = function()
	{
		var comment = {
			user_id: $window.userId,
			article_id: $window.articleId,
			content: $scope.newCommentContent
		};

		// Post the data
		$http.post($window.url + '/comments/' + $window.itemId, comment);

		// Refresh all the comments
		$http.get($window.url + '/comments/' + $window.itemId).success(function(comments)
		{
			$scope.comments = comments.data;
		});

		// Hide the panel
		$('#commentPanel').fadeOut('normal');
	}
}