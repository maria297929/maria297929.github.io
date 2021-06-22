<?php
session_start();
include "../includes/db.php";

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['fname']) && isset($_POST['lname'])){
   
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
   

    $user_data = 'email='. $email. '$fname='. $fname. '$lname='.$lname;

    


    $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $pdo -> query($sql);

    if ($result -> rowCount() > 0){
        header("Location: ../login.php?error=The username is taken try another&$user_data");
        exit();
    }else {
       $sql2 = "INSERT INTO users(fname,lname,email, password) VALUES('$fname','$lname','$email', '$password')";
       $result2 = $pdo -> query($sql2);
       if ($result2) {
            header("Location: ../login.php?success=Your account has been created successfully");
         exit();
       }
       else {
               header("Location: ../login.php?error=unknown error occurred&$user_data");
            exit();
       }
    }
  }
else{
header("Location: ../login.php");
exit();
}