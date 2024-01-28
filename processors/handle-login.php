<?php
session_start();
//require some files
include_once('../config/dbconfig.php');
include_once('../helper/helper.php');


//create an error message bag in form of an array


$_SESSION['errors']= array();
if(isset($_POST['login'])){
    if(empty($_POST['email'])){
        $_SESSION['errors']['email']= "Email is required";
    }
    if(empty($_POST['password'])){
        $_SESSION['errors']['password'] = "Password is required";
    }
    
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $password = mysqli_real_escape_string($db,$_POST['password']);
    
    if(App\helper::checkPsw($password)){
        $_SESSION['errors']['passwordFailure'] = "Password should be minimum of 8 characters";
        header('Location:../auth/login.php');
    }
    
    if(App\helper::checkEmail($email)){
        $_SESSION['errors']['invalidEmail'] = "Invalid email format";
        header('Location:../auth/login.php');
    }
    //if there is any error
    if(count($_SESSION['errors']) > 0){
        header('Location:../auth/login.php');
    }
    //if no errors
    else{
        //run db query
        $sql = "SELECT * from users where email = '$email'";
        $res = $db->query($sql);
        if(mysqli_num_rows($res) > 0){
            $row = mysqli_fetch_assoc($res);
          if(password_verify($password, $row['password'])){
                $_SESSION['role']= $row['role'];
                //check if the logged in user is an admin, author or just a user
                if($_SESSION['role'] =='user'){
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['username']= $row['username'];
                    $_SESSION['email']= $row['email'];
                    $_SESSION['uid']= $row['uid'];
                    $_SESSION['info']= "You have successfully logged in";
                    header('Location:../default/user-dashboard.php');
                }
                else if($_SESSION['role'] == "admin"){
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['username']= $row['username'];
                    $_SESSION['email']= $row['email'];
                    $_SESSION['uid']= $row['uid'];
                    $_SESSION['info']= "You have successfully logged in";
                    header('Location:../admin/admin-dashboard.php');
                }           
            }else{
                $_SESSION['errors']['invalidPassword'] ="<script type= 'text/javascript'>
                alert('Invalid Password');
                </script>
                ";
                header('Location:../auth/login.php');
            }
        }
        else{
            $_SESSION['errors']['emailNotExist'] = "<script type= 'text/javascript'>
            alert('Email does not exist');
            </script>
            ";
            header('Location:../auth/login.php');
        }
    }
}else{
    $_SESSION['errors']['invalidRequest'] = "<script type= 'text/javascript'>
    alert('Something Went Wrong or you are a scammer');
    </script>
    ";
    header('Location:../auth/login.php');
}
?>