angular.module('usersController',[])
    .controller('usersController',function($scope,$http,$location,User){
        $scope.userData = {};

        $scope.logoutUser = function(){
            User.logout()
                .success(function(){
                    $scope.message = "Logged in!";
                    $location.path("/");
                })
        }

        $scope.loginUser = function(){
            User.login($scope.userData)
                .success(function(){
                    $location.path("/");
                })
                .error(function(data){
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                });
        };

        $scope.submitUser = function(){
            User.save($scope.userData)
                .success(function(){
                    User.login($scope.userData)
                    .success(function(){
                        $location.path("/");
                    })
                    .error(function(data){
                        $scope.error = true;
                        $scope.errorMessage = data.message;
                    });
                })
                .error(function(data){
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                });
        };

        $scope.deleteUser = function(id){
            User.destroy(id)
                .success(function(data){

                });
        };
    })