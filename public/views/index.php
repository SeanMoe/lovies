<!-- index.html -->
<!DOCTYPE html>
<html ng-app="loviesApp">
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-route.min.js"></script>
    <script src="js/controllers/mainCtrl.js"></script>
    <script src="js/controllers/usersController.js"></script>
    <script src="js/services/userService.js"></script>
    <script src="js/app.js"></script>
    <style>
        form 		{ padding-bottom:20px; }
        #main{
            width:75%;
            margin:auto;
        }
    </style>
</head>
<body ng-controller="mainController">

<!-- HEADER AND NAVBAR -->
<header>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Angular Routing Example</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="#register"><i class="fa fa-shield"></i> Register</a></li>
                <li><a href="#login"><i class="fa fa-shield"></i> Login</a></li>
                <li><a href="#" ng-controller="usersController" ng-click="logoutUser()"><i class="fa fa-shield"></i> Logout</a></li>
                <li><a href="#comments"><i class="fa fa-comment"></i> Comments</a></li>
            </ul>
        </div>
    </nav>
</header>

<!-- MAIN CONTENT AND INJECTED VIEWS -->
<div id="main">
    <div ng-view>

    </div>
    <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>
</div>


<!-- FOOTER -->
<footer class="text-center">
    Sean Ruel 2014
</footer>

</body>
</html>