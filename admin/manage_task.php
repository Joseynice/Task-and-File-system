<?php

session_start();
require_once("../config/dbconfig.php");
require_once("../helper/helper.php");

$_SESSION['errors']= array();

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
                <a href="" type="button" id="logout_link">Logout</a>
            </td>
            
        </tr>
</table>
    </div>


    
    <div class="col-md-6" id="right-sidebar">
       <center><h3>All Assigned Tasks</h3></center><br>
       <table class="table" style="background-color:whitesmoke; width:75vw;">
        <tr>
            <th>S/N</th>
            <th>Task ID</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Action</th>
    
          <?php 
          $sno=1;
          $query= "SELECT * FROM task_list";
          $query_run= mysqli_query($db,$query);
          while($row = mysqli_fetch_assoc($query_run)){
            ?>
            <tr>
            <td><?php echo $sno; ?></td>
            <td><?php echo $row['tid']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><a href="../admin/edit_task.php?id=<?php echo $row['tid']; ?>">Edit</a>|<a href="../admin/delete_task.php?id=<?php echo $row['tid']; ?>">Delete</a>
          </tr>
            <?php
            $sno = $sno+1;
          }  
         ?>
         </table>
    </div>
                    
    


 <!--Jquerry files-->
 <script src="../assets/js/task.js"></script>
     <script src="../assets/js/bootstrap.min.js"></script>
   <script src="../assets/Plugins/fontawesome-free-6.4.0-web/js/all.min.js"></script> 
 
  
</body>
</html>