<div class="login-box" style="min-height: 396px;">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>"><b>Pemilihan </b>Dosen</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login</p>

    <?php if( null !== $this->session->flashdata('alert') ) : ?>
      <div class="alert alert-danger alert-dismissible">
        <?= $this->session->flashdata('alert'); ?>
      </div>
    <?php endif; ?>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          <!-- <a href="" class="btn btn-primary btn-block btn-flat">Sign In</a> -->
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>