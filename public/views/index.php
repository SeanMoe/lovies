<!doctype html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lovies Users</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> <!-- load fontawesome -->
    <style>
        body 		{ padding-top:30px; }
        form 		{ padding-bottom:20px; }
        .comment 	{ padding-bottom:20px; }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
    <!-- ANGULAR -->
    <!-- all angular resources will be loaded from the /public folder -->
    <script src="js/controllers/mainCtrl.js"></script> <!-- load our controller -->
    <script src="js/services/userService.js"></script> <!-- load our service -->
    <script src="js/app.js"></script> <!-- load our application -->
</head>
<body class="container" ng-app="userApp" ng-controller="mainController">
    <div class="col-md-8 col-md-offset-2">
        <div class="page-header">
            <h2>Register</h2>
        </div>
        <form ng-submit="submitUser()">
            <div class="form-group">
                <input type="email" class="form-control input-sm" name="email" ng-model="userData.email" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control input-sm" name="password" ng-model="userData.password" placeholder="Password">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </form>
        <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>
    </div>
</body>
    </html>