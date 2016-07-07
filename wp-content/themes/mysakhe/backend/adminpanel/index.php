<?php
session_start();
$page = $_GET["p"];
if(!isset($_GET['p'])){
                        $page = 'services';
}
include TEMPLATEPATH.'/backend/adminpanel/controller/my_controller.php';

global $controller;
$controller = new my_controller();

if($page=="logout"){
  $controller->logout_admin();
  header("Location: admin-panel");
}

if(!$controller->user_is_logged_in()){
  $page = "login";
   get_admin_page($page);
   exit();
}

get_template_part('backend/adminpanel/includes/head');
get_template_part('backend/adminpanel/includes/header');
get_template_part('backend/adminpanel/includes/nav');


 ?>

 <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo ucfirst($page) ?></h1>
                </div>
                <!--End Page Header -->
                 <div class="col-lg-12">
                     <?php 
                     get_admin_page($page);
                      ?>
                </div>
              
            </div>

            

        </div>
<!-- end page-wrapper -->
<?php 
get_template_part('backend/adminpanel/includes/footer'); ?>