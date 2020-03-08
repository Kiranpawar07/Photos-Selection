<?php session_start(); 
  if(isset($_SESSION["user_id"])){
    header("Location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/css/ionicons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/typicons/src/font/typicons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/shared/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />

<style>
  body, html
  {
    height: 100%;
  }

  .bg 
  { 
    /* The image used */
    background-image: url("assets/images/bg.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
</style>
 

</head>

<body>
<div class="bg">
<?php
    //Connect to database
    include('connection.php');

    //User Registration form submitted
    $err = "";
    $username  = "";
    $password  = "";
    
    if(isset($_POST["btnLogin"]))
    {   
        $username  = mysqli_real_escape_string ($link, $_POST["username"]);
        $password  = mysqli_real_escape_string ($link, $_POST["password"]);
        
        if($username!="" && $password!="")
        {
          //CHECK LOGIN
          $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
          $result = mysqli_query($link, $sql);
          $row = mysqli_fetch_assoc($result);

          if($row)
          {
              //Store logged in user details in Session
              $_SESSION["user_id"] = $row["user_id"];
              $_SESSION["username"] = $row["username"];

              header("Location:index.php");
          }
          else
          {
              $err = "Invalid Login, Please enter correct username or password!";
          }
        }
        else
        {
            $err = "Please enter username and password!";
        }
    }
  ?>

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <div class="auto-form-wrapper">

                <?php if($err != "") { ?>
                <div class="alert alert-danger" role="alert">
                    <?=$err?>
                </div>
                <?php } ?>
                
                <form action="" method="POST">

                  <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                      <input type="text" name="username" class="form-control" placeholder="Username">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" name="password" class="form-control" placeholder="*********">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                     <button name="btnLogin" class="btn btn-primary submit-btn btn-block">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

</div>
  
  </body>


</html>