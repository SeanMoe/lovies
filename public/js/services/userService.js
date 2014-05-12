angular.module('userService',[])
    .factory('User',function($http,$location){
        return {
            getUser: function(id,limit){
                limit = limit || 3;
                return $http.get('/api/user/'+id+'?limit='+limit);
            },

            get: function(limit,page) {
                limit = limit || 3;
                page = page || 1;
                return $http.get('/api/user?limit='+limit+'&page='+page);
            },

            save : function(userData){
                return $http({
                    method:'POST',
                    url:'/api/user',
                    headers:{'Content-Type':'application/x-www-form-urlencoded'},
                    data: $.param(userData)
                });
            },

            destroy : function(id){
                return $http.delete('/api/user/'+id);
            },

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