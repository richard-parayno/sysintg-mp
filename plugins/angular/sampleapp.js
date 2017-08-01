var app = angular.module('sampleapp', []); //jshint ignore:line
app.controller('MainController', function ($scope) {
    $scope.students = [],
    $scope.totalCount,
    $scope.ageArrayF = [],
    $scope.ageArrayT = [],
    $scope.univCount = [],
    $scope.sortedL = false,
    $scope.sortedF = false,
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
        var selectedAgeF = document.getElementById("ageSelectF").options[document.getElementById("ageSelectF").selectedIndex].value; 
        var selectedAgeT = document.getElementById("ageSelectT").options[document.getElementById("ageSelectT").selectedIndex].value;
        if (selectedAgeF > 0) {
            var tempArray = [];
            for (var x = 0; x < $scope.studentsSubset.length; x++) {
                if ($scope.studentsSubset[x].age >= selectedAgeF && $scope.studentsSubset[x].age <= selectedAgeT) {
                    tempArray.push($scope.studentsSubset[x]);
                }
            }
            $scope.studentsSubset = tempArray;
        }
        if($scope.studentsSubset.length == 0){
            $scope.studentsSubset.push({"firstName":"No Data Match","lastName":"No Data Match","birthday":"No Data Match","university":"No Data Match","age":"No Data Match"});
        }
    },
    $scope.sortByLastName = function sortByLastName() {
        if (!$scope.sortedL) {
            $scope.students.sort(function (a, b) {
                if (a.lastName < b.lastName)
                    return -1;
                if (a.lastName > b.lastName)
                    return 1;
                return 0;
            });
            $scope.sortedL = true;
        } else {
            $scope.students.reverse();
            $scope.sortedL = false;
        }
        $scope.refreshArray();
    },
    $scope.sortByFirstName = function sortByFirstName() {
    if (!$scope.sortedF) {
        $scope.students.sort(function (a, b) {
            if (a.firstName < b.firstName)
                return -1;
            if (a.firstName > b.firstName)
                return 1;
            return 0;
        });
        $scope.sortedF = true;
    } else {
        $scope.students.reverse();
        $scope.sortedF = false;
    }
    $scope.refreshArray();
    },
    $scope.refreshAgeT = function refreshAgeT() {
        $scope.ageArrayT = [];
        var selectedAgeF = document.getElementById("ageSelectF").options[document.getElementById("ageSelectF").selectedIndex].value;
        for(var x = 0; x < $scope.ageArrayF.length; x++){            
            if($scope.ageArrayF[x] >= selectedAgeF ) {
                $scope.ageArrayT.push($scope.ageArrayF[x]);
            };
        };   
    }
});