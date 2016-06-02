<!DOCTYPE html>
<html lang="en" ng-app="myApp">

  <head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
          <title>Questionaire / Survey</title>
            <link href="style/survey.css" rel="stylesheet"> 
            
              <link href="css/toaster.css" rel="stylesheet">

              </head>

  <body ng-cloak="">

      <div class="container" style="margin-top:20px;">

        <div data-ng-view="" id="ng-view" class="slide-animation"></div>

      </div>
    </body>
  <toaster-container toaster-options="{'time-out': 3000}"></toaster-container>
  <!-- Libs -->
  <script src="js/jquery-1.10.0.js"></script>
    <script src="app/globals.js"></script>
    
     
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/bootstrap.js"></script>


    
    
  <script src="js/angular.min.js"></script>
  <script src="js/angular-route.min.js"></script>
  <script src="js/angular-animate.min.js" ></script>
  <script src="js/toaster.js"></script>
  <script src="app/app.js"></script>
  <script src="app/data.js"></script>
  <script src="app/directives.js"></script>
  <script src="app/authCtrl.js"></script>
  
  

  <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>

 <!--  
	<link rel="stylesheet" 
	href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
	<script type="text/javascript" 
	src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<script src="https://datatables.net/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
    -->

	<link rel="stylesheet" 
	href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
	<script type="text/javascript" 
	src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

 <!-- <script src="js/dataTables.tableTools.js"></script> -->
 <!--  <script src="https://datatables.net/release-datatables/extensions/TableTools/js/dataTables.tableTools.js"></script> -->     
 

</html>

