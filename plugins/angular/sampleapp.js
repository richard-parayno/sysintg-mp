var app = angular.module('sampleapp', []); //jshint ignore:line
app.controller('MainController', function ($scope) {
    $scope.students = [],
    $scope.totalCount,
    $scope.ageArray = [],
    $scope.univCount = [],
    $scope.universities = ['ADMU', 'DLSU', 'LPU', 'MIT', 'STI', 'UP', 'UST'],
    $scope.studentsSubset = [],
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
    
    $scope.refreshArray();
  },
    $scope.refreshArray = function refreshArray() {
        $scope.studentsSubset = [];
        for(var x = 0; x < $scope.students.length; x++){
            if($scope.selectedUniv.length !== null){
                for(var y = 0; y < $scope.selectedUniv.length; y++) {
                    if($scope.students[x].university == $scope.selectedUniv[y]){
                        $scope.studentsSubset.push($scope.students[x]);
                    }
                }                
            } else {
                $scope.studentsSubset = $scope.students;
            }
        }
    },
    $scope.refreshArray = function refreshArray(age) {
        for(var x = 0; x < $scope.studentsSubset.length; x++){
            if($scope.studentsSubset[x].age == age){
                $scope.studentsSubset.push($scope.students[x]);
            }
        }
    }
});