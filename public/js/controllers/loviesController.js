angular.module('loviesController',[])
    .controller('loviesController',function($scope,$http,$location,User){
        $scope.userData = {};
        $scope.loading = false;
        $scope.loggedin = false;

        $scope.checkauth = function(){
            User.checkauth()
                .success(function(data){
                    console.log(data);
                    if(data){                        
                        console.log(data);
                        $scope.loggedin = true;
                        console.log($scope.loggedin);
                    }
                })
        }

        $scope.checkauth();

        $scope.changeUserPage = function(){
            $scope.loading = true;
            $scope.getUsers($scope.page_limit, $scope.current_page);
        }

        $scope.getUsers = function(limit,page){
            $scope.loading = true;
            User.get(limit,page)
                .success(function(data){
                    console.log(data);
                    $scope.pages = data.paginator.total_pages;
                    $scope.current_page = data.paginator.current_page;
                    $scope.total_records = data.paginator.total_count;
                    $scope.page_limit = data.paginator.limit;
                    $scope.users = data.data;
                    $scope.loading = false;
                })
        }

        $scope.logoutUser = function(){
            $scope.loading = true;
            User.logout()
                .success(function(){
                    $scope.message = "Successfully logged out!";
                    $location.path("/");
                    $scope.loading = false;
                    $scope.checkauth();
                })
        }

        $scope.loginUser = function(){
            $scope.loading = true;
            User.login($scope.userData)
                .success(function(){
                    $location.path("/");
                    $scope.message = "Successfully logged in";
                    $scope.loading = false;
                    $scope.checkauth();
                })
                .error(function(data){
                    $scope.loading = false;
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                });
        };

        $scope.submitUser = function(){
            $scope.loading = true;
            User.save($scope.userData)
                .success(function(){
                    User.login($scope.userData)
                    .success(function(){
                        $scope.loading = false;
                        $scope.message = "User created";
                        $location.path("/");
                        $scope.checkauth();
                    })
                    .error(function(data){
                        $scope.loading = false;
                        $scope.error = true;
                        $scope.errorMessage = data.message;
                    });
                })
                .error(function(data){
                    $scope.loading = false;
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                });
        };

        $scope.deleteUser = function(id){
            $scope.loading = true;
            User.destroy(id)
                .success(function(data){
                    $scope.loading = false;
                    $scope.message = "User deleted";
                });
        };
    })