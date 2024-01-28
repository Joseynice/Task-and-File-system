<?php

session_start();
require_once("../config/dbconfig.php");
require_once("../helper/helper.php");

$_SESSION['errors']= array();



if(isset($_POST['create_task'])){
    $query = "INSERT INTO task_list VALUES(null, $_POST[id], '$_POST[description]', '$_POST[start_date]', '$_POST[end_date]', 'Not Started')";

    $query_run = mysqli_query($db,$query);
    if($query_run){
        echo "<script type= 'text/javascript'>
        alert('Task Successfully Created');
        window.location.href = 'admin-dashboard.php';
        </script>
        ";

    }else{
        echo "<script type= 'text/javascript'>
        alert('An error occured please try again.');
        window.location.href = 'admin-dashboard.php';
        </script>
        ";
    }
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
    <h3>Create New Task</h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Select User:</label>
                    <select class="form-control" name="id">
                        <option>-Select-</option>
                        <?php
                    
                        $query = "select uid, username from users";
                        $query_run = mysqli_query($db,$query);
                        if(mysqli_num_rows($query_run)){
                        while($row = mysqli_fetch_assoc($query_run)){

                            ?>
                            <option value="<?php echo $row['uid']; ?>"><?php echo $row['username']; ?> </option>
                            <?php
                        }
                        
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label> Description:</label>
                    <textarea class="form-control" rows="3" cols="50" name="description" placeholder="Mention the task"></textarea>
                </div>

                <div class="form-group">
                    <label>Start Date:</label>
                    <input type="date" class="form-control" name="start_date" required>
                </div>
                <div class="form-group">
                    <label>End Date:</label>
                    <input type="date" class="form-control" name="end_date" required>
                </div>
                <br>
                <input type="submit" class="btn btn-warning" name="create_task" value="Create">
            </form>
    </div>
    </div>
                    
    


 <!--Jquerry files-->
 <script src="../assets/js/task.js"></script>
     <script src="../assets/js/bootstrap.min.js"></script>
   <script src="../assets/Plugins/fontawesome-free-6.4.0-web/js/all.min.js"></script> 
 
  
</body>
</html>