angular.module('userService',[])
    .factory('User',function($resource){
    return $resource("/api/user/:id",{id:'@id'},
    {
        'query':{method:'GET',isArray:false},
        'get':{method:'GET',isArray:false}
    });
});