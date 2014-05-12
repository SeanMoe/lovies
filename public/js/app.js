var loviesApp = angular.module('loviesApp',['mainCtrl','usersController','userService','ngRoute']);

loviesApp.config(function($routeProvider){
    $routeProvider
        .when('/',{
            templateUrl : 'pages/home.html',
            controller : 'mainController'
        })

        .when('/register',{
            templateUrl : 'pages/userRegistration.html',
            controller : 'usersController'
        })

        .when('/login',{
            templateUrl : 'pages/userLogin.html',
            controller : 'usersController'
        })

        .when('/comments',{
            templateUrl : 'pages/comments.html',
            controller : 'commentsController'
        });
});