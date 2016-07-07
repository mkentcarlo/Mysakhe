<?php 
global $controller;
if(isset($_POST['login'])){
    if($controller->login_admin($_POST)){
        echo "<script>window.location='admin-panel';</script>";
    }
    else{
        $message = "<div class='alert alert-danger'>Failed to login: Invalid username/password.</div>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Core CSS - Include with every page -->
    <link href="<?php bloginfo('template_url'); ?>/backend/adminpanel/assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?php bloginfo('template_url'); ?>/backend/adminpanel/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php bloginfo('template_url'); ?>/backend/adminpanel/assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
   <link href="<?php bloginfo('template_url'); ?>/backend/adminpanel/assets/css/style.css" rel="stylesheet" />
      <link href="<?php bloginfo('template_url'); ?>/backend/adminpanel/assets/css/main-style.css" rel="stylesheet" />

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
              <img src="<?php bloginfo('template_url'); ?>/images/comp-new.png" alt=""/>
                </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-lock"></i>&nbsp;&nbsp;Administrator Login</h3>
                    </div>
                    <div class="panel-body">
                           <?php echo $message; ?>
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" value="<?php echo $_POST["Email"]; ?>" type="email" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required> 
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" name="login" style="border-radius: 0px;">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Core Scripts - Include with every page -->
    <script src="<?php bloginfo('template_url'); ?>/backend/adminpanel/assets/plugins/jquery-1.10.2.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/backend/adminpanel/assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/backend/adminpanel/assets/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>

</html>
