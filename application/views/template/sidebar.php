<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">DAFTAR MENU</li>
        <li id="dashboard_index">
          <a href="<?php echo site_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
          </a>
         
        </li>
        <li id="skripsi_index">
          <a href="<?php echo site_url('skripsi') ?>">
            <i class="fa fa-graduation-cap"></i> <span>Kumpulan Skripsi</span>
          </a>
         
        </li>
        <li id="perhitungan_index" >
          <a href="<?php echo site_url('perhitungan') ?>">
            <i class="fa fa-user"></i> <span>Pemilihan Dosen</span>
          </a>
         
        </li>
        <li id="dosen_index">
          <a href="<?php echo site_url('dosen') ?>">
            <i class="fa fa-book"></i> <span>Daftar Dosen</span>
          </a>
         
        </li>
        <li id="katadasar_index">
          <a href="<?php echo site_url('katadasar') ?>">
            <i class="fa fa-university"></i> <span>Kata Dasar</span>
          </a>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <script>
  function menuActive( menu_id ){
    var menu = document.getElementById( menu_id );
    console.log( menu_id );
    menu_id.classList.add('active');
  }

  </script>