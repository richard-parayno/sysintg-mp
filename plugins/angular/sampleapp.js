var app = angular.module('sampleapp', ['ngRoute']); //jshint ignore:line
app.controller('MainController', ['$scope', function ($scope) {
    "use strict";

    $scope.students = [],
    $scope.totalCount,
    $scope.univCount = [],
    $scope.toggle = function () {
        $scope.isToggled = !$scope.isToggled;
    }
}]);