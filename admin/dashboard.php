<?php
session_start();

include_once('../helper/helper.php');
include_once('../helper/functions.php');
include_once('../includes/admin-head.php');

?>


   <body class="hold-transition sidebar-mini">
      <!--preloader-->
      <div id="preloader">
         <div id="status"></div>
      </div>
      <!-- Site wrapper -->
      <div class="wrapper">
         <?php include_once('../includes/admin-header.php'); ?>
         <!-- =============================================== -->
         <!-- Left side column. contains the sidebar -->
         <?php include_once('../includes/admin-sidebar.php'); ?>
         <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-dashboard"></i>
               </div>
               <div class="header-title">
                   
                   <?php if(date("A") == "AM"): ?>
                   <h3><b><?php echo "Good Morning Admin"; ?></b></h3>
                   <?php elseif(date("h") == "12"): ?>
                   <h3><b><?php echo "Good Day Admin"; ?></b></h3>
                   <?php else: ?>
                   <h3><b><?php echo "Good Afternoon Admin"; ?></b></h3>
                   <?php endif; ?>
                  <h1>CasaBella Real Estate Admin Dashboard</h1>
                  <small>Very detailed & featured admin.</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                     <div id="cardbox1">
                        <div class="statistic-box">
                           <h3 class="text-center"><i class="fa fa-users fa-2x"></i> Users</h3>
                            <h3 class="text-center"><?php echo getAllUsers($db); ?></h3>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                     <div id="cardbox2">
                        <div class="statistic-box">
                          <h3 class="text-center"><i class="fa fa-users fa-2x"></i> Active Users</h3>
				          <h3 class="text-center"><?php echo getActiveUsers($db); ?></h3>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                     <div id="cardbox4">
                        <div class="statistic-box">
                           <h3 class="text-center"><i class="fa fa-users fa-2x"></i> Banned Users</h3>
				           <h3 class="text-center"><?php echo getBannedUsers($db); ?></h3> 
                        </div>
                     </div>
                  </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                     <div id="cardbox4">
                        <div class="statistic-box">
                           <h3 class="text-center"><i class="fa fa-list fa-2x"></i> Categories</h3>
				            <h3 class="text-center"><?php echo getCategories($db); ?></h3>
                        </div>
                     </div>
                  </div>
                   
                   <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                     <div id="cardbox4">
                        <div class="statistic-box">
                          <h3 class="text-center"><i class="fa fa-home fa-2x"></i> Properties</h3>
				           <h3 class="text-center"><?php echo getProperties($db); ?></h3>
                        </div>
                     </div>
                  </div>
                   
               </div>
               
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <?php include_once('../includes/admin-footer.php'); ?>
      </div>
      <!-- /.wrapper -->
      <!-- Start Core Plugins
         =====================================================================-->
      <!-- jQuery -->
      <?php include_once('../includes/admin js-files.php'); ?>
   </body>

<!-- Mirrored from thememinister.com/crm/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Jan 2021 04:18:46 GMT -->
</html>

