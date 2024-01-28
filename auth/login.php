<?php
session_start();
include_once("../config/dbconfig.php");
include_once("../includes/nav.php");
?>

<html lang="en">


    <body>

  
             <!--login form-->
        <div class="wrapper">
            <!-- <span class ="icon-close"><i class ="fa fa-xmark"></i></span>-->
           <div class="form-box login">
                        <h2>Login</h2>
                        <?php if(isset($_SESSION['success'])): ?>
                        <ul class="error-msg">
                        <li class="alert alert-success alert-dismissable" data-dismiss="alert">&times; <?php echo $_SESSION['success']; ?></li>
                        </ul>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['error'])): ?>
                        <ul class="error-msg">
                        <li class="alert alert-danger alert-dismissable" data-dismiss="alert">&times; <?php echo $_SESSION['error']; ?></li>
                        </ul>
                        <?php endif; ?>
                        
                        <?php if(isset($_SESSION['errors'])): ?>
                        <?php foreach($_SESSION['errors'] as $err => $errMsg) : ?>
                        <ul class="error-msg">
                        <li class="alert alert-danger alert-dismissable" data-dismiss="alert">&times; <?php echo $errMsg; ?></li>
                        </ul>
                        <?php endforeach; ?>
                        <?php endif;
                        session_destroy()
                            ?>
               <form method="post" action="../processors/handle-login.php">

                    <div class="input-box">
                         <span class="icon"><i class="fa fa-envelope"></i></span>
                           <input type="email  required" name="email">
                             <label>Email</label>
                   </div>
                    
                   <div class="input-box">
                            <span class="icon"><i class="fa fa-lock"></i></span>
                                <input type="password required" name="password">
                                   <label>Password</label>
                       </div>
                   <div class="remember-forgot">
                           <label><input type="checkbox">Remember Me</label>
                        <a href="#">Forgot Password</a>

                       </div>
                           <button type="submit" class="btn-log" name="login">Login</button>
                    <div class="login-register">
                    <p>Don't have account<a href="../auth/signup.php" class="register-link">Register</a></p>
                       </div>
               </form>
            </div>
            
        </div>


         <!--Js files-->
          <script src="../js/task.js"></script>

    </body>

</html>