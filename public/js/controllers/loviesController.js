angular.module('loviesController',[])
    .controller('loviesController',function($scope,$http,$location,$routeParams,$window,User,Photograph,Auth){
        $scope.userData = {};
        $scope.loading = false;
        $scope.auth = Auth;
        if ($window.sessionStorage.token) {
            $scope.auth.loggedin = true;
        } else {
            $scope.auth.loggedin = false;
        }
        
        $scope.getPhotographs = function(limit,page){
            $scope.photographs = Photograph.query({limit:limit,page:page});
            $scope.loading = false;
        }

        $scope.getPhotograph = function(id){
            $scope.photograph = Photograph.get({'id':id});
            $scope.loading = false;
        }

        $scope.deletePhotograph = function(id){
            Photograph.delete({},{'id':id});
            $scope.loading = false;
        }

        $scope.changePhotographPage = function(){
            $scope.loading=true;
            $scope.getPhotographs($scope.photographs.paginator.limit,$scope.photographs.paginator.current_page);
        }

        $scope.changeUserPage = function(){
            $scope.loading = true;
            $scope.getUsers($scope.users.paginator.limit, $scope.users.paginator.current_page);
        }

        $scope.getUsers = function(limit,page){
            $scope.users = User.query({limit:limit,page:page});
            $scope.loading = false;
        }

        $scope.deleteUser = function(id){
            User.delete({},{'id':id});
            $scope.loading = false;
        }

        $scope.getUser = function(id){
           $scope.user = User.get({'id':id});
           $scope.loading = false;
        }

        $scope.getUserPage = function(){
            $scope.user = User.get({'id':$routeParams.userId});
            $scope.loading = false;
        }

        $scope.loginUser = function(){
            $scope.loading = true;
            Auth.login($scope.userData)
                .success(function(data){
                    $scope.loading = false;
                    $window.sessionStorage.token = data.token;
                    $scope.auth.loggedin = true;
                    $scope.message = "Successfully logged in";
                    $location.path("/");
                })
                .error(function(data){
                    $scope.loading = false;
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                    delete $window.sessionStorage.token;
                    $scope.auth.loggedin = false;
                });
        };

        $scope.logoutUser = function(){
            $scope.auth = Auth;
            $scope.loading = true;
            Auth.logout()
            $scope.message = "Successfully logged out!";
            $scope.auth.loggedin = false;
            delete $window.sessionStorage.token;
            $location.path("/");
        }
    })