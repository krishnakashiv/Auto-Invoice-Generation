<?php

include 'connect.php';


$cid=$_POST['cid'];
$chno=$_POST['chno']
$date=$_POST['date']
$oid=$_POST['oid']
    
    ?>

    <html>
    <head>
        
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        </head>
        <body>
            <div id="container">
    <div id="jumbotron">
            <div ng-app="dynamicApp" ng-controller="dynamicController" style="width:600px;"
                 ng-init="fetchData()">
                <table>
                <tr>
                    <th>Sr No.</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Remarks</th>
                    </tr>
                    <tr ng-repeat="name in namesData">
                        <td>{{$index +1}}</td>
                        <td>{{name.description}}</td>
                         <td>{{name.quantity}}</td>
                         <td>{{name.remarks}}</td>
                    </tr>
                </table>
            
            </div>
        </div>
                </div>
        </body>
        </html>
<script>
var app = angular.module('dynamicApp',[]);
    app.controller('dynamicController',function($scope,$http){
        $scope.fetchData = function(){
            $http.get('fetch_data.php') success(function(data)){
             $scope.namesData = data;                                   
                }
        };
    }
                  
                  );
</script>



















    