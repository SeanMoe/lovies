angular.module('authService',[])
	.factory('Auth',function($http){
		return {
            login : function(userData){
                return $http({
                    method:'POST',
                    url:'/api/login',
                    headers:{'Content-Type':'application/x-www-form-urlencoded'},
                    data: $.param(userData)
                });
            },

            logout : function(){
                return $http.get('/api/logout');
            }
		}
	});