angular.module('photographService',[])
	.factory("Photograph",function($resource){
	return $resource("/api/photograph/:id",{id:'@id'},
	{
		'query':{method:'GET',isArray:false}
	});
});