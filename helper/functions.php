<!--19/03/2021-->
<?php
include_once('../config/dbconfig.php');

//get total users
function getAllUsers($db){
$allUsers = "SELECT * FROM users";

$allUsersRes = $db->query($allUsers);

$count = mysqli_num_rows($allUsersRes);

return $count;
}

//get active users
function getActiveUsers($db){
$allUsers = "SELECT * FROM users where status = 'active'";

$allUsersRes = $db->query($allUsers);

$count = mysqli_num_rows($allUsersRes);

return $count;
}



//get banned users
function getBannedUsers($db){
$allUsers = "SELECT * FROM users where status = 'banned'";

$allUsersRes = $db->query($allUsers);

$count = mysqli_num_rows($allUsersRes);

return $count;
}



//get all categories
function getCategories($db){
$allCategories = "SELECT * FROM category";

$allCategoriesRes = $db->query($allCategories);

$count = mysqli_num_rows($allCategoriesRes);

return number_format($count);
}


//get all properties
function getProperties($db){
	
$allProp = "SELECT * FROM properties";

$allPropRes = $db->query($allProp);

$count = mysqli_num_rows($allPropRes);

return number_format($count);
}


function createCategory($db){
	$_SESSION['errors'] = array();
	
	if(isset($_POST['create-category'])){
		if(empty($_POST['category_name'])){
			$_SESSION['errors']['category_name'] = "Category name is required";
			
		}else{
//			check if category already exists
			
			
			$category = $_POST['category_name'];
			$sql = "SELECT * from category where category_name = '$category'";
			$res = $db->query($sql);
			$count = mysqli_num_rows($res);
			if($count > 0){
				$_SESSION['errors']['name_exist'] = 'Sorry, category name already exist';
				header('Location:../admin/create-category.php');
			}else{
//				proceed to insert db
				$sql = "INSERT INTO category (category_name)VALUES('$category')";
//				run mysql query
				$res = mysqli_query($db,$sql);
				if($res){
					$_SESSION['success'] = 'category ' .$category.' has been created';
					header('Location:../admin/create-category.php');
				}
				else{
					$_SESSION['errors']['error'] = 'Whoops, something went wrong';
					header('Location:../admin/create-category.php');
				}
			}
		}
	}
	else{
		$_SESSION['errors']['error'] ='Unauthorised';
		header('Location:../admin/create-category.php');
	}
}

//get all category
function getCategory($db){
    $sql= "SELECT * FROM category ORDER BY id ASC";
    $res = $db->query($sql);
    return $res;
}

function editCategory($db){
    $id= $_POST['id'];
    $_SESSION['errors'] = array();
	
	if(isset($_POST['edit-category'])){
		if(empty($_POST['category_name'])){
			$_SESSION['errors']['category_name'] = "Category name is required";
			
		}else{
            //edit category
            $category_name= $_POST['category_name'];
            $sql = "UPDATE category SET category_name = '$category_name' WHERE id = '$id'";
            //run db query
            $res = $db->query($sql);
            $affected_rows = $db->affected_rows;
            //if there was an update
            if($affected_rows > 0){
                $_SESSION['success']= "Category has been edited successfully";
                header('Location:../admin/create-category.php');
            }else{
              $_SESSION['errors']['error']="Whoops, something went wrong";
                header('Location:../admin/create-category.php');
            }
        
}
    }else{
            $_SESSION['errors']['error']="Unauthorized access";
                header('Location:../admin/create-category.php');
                
            }
}

function deleteCategory($db){
    $id= $_POST['id'];
    $_SESSION['errors'] = array();
    if(isset($_POST['delete-category'])){
    $sql= "DELETE FROM category WHERE id = '$id'";
        $res = $db->query($sql);
            $affected_rows = $db->affected_rows;
            
            //if there was a delete
            if($affected_rows > 0){
                $_SESSION['success']= "Category has been deleted successfully";
                header('Location:../admin/create-category.php');
            }else{
              $_SESSION['errors']['error']="Whoops, something went wrong";
                header('Location:../admin/create-category.php');
            }
}else{
        $_SESSION['errors']['error']="Unauthorized access";
                header('Location:../admin/create-category.php');
    }

}


function storeImage($file){
     $_SESSION['errors'] = array();
    //handle file upload
    $target_folder_dir = "../assets/properties/";
    $target_file = $target_folder_dir.basename($_FILES["property_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    //check if file already exists
    if(file_exists($target_file)){
        $_SESSION['errors']['exists'] ='Image already exists';
        header('Location:../admin/add-property.php');
    }
    //check file size
    else if($_FILES["property_image"]["size"] > 30000000){
        $_SESSION['errors']['big'] ='Image size is too big';
          header('Location:../admin/add-property.php');
        
    }
    //check for file formats
    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg"){
       $_SESSION['errors']['format'] ='Image format not allowed';
         header('Location:../admin/add-property.php');
        
    }
    if(count($_SESSION['errors']) > 0){
         
         header('Location:../admin/add-property.php');
       
         }else{
       $path = move_uploaded_file($_FILES["property_image"]["tmp_name"], $target_file);
        
        return $path;
    
}

}

//insert property

function insertProperty($db){
    $_SESSION['errors'] = array();
    
    if(isset($_POST['add-property'])){
        if(empty($_POST['property_title'])){
        $_SESSION['errors']['property_title'] = "Name of property is required";
       
          }
        
        if(empty($_POST['property_description'])){
        $_SESSION['errors']['property_description'] = "Property description is required";
       }
        
        if(empty($_POST['property_address'])){
        $_SESSION['errors']['property_address'] = "Property address is required";
       }
       if(empty($_POST['property_price'])){
        $_SESSION['errors']['property_price'] = "Property price is required";
       }
        if(empty($_POST['property_state'])){
        $_SESSION['errors']['property_state'] = "Property state is required";
       }
        
         //  filter and sanitize user inputs
    
      $property_title = mysqli_real_escape_string($db,$_POST['property_title']);
      $property_price = mysqli_real_escape_string($db,$_POST['property_price']);
        
      $category_id = mysqli_real_escape_string($db,$_POST['category_id']);
        $user_id = $_SESSION['id'];
   
     $property_description = mysqli_real_escape_string($db,$_POST['property_description']);
      $property_address = mysqli_real_escape_string($db,$_POST['property_address']);
     $property_state = mysqli_real_escape_string($db,$_POST['property_state']);
        
    //generate random article id
      $property_id = mt_rand(100000,999999);
       $target_folder_dir = "../assets/properties/";
    $target_file = $target_folder_dir.basename($_FILES["property_image"]["name"]);
      if(storeImage($target_file)){
          //proceed to insert other fields into db
            $sql = "INSERT INTO properties (user_id,property_title,property_description,property_id,property_image,property_price,category_id,property_address,property_state)VALUES('$user_id','$property_title','$property_description','$property_id','$target_file','$property_price','$category_id','$property_address','$property_state')";
            
            $res =$db->query($sql);
                
                if($res){
                $_SESSION['success'] ='Property has been added to the database';
          header('Location:../admin/add-property.php');
            }
           else{
               $_SESSION['errors']['error'] ='Could not insert property into the database';
          header('Location:../admin/add-property.php');
               
           }
          
          
      }
           
        
}else{
        $_SESSION['errors']['unauthorized'] = "Unauthorized access";
        header("Location:../admin/add-property.php");
    }
}


function getAllProperties($db){
    $sql = "SELECT * FROM properties";
    $res = $db->query($sql);
    return $res;  
    
}



function featureProperty($db){
    if(isset($_POST['feature-properties'])){
        $id = $_POST['id'];
        $sql= "UPDATE properties SET property_status = 'Featured' WHERE id ='$id'";
       $res= $db->query($sql);
        $affected_rows  = $db->affected_rows;
        //if there is any delection 
        if($affected_rows > 0){
            $_SESSION['success'] = "Property has been featured";
            header('Location:../admin/property.php');
        }else{
            $_SESSION['errors']['error'] = "Whoops, something went wrong";
            header('Location:../admin/property.php');
            
        }
        
    }else{
        $_SESSION['errors']['unauthorized'] = "Unauthorized access";
        header("Location:../admin/add-property.php");
    }
}


function disableProperty($db){
    if(isset($_POST['disable-properties'])){
        $id = $_POST['id'];
        $sql= "UPDATE properties SET property_status = 'Disabled' WHERE id ='$id'";
        $res= $db->query($sql);
        $affected_rows  = $db->affected_rows;
        //if there is any delection 
        if($affected_rows > 0){
            $_SESSION['success'] = "Property has been disabled";
            header('Location:../admin/property.php');
        }else{
            $_SESSION['errors']['error'] = "Whoops, something went wrong";
            header('Location:../admin/property.php');
            
        }
        
    }else{
        $_SESSION['errors']['unauthorized'] = "Unauthorized access";
        header("Location:../admin/property.php");
    }
}

function deleteProperty($db){
    if(isset($_POST['delete-property'])){
         $id = $_POST['id'];
        $sql= "DELETE FROM properties WHERE id = '$id'";
        $res = $db->query($sql);
            $affected_rows = $db->affected_rows;
            
            //if there was a delete
            if($affected_rows > 0){
                $_SESSION['success']= "Property has been deleted successfully";
                header('Location:../admin/property.php');
            }else{
              $_SESSION['errors']['error']="Whoops, something went wrong";
                header('Location:../admin/property.php');
            }
    }else{
        $_SESSION['errors']['unauthorized'] = "Unauthorized access";
        header("Location:../admin/property.php");
    }
}


function editProperty($db){
    $id= $_POST['id'];
    $_SESSION['errors'] = array();
    if(isset($_POST['edit-property'])){
        if(empty($_POST['property_title'])){
        $_SESSION['errors']['property_title'] = "Name of property is required";
       
          }
        
        if(empty($_POST['property_description'])){
        $_SESSION['errors']['property_description'] = "Property description is required";
       }
        
        if(empty($_POST['property_address'])){
        $_SESSION['errors']['property_address'] = "Property address is required";
       }
       if(empty($_POST['property_price'])){
        $_SESSION['errors']['property_price'] = "Property price is required";
       }
        if(empty($_POST['property_state'])){
        $_SESSION['errors']['property_state'] = "Property state is required";
       }
        
         //  filter and sanitize user inputs
    
      $property_title = mysqli_real_escape_string($db,$_POST['property_title']);
      $property_price = mysqli_real_escape_string($db,$_POST['property_price']); 
     $property_description = mysqli_real_escape_string($db,$_POST['property_description']);
      $property_address = mysqli_real_escape_string($db,$_POST['property_address']);
     $property_state = mysqli_real_escape_string($db,$_POST['property_state']);
        
    //generate random article id
      $property_id = mt_rand(100000,999999);
       
        
        $target_folder_dir = "../assets/properties/";
    $target_file = $target_folder_dir.basename($_FILES["property_image"]["name"]);
      if(storeImage($target_file)){
          //proceed to insert other fields into db
            $sql = "UPDATE properties SET property_title = '$property_title', property_description= '$property_description', property_price = '$property_price', property_address = '$property_address', property_state = '$property_state', property_image = '$target_file'  WHERE id = '$id'";
            
            $res =$db->query($sql);
                
                if($res){
                $_SESSION['success'] ='Property has been edited successfully';
          header('Location:../admin/add-property.php');
            }
           else{
               $_SESSION['errors']['error'] ='Could not insert property into the database';
          header('Location:../admin/add-property.php');
               
           }
          
          
      }
        
      
         
        
}else{
        $_SESSION['errors']['unauthorized'] = "Unauthorized access";
        header("Location:../admin/add-property.php");
    }
}

    
    




?>