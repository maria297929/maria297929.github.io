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

  

        $result = $pdo -> prepare("SELECT * FROM admin_data WHERE email=?") ;
        $result -> execute([$email]);

        if ($result -> rowCount() === 1){
            $row = $result -> fetch(PDO::FETCH_ASSOC);
            if ($row['email'] === $email) {
                if(password_verify($password, $row['password'])){
                     $_SESSION['email'] = $row['email'];
                     $_SESSION['admin_id'] = $row['admin_id'];
                     header("Location: customers.php");
                      exit();
                }else{
                header("Location: admin.php?error-a=Incorect password.");
                exit();
                 } 
            }else{
            header("Location: admin.php?error-a=Incorect Email or password.");
            exit(); }
    }else{
        header("Location: admin.php?error-a=Email not registered as admin.");
        exit(); }
 } else{
    header("Location:admin.php");
    exit(); }
?>
