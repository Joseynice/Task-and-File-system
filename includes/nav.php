<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <!--Jquerry files-->
    <script src="../assets/Plugins/fontawesome-free-6.4.0-web/js/all.min.js"></script> 
    <script src="../assets/js/bootstrap.min.js"></script>
  
    <!--Boostrap files-->
    <link rel="stylesheet" href="../assets/Plugins/fontawesome-free-6.4.0-web/css/all.min.css"/> 
<link rel="stylesheet" href="../assets/css/bootstrap.min.css"/>

    <!--external css-->
    <link rel="stylesheet" href="../assets/css/task.css"/>
    
</head>
<body>

<header>
 <div class="navbar navbar-static">
    <div class="logo"><a href="../default/Home.php">Task/FIle Manager</a></div>
    <ul class="links">

    <li><a href="../default/Home.php">Home</a></li>
    
    <li><a href="">Task</a></li>
    
    <li><a href="hero">File</a></li>
    
    <li><a href="hero">About</a></li>
    </ul>

    <a href="../auth/login.php"class="sign_btn">Login</a>
    
     <div class="toggle_btn">
        <i class="fa-solid fa-bars"></i>

     </div>
      <div class="dropdown-menu">
        <ul>
        <li><a href="../default/Home.php">Home</a></li>
    
    <li><a href="">Task</a></li>
    
    <li><a href="hero">File</a></li>
    
    <li><a href="hero">About</a></li>
    <li><a href="../auth/login.php" id ="popup-btn"  class="sign_btn">Login</a></li>
    </ul>
      </div>
 </div>
    </header>

     
 
         
    <!--Js files-->
    <script src="../assets/js/task.js"></script>
</body>
</html>

