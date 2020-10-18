<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="image/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <?php if ($this->session->userdata('level') == 'admin'){ ?>
        <li><a href="app"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        <li><a href="antrian"><i class="fa fa-list"></i> <span>Data Antrian </span></a></li>
        <li><a href="pasien"><i class="fa fa-address-book"></i> <span>Data Pasien </span></a></li>
        
        <li><a href="member"><i class="fa fa-address-card"></i> <span>Data Member  </span></a></li>
        <li><a href="jadwal"><i class="fa fa-calendar-check-o"></i> <span>Data Jadwal  </span></a></li>
        <li><a href="rekam_medis"><i class="fa fa-book"></i> <span>Rekam Medis </span></a></li>
        <li><a href="pembayaran"><i class="fa fa-money"></i> <span>Transaksi Pembayaran </span></a></li>
        <li><a href="app/cetak"><i class="fa fa-print"></i> <span>Cetak Laporan </span></a></li>
        <li><a href="a_user"><i class="fa fa-users"></i> <span>Data User </span></a></li>
        <li><a href="#"><i class="fa fa-database"></i> <span>Back Up Data </span></a></li>
        <li><a href="#"><i class="fa fa-file"></i> <span>Restore Data </span></a></li>

        <?php } elseif ($this->session->userdata('level') == 'user') {?>

        <li><a href="app"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        
        <li><a href="app/daftar_pasien"><i class="fa fa-cube"></i> <span>Pendaftaran Pasien</span></a></li>
        
        

        <?php } ?>
        
        

        <!-- <li class="header">LABELS</li> -->
        <!-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Faqs</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>About</span></a></li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>