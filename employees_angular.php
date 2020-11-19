<?php

include 'page_top.php';

?>
        <style>
            table, th, td {
                border: 1px solid grey;
                border-collapse: collapse;
                padding: 5px;
            }
            table tr:nth-child(odd) {
                background-color: #f1f1f1;
            }
            table tr:nth-child(even) {
                background-color: #ffffff;
            }
        </style>
        

        <h3>Classic Models Employee List (Angular.js)</h3>
        <div ng-app="myApp" ng-controller="customersCtrl">

            <table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Ext</th>
                    <th>Email</th>
                    <th>Off.Code</th>
                    <th>Reports To</th>
                    <th>Title</th>
                </tr>
                <tr ng-repeat="x in names">
                    <td>{{ x.ID}}</td>
                    <td>{{ x.FName}}</td>
                    <td>{{ x.LName}}</td>
                    <td>{{ x.Ext}}</td>
                    <td>{{ x.Email}}</td>
                    <td>{{ x.OffCode}}</td>
                    <td>{{ x.ReportsTo}}</td>
                    <td>{{ x.JobTitle}}</td>
                </tr>
            </table>

        </div>

        <script>
            var app = angular.module('myApp', []);
            app.controller('customersCtrl', function ($scope, $http) {
                $http.get("employees_mysql.php")
                        .then(function (response) {
                            $scope.names = response.data.records;
                        });
            });
        </script>
    </body>
</html>
