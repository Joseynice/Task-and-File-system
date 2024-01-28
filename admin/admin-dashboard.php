<?php
session_start();

include_once('../helper/helper.php');
include_once('../helper/functions.php');

error_reporting(0);
if(!isset($_SESSION['username'])){
    $_SESSION['error']= "You are not logged in";
    header('Location:../auth/login.php');
}
else if(isset($_SESSION['role']) != "admin"){
    $_SESSION['error'] = "Unauthorized Access";
    header('Location:../default/user-dashboard.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    
    <!--Boostrap files-->
    <link rel="stylesheet" href="../assets/Plugins/fontawesome-free-6.4.0-web/css/all.min.css"/> 
<link rel="stylesheet" href="../assets/css/bootstrap.min.css"/>

    <!--external css-->
    <link rel="stylesheet" href="../assets/css/user.css"/>
    <!--Jquery code
    <script type="text/javascript">
        $(document).ready(function(){
            $('#create_task').click(function(){
                $('#right-sidebar').load('create_task.php')
            });
        });
        </script>
        -->
</head>

<body style="background-color:lightblue;">
<!--Header-->
<header>
<div class="row" id="header-user">
    <div class="col-md-12">
        <div class="col-md-4" style="display: inline-block;">
            <h3>Admin Dashboard</h3>
        </div>
        <div class="col-md-6" style="display: inline-block; text-align: right;">
        <b> <i class="fa fa-user"></i>Email:</b> Admin@gmail.com
        <span style= "margin-left: 25px;"><b> Name: </b> Admin User</span>

        </div>
    </div>

</div>
</header>
<!--Side-bar--> 
<div class="row">
    <div class="col-md-2" id="left-sidebar">
       <table class="table">
        <tr>
            <td>
            <i class="fa fa-dashboard"></i>
                <a href="../admin/admin-dashboard.php" type="button" id="logout_link">Dashboard</a>
            </td>
            
        </tr>
        <tr>
            <td>
            <i class="fa fa-arrow-up"></i>
                <a href="../admin/create_task.php" id="create_task" type="button">Create Task</a>
            </td>
            
        </tr>
        <tr>
            <td>
            <i class="fa fa-file"></i>
                <a href="../admin/manage_task.php" type="button">Manage Task</a>
            </td>
            
        </tr>
        <tr>
            <td>
            <i class="fa fa-dashboard"></i>
                <a href="" type="button">Leave Applications</a>
            </td>
            
        </tr>
        <tr>
            <td>
            <i class="fa fa-dashboard"></i>
                <a href="" type="button">Leave Status</a>
            </td>
            
        </tr>
        <tr>
            <td>
            <i class="fa fa-user"></i>
                <a href="../auth/logout.php" type="button" id="logout_link">Logout</a>
            </td>
            
        </tr>
</table>
    </div>

    <div class="col-md-10" id="right-sidebar">
        <h4>Employee Instructions</h4>
        <ul style =" line-height:3em;font-size:1.2em;list-style-type:none;">
        <li>1. All employee should mark their attendance daily.</li>
        <li>2. All employee should mark their attendance daily.</li>
        <li>3. All employee should mark their attendance daily.</li>
        <li>4. All employee should mark their attendance daily.</li>
</ul>
    </div>
    
 
       <!--Jquerry files-->
       <script src="../assets/js/task.js"></script>
     <script src="../assets/js/bootstrap.min.js"></script>
   <script src="../assets/Plugins/fontawesome-free-6.4.0-web/js/all.min.js"></script> 
 
  
</body>
</html>




