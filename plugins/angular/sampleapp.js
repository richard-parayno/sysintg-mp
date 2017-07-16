var app = angular.module('sampleapp', []); //jshint ignore:line
app.controller('MainController', function ($scope) {
    $scope.students = [],
    $scope.totalCount,
    $scope.ageArray = [],
    $scope.univCount = [],
    $scope.universities = ['ADMU', 'DLSU', 'LPU', 'MIT', 'STI', 'UP', 'UST'],
    $scope.selectedUniv = [],
    $scope.toggleSelection = function toggleSelection(univ) {
    var idx = $scope.selectedUniv.indexOf(univ);

    // Is currently selected
    if (idx > -1) {
      $scope.selectedUniv.splice(idx, 1);
    }

    // Is newly selected
    else {
      $scope.selectedUniv.push(univ);
    }
  }
})