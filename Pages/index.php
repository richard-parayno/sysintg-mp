<html>
    <head>
        <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="../plugins/angular/angular.js"></script>
        <script src="../plugins/angular/sampleapp.js"></script>
    </head>
    <body ng-app="sampleapp" ng-controller="MainController" ng-init="<?php
                            
                            require_once('../mysql_connect.php');
                            $query = "SELECT *, DATEDIFF(CURDATE(), birthday)DIV 365 AS age 
                                        FROM univdata;";
                            $result = mysqli_query($dbc,$query);
                            $ctr = 1;
                            if($result){
                                 echo 'students=[';
                                 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                        echo "
                                        {firstName:'{$row['name']}', ";
                                        echo "lastName:'{$row['surname']}', ";
                                        echo "birthday:'{$row['birthday']}', ";
                                        echo "university:'{$row['university']}', ";
                                        echo "age:'{$row['age']}'}";
                                        if($ctr <= mysqli_num_rows($result) - 1) echo ", ";
                                        else echo "]; ";
                                        $ctr++;
                                 }
                            };                      
                                                                     
                            require_once('../mysql_connect.php');
                            $query = "SELECT university, COUNT(university) as UNIVCOUNT
                                        FROM univdata
                                       GROUP BY UNIVERSITY;";
                            $result = mysqli_query($dbc,$query);
                            $ctr = 1;
                            if($result){
                                 echo ' univCount=[';
                                 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    echo "{$row['UNIVCOUNT']}";
                                    if($ctr <= mysqli_num_rows($result) - 1) echo ", ";
                                    else echo "]; ";
                                    $ctr++;
                                 }
                            };
                            
                            require_once('../mysql_connect.php');
                            $query = "SELECT COUNT(university) as UNIVCOUNT
                                        FROM univdata;";
                            $result = mysqli_query($dbc,$query);
                            if($result){
                                 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    echo " totalCount={$row['UNIVCOUNT']}; ";
                                 }
                            };
                                               
                            require_once('../mysql_connect.php');
                            $query = "SELECT DATEDIFF(CURDATE(), birthday)DIV 365 AS AGE
                                        FROM univdata
                                       GROUP BY 1;";
                            $result = mysqli_query($dbc,$query);
                            $ctr = 1;
                            if($result){
                                 echo ' ageArray=[';
                                 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    echo "{$row['AGE']}";
                                    if($ctr <= mysqli_num_rows($result) - 1) echo ", ";
                                    else echo "];";
                                    $ctr++;
                                 }
                            };
                         ?>">
        <label>University/ies:</label>
            <div>
            <form>
                <input name="univ" type="radio" value="all" ng-model="showUniv" checked>All (Total Students: <font color="red"><b>{{totalCount}}</b></font>)
                <input name="univ" type="radio" value="multi" ng-model="showUniv">Select University
            </form>
            </div>
            <div ng-show="showUniv == 'multi'" >
            <form>
                <label ng-repeat="univ in universities">
                    <input type="checkbox" name="selectedUnivs[]" value="{{univ}}" ng-click="toggleSelection(univ)"> {{univ}}
                </label>
                <br><br>
            </form>
            </div>
        <label>Age: </label>
        <select name="age">
            <option value="0">--</option>
            <option value="{{x}}" ng-repeat="x in ageArray">{{x}}</option>
        </select><br><br>
        <div>
            <table id="univtable" class="display" cellspacing="0" width="100%">
                <thead>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>University</th>
                </thead>
                <tbody>
                    <tr ng-repeat="x in students | filter : {'university' : {'LPU', 'DLSU'}}">
                        <td>{{x.lastName}}</td>
                        <td>{{x.firstName}}</td>
                        <td>{{x.birthday}}</td>
                        <td>{{x.age}}</td>
                        <td>{{x.university}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Birthday</th>
                    <th>Age</th>
                    <th>University</th>
                </tfoot>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $('#univtable').DataTable();
            } );
        </script>
    </body>
</html>