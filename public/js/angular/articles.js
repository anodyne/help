var app = angular.module('app', []).config(function($interpolateProvider)
{
	// Change the start and end symbols so we don't clash with Blade
	$interpolateProvider.startSymbol('{%').endSymbol('%}');
});

var uniqueItems = function (data, key)
{
	var result = [];

	for (var i = 0; i < data.length; i++)
	{
		var value = data[i][key];

		if (result.indexOf(value) == -1)
			result.push(value);
	}

	return result;
}

var uniqueItemsArray = function (data, key)
{
	var result = [];

	for (var i = 0; i < data.length; i++)
	{
		var subData = data[i][key];

		for (var j = 0; j < subData.length; j++)
		{
			var value = data[i][key][j];

			if (result.indexOf(value) == -1)
				result.push(value);
		}
	}

	return result;
}

app.controller('ArticlesLoadingController', function ($scope)
{
	// Listen for the load event
	$scope.$on('load', function()
	{
		$scope.loading = true;
	});

	// Listen for the unload event
	$scope.$on('unload', function()
	{
		$scope.loading = false;
	});
});

app.controller('ArticlesController', function ($scope, $http, $window, filterFilter)
{
	// We're loading the page
	$scope.$emit('load');

	// Initialize the list of articles
	$scope.articles = {};
	$scope.useProducts = {};
	$scope.useTags = {};

	// Get the articles
	$http({
		url: $window.baseUrl + "/api/articles/trashed",
		method: "GET"
	}).success(function (data)
	{
		$scope.articles = data.data;

		$scope.$watch(function()
		{
			return {
				articles: $scope.articles,
				useProducts: $scope.useProducts,
				useTags: $scope.useTags
			}
		}, function (value)
		{
			var selected;

			$scope.count = function (prop, value)
			{
				return function (el)
				{
					return el[prop] == value;
				};
			};

			// Grab all of the products referenced in the articles collection
			$scope.productsGroup = uniqueItems($scope.articles, 'product');

			// Grab all of the tags referenced in the articles collection
			$scope.tagsGroup = uniqueItemsArray($scope.articles, 'tags');

			// We're done loading the page now
			$scope.$emit('unload');

			// Set selected
			selected = false;

			// Filtered product list
			var filterAfterProducts = [];
			
			for (var j in $scope.articles)
			{
				var a = $scope.articles[j];

				for (var i in $scope.useProducts)
				{
					if ($scope.useProducts[i])
					{
						selected = true;

						if (i == a.product)
						{
							filterAfterProducts.push(a);
							break;
						}
					}
				}
			}
			
			if ( ! selected)
				filterAfterProducts = $scope.articles;

			// Filtered tag list
			var filterAfterTags = [];

			for (var j in filterAfterProducts)
			{
				// Get the article
				var a = filterAfterProducts[j];

				for (var i in $scope.useTags)
				{
					if ($scope.useTags[i])
					{
						selected = true;

						for (var t in a.tags)
						{
							var tag = a.tags[t];
							
							if (i == tag)
							{
								filterAfterTags.push(a);
								break;
							}
						}
					}
				}
			}
			
			if ( ! selected)
				filterAfterTags = filterAfterProducts;

			$scope.filteredArticles = filterAfterTags;
		}, true);
	});
});
