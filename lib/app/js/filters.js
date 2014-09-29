angular.module('responderFilters', []).filter('active', function(){
	return function(input){
		return input ? 'active' : 'inactive';
	};
});