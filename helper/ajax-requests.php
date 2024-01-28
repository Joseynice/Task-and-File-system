<?php
//require database connection
include_once('../config/dbconfig.php');

if(isset($_POST['name'])){
    
    $id = $_POST['id'];
    $sql = "SELECT * FROM task_lists WHERE id = '$id'";
    $res = $db->query($sql);
    while($row = mysqli_fetch_assoc($res)){
        $output= array('id' => $row['id'],
            'project_id' => $row['project_id'],
            'task' => $row['task'],
            'description' => $row['description'],
            'status' => $row['status'],  
            'date_created' => $row['date_craeted'],
            'category_id' => $row['category_id'], 
                      );
    }
    echo json_encode($output);
}

//make ajax call t0 fetch article info
$id = $_POST['id'];
$sql="SELECT * FROM category WHERE id = '$id'";
//run db query
$res = $db->query($sql);
while($row=mysqli_fetch_assoc($res)){
    $output = array('id' => $row['id'], 'category_name' => $row['category_name']);
}
echo json_encode($output);

?>