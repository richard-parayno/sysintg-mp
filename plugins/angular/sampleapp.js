var app = angular.module('sampleapp', []); //jshint ignore:line
app.controller('MainController', function ($scope) {
    $scope.students = [],
    $scope.totalCount,
    $scope.ageArray = [],
    $scope.univCount = [],
    $scope.sorted = false,
    $scope.universities = ['ADMU', 'DLSU', 'LPU', 'MIT', 'STI', 'UP', 'UST'],
    $scope.studentsSubset = [],
    $scope.selectedUniv = [],
    $scope.temp = [];
    $scope.clearUniv = function clearUniv() {
        $scope.temp = $scope.selectedUniv;
        $scope.selectedUniv = [];
    },
    $scope.undoUniv = function clearUniv() {
        $scope.selectedUniv = $scope.temp;
    },
    $scope.toggleSelection = function toggleSelection(univ) {
        var idx = $scope.selectedUniv.indexOf(univ);
        if (idx > -1) {
            $scope.selectedUniv.splice(idx, 1);
        } else {
            $scope.selectedUniv.push(univ);
        }
        $scope.refreshArray();
    },
    $scope.refreshArray = function refreshArray() {
        $scope.studentsSubset = [];
        for (var x = 0; x < $scope.students.length; x++) {
            if ($scope.selectedUniv.length > 0) {
                for (var y = 0; y < $scope.selectedUniv.length; y++) {
                    if ($scope.students[x].university == $scope.selectedUniv[y]) {
                        $scope.studentsSubset.push($scope.students[x]);
                    }
                }
            } else {
                $scope.studentsSubset = $scope.students;
            }
        }
        var selectedAge = document.getElementById("ageSelect").options[document.getElementById("ageSelect").selectedIndex].value;
        if (selectedAge > 0) {
            var tempArray = [];
            for (var x = 0; x < $scope.studentsSubset.length; x++) {
                if ($scope.studentsSubset[x].age == selectedAge) {
                    tempArray.push($scope.studentsSubset[x]);
                }
            }
            $scope.studentsSubset = tempArray;
        }
    },
    $scope.sortByLastName = function sortByLastName() {
        if (!$scope.sorted) {
            $scope.students.sort(function (a, b) {
                if (a.lastName < b.lastName)
                    return -1;
                if (a.lastName > b.lastName)
                    return 1;
                return 0;
            });
            $scope.sorted = true;
        } else {
            $scope.students.reverse();
            $scope.sorted = false;
        }
        $scope.refreshArray();
    }
});