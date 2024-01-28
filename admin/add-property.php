<?php
session_start();
include_once('../helper/functions.php');
include_once('../includes/admin-head.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset ($_POST['add-property'])){
        insertProperty($db);
    }
}
?>   




		
<body class="hold-transition sidebar-mini">
   <!--preloader
      <div id="preloader">
         <div id="status"></div>
      </div>
      -->
      <!-- Site wrapper -->
      <div class="wrapper">
         <?php
				include_once('../includes/admin-header.php');
				?>
    
				<!-- =============================================== -->
         <!-- Left side column. contains the sidebar -->
         <?php
				include_once('../includes/admin-sidebar.php');
				?>
 <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-shopping-basket"></i>
               </div>
               <div class="header-title">
                  <h1>ADD PROPERTIES</h1>
                  <small>Add properties below!</small>
               </div>
            </section>
            <!-- Main content -->
              <?php if(isset($_SESSION['success'])): ?>
                <ul class="error-msg">
                <li class="alert alert-success alert-dismissable " data-dismiss="alert">&times; <?php echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </li>
                </ul> 
                  
    
                   
                <?php endif;
                   

                   ?>
                
                
                
                <?php if(isset($_SESSION['errors'])) :?>
                <?php foreach($_SESSION['errors'] as $err => $errMsg) : ?>
                      <ul class="error-msg">
                    <li class="alert alert-danger alert-dismissable " data-dismiss="alert">&times; <?php echo $errMsg; ?>
                        </li>
                      </ul> 
                        <?php endforeach; 
                     unset($_SESSION['errors']);
                   ?>  
                 
                        <?php endif; 
                  


                   
                ?>
             
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel lobidisable panel-bd">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Add Properties</h4>
                           </div>
                        </div>
                        <div class="panel-body">
<!--													19/03/21-->
                           <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                              
                           
                              <div class="form-group">
                                 <label>Property Name</label>
                                 <input type="text" class="form-control" placeholder="Enter property title"  name="property_title">
                              </div>
                               
                                 <div class="form-group">
                            <label>Property Category</label>
                                <?php $rows =  getCategory($db);?>
                                <select name="category_id" class="form-control">
                                <option value="">Choose property category</option>
                                <?php while($row = mysqli_fetch_assoc($rows)): ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                                <?php endwhile; ?>
                                </select>
                              </div>
                               
                               
                               
                               <div class="form-group">
                                 <label>Property Description</label>
                                   <textarea  class="form-control" placeholder="Enter property description"  name="property_description"></textarea>
                              </div>
                               
                               
                                <div class="form-group">
                                 <label>Property Price</label>
                                   <input  class="form-control" placeholder="Enter property price"  name="property_price" type="text">
                              </div>
                               
                               <div class="form-group">
                                 <label>Property Address</label>
                                   <input  class="form-control" placeholder="Enter property address/location"  name="property_address" type="text">
                              </div>
                               
                               
                               <div class="form-group">
                                 <label>Property State</label>
                                   <input  class="form-control" placeholder="Enter property state"  name="property_state" type="text">
                              </div>
                               
                               
                               <div class="form-group">
                                <img src="../assets/img/bungalow/03fb3d7d4b07d39ced3d0d7693395831.jpg" alt="img-placeholder" height="240"   id="display_image" />
                                   <br />
                                 <label>Property Photo</label>
                                   <input  class="form-control"   name="property_image" type="file" onchange="document.getElementById('display_image').src = window.URL.createObjectURL(this.files[0])"  >
                              </div>
                               
                               
                               
                              <div class="form-group">
                                 <button type="submit" class="btn btn-add" name="add-property"><i class="fa fa-check"></i> Submit
                                 </button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                </div>
             </section>
 </div>
         <!-- /.content-wrapper -->
         <?php
				include_once('../includes/admin-footer.php');
				?>

      </div>
      <!-- ./wrapper -->
      <!-- Start Core Plugins
         =====================================================================-->
      <!-- jQuery -->
            
 				<?php
				include_once('../includes/admin js-files.php');
				?> 
    
</body>
