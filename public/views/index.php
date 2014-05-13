<!-- index.html -->
<!DOCTYPE html>
<html ng-app="loviesApp">
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" />

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-route.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-resource.min.js"></script>
    <script src="js/ui-bootstrap-tpls-0.11.0.min.js"></script>
    <script src="js/controllers/loviesController.js"></script>
    <script src="js/services/userService.js"></script>
    <script src="js/services/authService.js"></script>
    <script src="js/services/photographService.js"></script>
    <script src="js/app.js"></script>
    <style>
        .nav, .pagination, .carousel, .panel-title a { cursor: pointer; }
        form 		{ padding-bottom:20px; }
        #main{
            width:75%;
            margin:auto;
        }
    </style>
</head>
<body ng-controller="loviesController">
<!-- HEADER AND NAVBAR -->
<header>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Lovies</a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li ng-hide="auth.loggedin"><a href="#register"><i class="fa fa-shield"></i> Register</a></li>
                <li ng-hide="auth.loggedin"><a href="#login"><i class="fa fa-shield"></i> Login</a></li>
                <li ng-show="auth.loggedin"><a href="#photographs"><i class="fa fa-camera-retro"></i> Recent Photographs</a></li>
                <li ng-show="auth.loggedin"><a href="#photographs/upload"><i class="fa fa-arrow-up"></i> Upload Photograph</a></li>
                <li ng-show="auth.loggedin"><a ng-href="#here" ng-click="logoutUser()"><i class="fa fa-shield"></i> Logout</a></li>
            </ul>
        </div>
    </nav>
</header>

<!-- MAIN CONTENT AND INJECTED VIEWS -->
<div id="main">
    <div ng-view>

    </div>
</div>


<!-- FOOTER -->
<footer class="text-center">
    Lovies 2014
</footer>

</body>
</html>