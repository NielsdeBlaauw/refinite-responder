var autoresponder = angular.module('autoresponder', [
		'ngRoute',
		'responderControllers',
		'responderFilters',
		'responderAnimations'
	]);

autoresponder.config(['$routeProvider',
		function($routeProvider){
			$routeProvider.
			when('/responder',{
				templateUrl: 'lib/app/partials/responder-list.html',
				controller: 'ResponderListCtrl'
			}).
			when('/responder/:id',  {
				templateUrl: 'lib/app/partials/responder-detail.html',
				controller: 'ResponderDetailCtrl'
			}).
			when('/message/:id',  {
				templateUrl: 'lib/app/partials/message-detail.html',
				controller: 'MessageDetailCtrl'
			}).
			otherwise({
				redirectTo: '/responder'
			});
	}]);