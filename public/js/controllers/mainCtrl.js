angular.module('mainCtrl',[])
    .controller('mainController',function($scope,$http,User){
        $scope.userData = {};

        $scope.loading = true;

        User.get()
            .success(function(data){
                $scope.users = data;
                $scope.loading = false;
            });

        $scope.submitUser = function(){
            $scope.loading = true;

            User.save($scope.userData)
                .success(function(data){
                    User.get()
                        .success(function(getData){
                            $scope.users = getData;
                            $scope.loading = false;
                        });
                })
                .error(function(data){
                    console.log(data);
                });
        };

        $scope.deleteUser = function(id){
            $scope.loading = true;

            User.destroy(id)
                .success(function(data){
                    User.get()
                        .success(function(getData){
                            $scope.users = getData;
                            $scope.loading = false;
                        });
                });
        };
    });