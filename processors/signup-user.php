<?php

session_start();
//include your dbconfig and helper files
require_once("../config/dbconfig.php");
require_once("../helper/helper.php");
require_once("../includes/nav.php");

$_SESSION['errors']= array();

//collect user data

if(isset ($_POST['register'])){
    //check for empty fields
   if(empty($_POST['username'])){
       $_SESSION['errors']['username']= "Username is required";
   } 
    if(empty($_POST['email'])){
       $_SESSION['errors']['email']= "Email is required";
   } 
    if(empty($_POST['password'])){
       $_SESSION['errors']['password']= "Password is required";
   } 
    if(empty($_POST['confirm_password'])){
       $_SESSION['errors']['confirm_password']= "Confirm your password";
   } 

    // filter and sanitize user inputs
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $password = mysqli_real_escape_string($db,$_POST['password']);
    $confirm_password = mysqli_real_escape_string($db,$_POST['confirm_password']);
    
    if(App\helper::checkPsw($password)){
        $_SESSION['errors']['passwordFailure'] = "Password should be minimum of 8 characters";
        header('Location:../auth/signup.php');
    }
    
    if(App\helper::checkEmail($email)){
        $_SESSION['errors']['invalidEmail'] = "Invalid email format";
        header('Location:../auth/signup.php');
    }
    
    if(App\helper::confirmPassword($password,$confirm_password)){
        $_SESSION['errors']['passwordMisMatch'] = "Password mismatch";
        header('Location:../auth/signup.php');
    }
    
    if(count($_SESSION['errors']) > 0){
        header('Location:../auth/signup.php');
    }
    //if no errors
    else{
        //check if user already exists
        $sql = "SELECT * from users where email = '$email'";
        $res = $db->query($sql);
        if($res->num_rows >= 1){
            $_SESSION['errors']['user']= "<script type= 'text/javascript'>
            alert('Registration was successful');
            </script>
            ";
            header('Location:../auth/signup.php');
            
        }else{
            //user does not exist
            //hash the user's password
            $role='user';
            $hashpassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            //insert into db
            $sql = "INSERT INTO users(username, email, password, role) VALUES('$username','$email','$hashpassword','$role')";
            //run msql query
            $res = mysqli_query($db, $sql);
            if($res){
                $_SESSION['reg_success'] = "<script type= 'text/javascript'>
                alert('Registration was successful');
                </script>
                ";
                header('Location:../auth/login.php');
            }else{
                $_SESSION['errors']['error']='Whoops, something went wrong';
                header('Location:../auth/signup.php');
            }
        }
    }
    
}else{
    //redirect the user back
    header('Location:../auth/signup.php');
}



?>