<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/skin-green-light.min.css" rel="stylesheet" type="text/css" />
    <!-- IoT style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/app.css" rel="stylesheet" type="text/css" />
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
    </style>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- <body class="sidebar-mini skin-black-light"> -->
  <body class="hold-transition skin-green-light layout-top-nav">
    <div class="wrapper">
      
      <header class="main-header">
        
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <div class="container">
            <!-- Sidebar toggle button-->
            <!-- Logo -->
            <div class="navbar-header">
              <a href="<?php echo base_url(); ?>" class="navbar-brand"><b>IoT</b>Platform</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="treeview">
                  <a href="#" >
                    <span>Projects</span>
                  </a>
                </li>
                <?php
                if($role == ROLE_ADMIN || $role == ROLE_MANAGER)
                {
                ?>
                <li class="treeview">
                  <a href="#" >
                    <span>Task Status</span>
                  </a>
                </li>
                <?php
                }
                if($role == ROLE_ADMIN)
                {
                ?>
                <li class="treeview">
                  <a href="<?php echo base_url(); ?>userListing">
                    <span>Users</span>
                  </a>
                </li>
                <?php
                }
                ?>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                </div>
              </form>
            </div>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image"/>
                    <span class="hidden-xs"><?php echo $name; ?></span>
                  </a>
                  <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                      <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                      <p>
                        <?php echo $name; ?>
                        <small><?php echo $role_text; ?></small>
                      </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Change Password</a>
                      </div>
                      <div class="pull-right">
                        <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>