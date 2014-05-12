var loviesApp = angular.module('loviesApp',['loviesController','userService','ngRoute','ui.bootstrap']);

loviesApp.config(function($routeProvider){
    $routeProvider
        .when('/',{
            templateUrl : 'pages/home.html',
            controller : 'loviesController'
        })

        .when('/users',{
            templateUrl : 'pages/users.html',
            controller: 'loviesController'
        })

        .when('/register',{
            templateUrl : 'pages/userRegistration.html',
            controller : 'loviesController'
        })

        .when('/login',{
            templateUrl : 'pages/userLogin.html',
            controller : 'loviesController'
        })

        .when('/comments',{
            templateUrl : 'pages/comments.html',
            controller : 'loviesController'
        });
});