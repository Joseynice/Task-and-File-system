<?php

session_start();
require_once("../config/dbconfig.php");
require_once("../helper/helper.php");
if(isset($_POST['edit_task'])){
    $query = "UPDATE task_list SET uid = $_POST[id], description = '$_POST[description]', start_date ='[start_date]', end_date = '[end_date]' where tid = $_GET[id]";
    $query_run = mysqli_query($db,$query);
    if($query_run){
        echo "<script type= 'text/javascript'>
        alert('Task Updated Successfully');
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

<div class="row" id="header-user">
    <div class="col-md-12">
        <h3><i class="fa fa-solid fa-list" style="padding-right:15px;"></i>Task Management System</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-4 m-auto" style="color:#000;"><br>
    <h3 style="color:#000;">Edit The Task</h3>
    <?php
    $query= "SELECT * FROM task_list WHERE tid = $_GET[id]";
    $query_run= mysqli_query($db,$query);
    while($row = mysqli_fetch_assoc($query_run)){
       
    ?>
    <form action="" method="POST">
        <div class="form-group">
            <input type="hidden" name="id" class="form-control" value="" required>
        </div>
        <div class="form-group">
                    <label>Select User:</label>
                    <select class="form-control" name="id" required>
                        <option>-Select-</option>
                        <?php
                    
                        $query1 = "select uid, username from users";
                        $query_run1 = mysqli_query($db,$query1);
                        if(mysqli_num_rows($query_run1)){
                        while($row1 = mysqli_fetch_assoc($query_run1)){

                            ?>
                            <option value="<?php echo $row1['uid']; ?>"><?php echo $row1['username']; ?> </option>
                            <?php
                        }
                        
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label> Description:</label>
                    <textarea class="form-control" rows="3" cols="50" name="description" required><?php echo $row['description'];?></textarea>
                </div>

                <div class="form-group">
                    <label>Start Date:</label>
                    <input type="date" class="form-control" name="start_date" required value=" <?php echo $row1['start_date'];?>">
                </div>
                <div class="form-group">
                    <label>End Date:</label>
                    <input type="date" class="form-control" name="end_date" required value=" <?php echo $row1['end_date'];?>">
                </div>
                <br>
                <input type="submit" class="btn btn-warning" name="edit_task" value="Update">
</form>

<?php
    } 
    ?>

    </div>
</div>










<!--Jquery files-->
<script src="../assets/js/task.js"></script>
     <script src="../assets/js/bootstrap.min.js"></script>
   <script src="../assets/Plugins/fontawesome-free-6.4.0-web/js/all.min.js"></script> 
 
  
</body>
</html>