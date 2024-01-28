<?php
session_start();
include_once("../config/dbconfig.php");
include_once("../includes/nav.php");
?>

<html lang="en">
  <body>
   <!--register-->
    <div class="wrapper1">
     <div class="form-box register">
           <h2>Registration</h2>
            <?php
            if(isset($_SESSION['errors'])):
            ?>
            <?php foreach($_SESSION['errors'] as $err => $errMsg): ?>
            <ul class="error-msg">
            <li class="alert alert-danger alert-dismissable" data-dismiss="alert">&times; <?php echo $errMsg; ?>
                </li>
            </ul>
            <?php endforeach; ?>
            <?php endif;
            session_destroy()
                ?>
            
        <form method="post" action="../processors/signup-user.php">
            
          <div class="input-box">
                    <span class="icon"><i class="fa fa-user"></i></span>
                    <input type="text required" name="username">
                    <label>Username</label>
          </div>

            <div class="input-box">
                    <span class="icon"><i class="fa fa-envelope"></i></span>
                    <input type="email required" name="email">
                    <label>Email</label>
            </div>
              <div class="input-box">
                    <span class="icon"><i class="fa fa-lock"></i></span>
                    <input type="password required" name="password">
                    <label>Password</label>
              </div>
              <div class="input-box">
                    <span class="icon"><i class="fa fa-lock"></i></span>
                    <input type="password required" name="confirm_password">
                    <label>Confirm Password</label>
              </div>

                <div class="remember-forgot">
                    <label><input type="checkbox">I agree To The Terms and Conditions</label>


                </div>
                <button type="submit" class="btn-log" name="register">Register</button>
                 <div class="login-register">
                    <p>Already have an account?<a href="../auth/login.php" class="login-link">Login</a></p>
                 </div>
          
            </form>
        </div>
      </div>
    </div>
    <style>
    .wrapper1{
    position:relative;
    width: 400px;
    height: 520px;
    background: transparent;
    border: 2px solid rgb(255, 255, 255, .5);
    border-radius: 20px;
    backdrop-filter: blur(20px);
    box-shadow: 0 0 30px rgb(0, 0, 0, .5);
    display: flex;
    margin-left: 450px;
    top: 10vh;
    justify-content: center;
    align-items: center;
    transition: transform .5s ease .2s ease;

}

.wrapper1 .form-box.register{
    transition: transform .18s ease;
}
.wrapper1 .form-box{
    width: 100%;
    padding: 40px;
}

.wrapper1 .icon-close{
    position: absolute;
    top: 0;
    right: 0;
    width: 45px;
    height: 45px;
    background:  #590461;
    font-size: 2em;
    color: #fff;
    display: flex;
    justify-content:center;
    align-items: center;
    border-bottom-left-radius: 20px;
    cursor: pointer;
    z-index: 1;
}

</style>
  </body>
    
</html>