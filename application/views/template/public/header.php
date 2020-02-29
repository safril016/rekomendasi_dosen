
<html style="height: auto; min-height: 100%;">
<head>
  <style>
    html, body {
      height: 100% !important;
    }
  </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PDP</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="skin-blue layout-top-nav" style="min-height: 100%;" onload="menuActive(<?php echo ( isset( $menu_list_id ) ) ? $menu_list_id : 'home_index'; ?>)">
<div class="wrapper" style="height: auto; min-height: 100%;">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url() ?>" class="navbar-brand"><b>Beranda</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li id="home_index" ><a href="<?php echo site_url() ?>">Panduan TA <span class="sr-only">(current)</span></a></li>
            <li id="home_dosen"><a href="<?php echo site_url('home/dosen/') ?>">Dosen IT</a></li>
            <li id="auth_login" class="dropdown user user-menu">
                <a href="<?php echo site_url('auth/login') ?>">
                <span class="fa fa-sign-in">  Login</span>
                </a>
            </li>
          </ul>
          
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

<script>
  function menuActive( menu_id ){
    var menu = document.getElementById( menu_id );
    console.log( menu_id );
    menu_id.classList.add('active');
  }

</script>