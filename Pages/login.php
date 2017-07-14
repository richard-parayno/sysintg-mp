<?php
    session_start();
    require_once('../mysql_connect.php');
    $_SESSION['username'] = null;
    echo $_POST['username'];

    if (isset($_POST['submit'])){

        $message=NULL;

         if (empty($_POST['username'])){
             $_SESSION['username']=FALSE;
             $message.='<p>You forgot to enter your username!';
         } else {
             $_SESSION['username']=$_POST['username']; 
         }

         if (empty($_POST['password'])){
             $_SESSION['password']=FALSE;
             $message.='<p>You forgot to enter your password!';
         } else {
             $_SESSION['password']=$_POST['password']; 
         }

         if(!isset($message)) {
             require_once('../mysql_connect.php');
             $query = "SELECT * FROM users WHERE username = \"{$_POST['username']}\";";
             $result = mysqli_query($dbc, $query);
             while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                 if($row['password'] != $_POST['password']) {
                     $invalid = 1;   
                 }
                 else  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/index.php");
             }
         }
    }
?>
<html>

<head>

</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="username" placeholder="Username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">
        <input type="password" name="password" placeholder="Password">
        <?php 
            if (isset($message)){
                echo $message;
            }
        ?>
        <br>
        <button type="submit" name="submit">Sign in</button>
    </form>
</body>

</html>