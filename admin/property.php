<?php
session_start();
include_once('../helper/functions.php');
include_once('../helper/helper.php');
include_once('../includes/admin-head.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST['feature-properties'])){
        featureProperty($db);
    }
    if(isset($_POST['disable-properties'])){
        disableProperty($db);
    }
    if(isset($_POST['delete-property'])){
        deleteProperty($db);
    }
    if(isset($_POST['edit-property'])){
        editProperty($db);
    }
    
    
}
?>   




		
<body class="hold-transition sidebar-mini">
   <!--preloader-->
      <div id="preloader">
         <div id="status"></div>
      </div>
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
                  <h1>Properties</h1>
                  <small>Deposite list & new Deposits</small>
               </div>
            </section>
            <!-- Main content -->
             
            <section class="content">
               <div class="row">
                  
                  <div class="col-sm-12">
                     <div class="panel lobidisable panel-bd">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Our Properties</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                  <?php
                                  $rows = getAllProperties($db);
                                  $count = 1;
                                  ?>
                                 <thead>
                                    <tr class="info">
                                        <th>S/N</th>
                                       <th>Property Name</th>
                                       <th>Property Description</th>
                                        <th>Property Price</th>
                                        <th>Property Address</th>
                                        <th>Property State</th>
                                        <th>Property Image</th>
                                        <th>Property Status</th>
                                        <th>Edit</th>
                                        <th>Action</th>
                                        <th>Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     <?php while($row = mysqli_fetch_assoc($rows)): ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                       <td><?php echo $row['property_title']; ?></td>
                                        <td><?php echo $row['property_description']; ?></td>
                                        <td><?php echo App\helper::formatAmount($row['property_price']); ?></td>
                                        <td><?php echo $row['property_address']; ?></td>
                                        <td><?php echo $row['property_state']; ?></td>
                                        <td><img src="<?php echo $row['property_image']; ?>" alt="<?php echo $row['property_title']; ?>" class="img-responsive"/></td>
                                        <td><?php echo $row['property_status']; ?></td>
                                        <td><button class="btn btn-primary edit" id="<?php echo $row['id']; ?>">Edit</button></td>
                                           <td> <?php if($row['property_status'] == "Disabled"): ?><button class="btn btn-success feature" id="<?php echo $row['id']; ?>">Feature</button>
                                            <?php else: ?>
                                            <button class="btn btn-warning disable" id="<?php echo $row['id']; ?>">Un-Feature</button></td>
                                        <?php endif; ?>
                                        <td><button class="btn btn-danger delete" id="<?php echo $row['id']; ?>">Delete</button></td>
                                    </tr>
                                     
                                     <div class="modal fade" id="edit">
 <div class="modal-dialog">

 <div class="modal-content">

 <!-- Modal Header -->
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 <h4 class="modal-title">Edit<span class="title"></span></h4>
 </div>

 <!-- Modal Body -->
 <div class="modal-body">
 <h4 class="text-center">Are you sure <i class="fa fa-warning fa-3x" style="color:orangered"></i></h4>
     <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <div class="form-group">
         <input type="text" value="" class="property_title form-control" name="property_title" placeholder="Property Title">
         </div>
         <div class="form-group">
        <textarea  class="form-control property_description" placeholder="Enter property description"  name="property_description"></textarea>
         </div>
         <div class="form-group">
         <input type="number" value="" class="property_price form-control" name="property_price" placeholder="Property Price">
         </div>
         <div class="form-group">
         <input type="text" value="" class="property_address form-control" name="property_address" placeholder="Property Address">
         </div>
         <div class="form-group">
         <input type="text" value="" class="property_state form-control" name="property_state" placeholder="Property State">
         </div>
         <div class="form-group">
         <img src="../assets/img/bungalow/03fb3d7d4b07d39ced3d0d7693395831.jpg" alt="img-placeholder" height="240"   id="display_image" />
         <input  class="form-control"  name="property_image" type="file" onchange="document.getElementById('display_image').src = window.URL.createObjectURL(this.files[0])"  >
         </div>

     <input type="hidden" name="id" class="i" value=""/>
    
     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
 <button type="submit" name="edit-property" class="btn btn-primary">Edit</button>
     </form>
 </div>

 <!-- Modal Footer -->
 <div class="modal-footer">
      
 </div>

 </div>
 </div>
</div>
                                   <div class="modal fade" id="delete">
                            <div class="modal-dialog">

 <div class="modal-content">

 <!-- Modal Header -->
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 <h4 class="modal-title">Delete "<span class="title"></span>"</h4>
 </div>

 <!-- Modal Body -->
 <div class="modal-body">
 <h4>Are you sure <i class="fa fa-warning fa-3x" style="color:orangered"></i></h4>
 </div>

 <!-- Modal Footer -->
 <div class="modal-footer">
     <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <input type="hidden" name="id" class="i" value=""/>
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 <button type="submit" name="delete-property" class="btn btn-primary">Delete</button>
         </form>
 </div>

 </div>
 </div>
</div>
                                     
                                     
                                     
                                     
                                     <!---Feature properties--->
        <div class="modal fade" id="feature">
                            <div class="modal-dialog">

 <div class="modal-content">

 <!-- Modal Header -->
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 <h4 class="modal-title">Feature "<span class="title"></span>"</h4>
 </div>

 <!-- Modal Body -->
 <div class="modal-body">
 <h4>Are you sure <i class="fa fa-warning fa-3x" style="color:orangered"></i></h4>
 </div>

 <!-- Modal Footer -->
 <div class="modal-footer">
     <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <input type="hidden" name="id" class="i" value=""/>
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 <button type="submit" name="feature-properties" class="btn btn-primary">Submit</button>
         </form>
 </div>

 </div>
 </div>
</div>         
                                     
                                     
    <!---Disable Properties --->
        <div class="modal fade" id="disable">
                            <div class="modal-dialog">

 <div class="modal-content">

 <!-- Modal Header -->
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 <h4 class="modal-title">Un-Feature "<span class="title"></span>"</h4>
 </div>

 <!-- Modal Body -->
 <div class="modal-body">
 <h4>Are you sure <i class="fa fa-warning fa-3x" style="color:orangered"></i></h4>
 </div>

 <!-- Modal Footer -->
 <div class="modal-footer">
     <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <input type="hidden" name="id" class="i" value=""/>
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 <button type="submit" name="disable-properties" class="btn btn-primary">Submit</button>
         </form>
 </div>

 </div>
 </div>
</div>                             

                                     
                                    
                               <?php endwhile; ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- /.content -->
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
    
    <script>
    
$(document).on('click', '.edit', function(){
        var id = $(this).attr("id");
        console.log(id);
        //$('#form_output').html('');
        
        $.ajax({
            url:"../helper/ajax-requests.php",
            method:'post',
            data:{id:id,name:"properties"},
            dataType:'json',
            success:function(data)
            {
                $('.title').text(data.property_title);
                $('.property_title').val(data.property_title);
                $('.property_description').val(data.property_description);
                $('.property_price').val(data.property_price);
                $('.property_address').val(data.property_address);
                $('.property_state').val(data.property_state);
                $('.property_image').val(data.property_image);
                $('.i').val(data.id);
               $('#edit').appendTo("body").modal('show'); 
    $('.modal').on('show', function(e) {
    var modal = $(this);
    modal.css('margin-top', (modal.outerHeight() / 2) * -1)
         .css('margin-left', (modal.outerWidth() / 2) * -1);
    return this;
});
}});

})	



$(document).on('click', '.delete', function(){
        var id = $(this).attr("id");
        console.log(id);
        //$('#form_output').html('');
        
        $.ajax({
            url:"../helper/ajax-requests.php",
            method:'post',
            data:{id:id,name:"properties"},
            dataType:'json',
            success:function(data)
            {
                $('.title').text(data.property_title);
                
                $('.i').val(data.id);
               $('#delete').appendTo("body").modal('show'); 
    $('.modal').on('show', function(e) {
    var modal = $(this);
    modal.css('margin-top', (modal.outerHeight() / 2) * -1)
         .css('margin-left', (modal.outerWidth() / 2) * -1);
    return this;
});
}});

})	


$(document).on('click', '.feature', function(){
        var id = $(this).attr("id");
        console.log(id);
        //$('#form_output').html('');
        
        $.ajax({
            url:"../helper/ajax-requests.php",
            method:'post',
            data:{id:id,name:"properties"},
            dataType:'json',
            success:function(data)
            {
                $('.title').text(data.property_title);
                
                $('.i').val(data.id);
               $('#feature').appendTo("body").modal('show'); 
    $('.modal').on('show', function(e) {
    var modal = $(this);
    modal.css('margin-top', (modal.outerHeight() / 2) * -1)
         .css('margin-left', (modal.outerWidth() / 2) * -1);
    return this;
});
}});

})


$(document).on('click', '.disable', function(){
        var id = $(this).attr("id");
        console.log(id);
        //$('#form_output').html('');
        
        $.ajax({
            url:"../helper/ajax-requests.php",
            method:'post',
            data:{id:id,name:"properties"},
            dataType:'json',
            success:function(data)
            {
                $('.title').text(data.property_title);
                
                $('.i').val(data.id);
               $('#disable').appendTo("body").modal('show'); 
    $('.modal').on('show', function(e) {
    var modal = $(this);
    modal.css('margin-top', (modal.outerHeight() / 2) * -1)
         .css('margin-left', (modal.outerWidth() / 2) * -1);
    return this;
});
}});

})	



</script>
   </body>


</html>



