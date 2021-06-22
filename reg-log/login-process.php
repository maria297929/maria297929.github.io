<?php 
session_start();
include "../includes/db.php";
if (isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
        $result = $pdo -> prepare("SELECT * FROM users WHERE email=?") ;
        $result -> execute([$_POST['email']]);
        if ($result -> rowCount() === 1){
            $row = $result -> fetch(PDO::FETCH_ASSOC);
            if ($row['email'] === $email) {
                if(password_verify($password, $row['password'])){
                     $_SESSION['email'] = $row['email'];
                     $_SESSION['name'] = $row['user_name'];
                     $_SESSION['user_id'] = $row['user_id'];
                     header("Location: ../shop.php");
                      exit();
                }
                else{
                header("Location: ../login.php?error-l=Incorect password.");
                exit();} 
            }else{
            header("Location: ../login.php?error-l=Incorect Email and password.");
            exit();}
    }else{
        header("Location: ../login.php?error-l=Email not found, please create a new account.");
        exit();}
 } else{
    header("Location: ../login.php");
    exit(); }
