var responderControllers = angular.module('responderControllers', []);

responderControllers.controller('ResponderListCtrl', ['$scope', '$http', function($scope, $http){
		$http.get('api/responder/').success(function(data){
			$scope.responders = data;
		});
	}]);

responderControllers.controller('ResponderDetailCtrl', ['$scope', '$routeParams', '$http', function($scope, $routeParams, $http){
		$http.get('api/responder/' + $routeParams.id).success(function(data){
				$scope.responder = data;
			});
		$http.get('api/message/?responder_id=' + $routeParams.id).success(function(data){
				$scope.messages = data;
			});
	}]);

responderControllers.controller('MessageDetailCtrl', ['$scope', '$routeParams', '$http', function($scope, $routeParams, $http){
		$http.get('api/message/' + $routeParams.id).success(function(data){
				$scope.message = data;
			});
	}]);