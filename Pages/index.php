<html>
    <head>
        <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
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
                <input name="univ" type="radio" value="all" ng-model="showUniv" ng-click="refreshArray()" checked="checked">All (Total Students: <font color="red"><b>{{totalCount}}</b></font>)
                <input name="univ" type="radio" value="multi" ng-model="showUniv" ng-click="refreshArray()">Select University
            </form>
            </div>
            <div ng-show="showUniv == 'multi'" >
            <form>
                <label ng-repeat="univ in universities">
                    <input type="checkbox" name="selectedUnivs[]" value="{{univ}}" ng-click="toggleSelection(univ)"> {{univ}} <font color="red"><b>({{univCount[$index]}})</b></font>
                </label>
                <br><br>
            </form>
            </div>
        <label>Age: </label>
        <select name="age">
            <option value="0" ng-selected="refreshArray(-1)">--</option>
            <option value="{{x}}" ng-repeat="x in ageArray" ng-selected="refreshArray(x)">{{x}}</option>
        </select>
        <button>Sort by Last Name</button>
        <br><br>
        <div>
            <table id="univtable" class="display" border="2" cellspacing="0" width="100%" margin>
                <thead>
                    <th width="25%">Last Name</th>
                    <th width="25%">First Name</th>
                    <th width="20%">Birthday</th>
                    <th width="10%">Age</th>
                    <th width="20%">University</th>
                </thead>
                <tbody>
                    <tr ng-repeat="x in studentsSubset">
                        <td align="center">{{x.lastName}}</td>
                        <td align="center">{{x.firstName}}</td>
                        <td align="center">{{x.birthday}}</td>
                        <td align="center">{{x.age}}</td>
                        <td align="center">{{x.university}}</td>
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
    </body>
</html>