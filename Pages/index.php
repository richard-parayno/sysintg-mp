<html>
    <head>
        <script src="http://www.google.com/jsapi" type="text/javascript"></script>
        <script type="text/javascript">
            google.load("jquery", "1.3.2");
        </script>
        <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="../plugins/angular/angular.js"></script>
        <script src="../plugins/angular/sampleapp.js"></script>
        <script src="../plugins/angular/complexcontroller.js"></script>
    </head>
    <body ng-app="sampleapp" ng-controller="MainController">
        <label>University:</label>
        <select ng-model="univswitch" ng-init="<?php
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
                                        else echo "], ";
                                        $ctr++;
                                 }
                            }
                            
                            require_once('../mysql_connect.php');
                            $query = "SELECT university, COUNT(university) as UNIVCOUNT
                                        FROM univdata
                                       GROUP BY UNIVERSITY;";
                            $result = mysqli_query($dbc,$query);
                            $ctr = 1;
                            if($result){
                                 echo '
                                        univCount=[';
                                 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    echo "{$row['UNIVCOUNT']}";
                                    if($ctr <= mysqli_num_rows($result) - 1) echo ", ";
                                    else echo "], ";
                                    $ctr++;
                                 }
                            }
                                               
                            require_once('../mysql_connect.php');
                            $query = "SELECT COUNT(university) as UNIVCOUNT
                                        FROM univdata;";
                            $result = mysqli_query($dbc,$query);
                            if($result){
                                 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    echo "
                                        totalCount={$row['UNIVCOUNT']}, ";
                                 }
                            }
                                               
                            require_once('../mysql_connect.php');
                            $query = "SELECT DATEDIFF(CURDATE(), birthday)DIV 365 AS AGE
                                        FROM univdata
                                       GROUP BY 1;";
                            $result = mysqli_query($dbc,$query);
                            $ctr = 1;
                            if($result){
                                 echo '
                                        ageArray=[';
                                 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                    echo "{$row['AGE']}";
                                    if($ctr <= mysqli_num_rows($result) - 1) echo ", ";
                                    else echo "]";
                                    $ctr++;
                                 }
                            }              
                         ?>">
            <option value="all">All</option>
            <option value="0">ADMU</option>
            <option value="1">DLSU</option>
            <option value="2">LPU</option>
            <option value="3">MIT</option>
            <option value="4">STI</option>
            <option value="5">UP</option>
            <option value="6">UST</option>
        </select>
        <label>Age: </label>
        <select name="age">
            <option ng-repeat="x in ageArray">{{x}}</option>
        </select><br>
        Total Students: {{totalCount}}
        Total Students in University: {{univcount[{{univswitch}}]}}
        <input type="checkbox">
    </body>
</html>