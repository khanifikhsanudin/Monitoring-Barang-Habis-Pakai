<!-- Sidebar -->
<nav id="sidebar">
    <!-- Sidebar Scroll Container -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Side Header -->
            <div class="content-header content-header-fullrow px-15">
                <!-- Mini Mode -->
                <div class="content-header-section sidebar-mini-visible-b">
                    <!-- Logo -->
                    <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                        <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                    </span>
                    <!-- END Logo -->
                </div>
                <!-- END Mini Mode -->

                <!-- Normal Mode -->
                <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                    <!-- Close Sidebar, Visible only on mobile screens -->
                    <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                    <!-- END Close Sidebar -->

                    <!-- Logo -->
                    <div class="content-header-item">
                        <a class="link-effect font-w700" href="<?php echo base_url().'admin/dashboard'?>">
                            <i class="text-primary"></i>
                            <span class="font-size-xl text-dual-primary-dark">MONITORING</span><span class="font-size-xl text-success"><strong>BHP</strong></span>
                        </a>
                    </div>
                    <!-- END Logo -->
                </div>
                <!-- END Normal Mode -->
            </div>
            <!-- END Side Header -->

            <!-- Side User -->
            <div class="content-side content-side-full content-side-user px-10 align-parent">
                <!-- Visible only in mini mode -->
                <div class="sidebar-mini-visible-b align-v animated fadeIn">
                    <img class="img-avatar img-avatar32" src="<?php echo base_url().'assets/images/user_blank.png'?>" alt="">
                </div>
                <!-- END Visible only in mini mode -->

                <!-- Visible only in normal mode -->
                <div class="sidebar-mini-hidden-b text-center">
                    <?php 
                        error_reporting(0);
                        $idadmin=$this->session->userdata('pengguna_npak');
                        $query=$this->db->query("SELECT * FROM pengguna WHERE pengguna_npak='$idadmin'");
                        $data=$query->row_array();
                    ?>
                    <a class="img-link" href="#">
                        <img class="img-avatar" src="<?php echo base_url().'assets/images/'.$data['pengguna_foto'];?>" alt="">
                    </a>
                    <ul class="list-inline mt-10">
                        <li class="list-inline-item">
                            <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="#"><?php echo $this->session->userdata('pengguna_nama');?></a>
                        </li>                        
                    </ul>
                </div>
                <!-- END Visible only in normal mode -->
            </div>
            <!-- END Side User -->

            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    
                    <li>
                        <a class="<?php if ($active == "dashboard"){echo "active";} ?>" href="<?php echo base_url().'admin/dashboard'?>"><i class="si si-screen-desktop"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                    </li>
                    <li>
                        <a class="<?php if ($active == "barang"){echo "active";} ?>" href="<?php echo base_url().'admin/barang'?>"><i class="si si-folder-alt"></i><span class="sidebar-mini-hide">Barang</span></a>
                    </li>
                    <li>
                        <a class="<?php if ($active == "pemakaian"){echo "active";} ?>" href="<?php echo base_url().'admin/pemakaian'?>"><i class="si si-folder-alt"></i><span class="sidebar-mini-hide">Pemakaian</span></a>
                    </li>
                    <li class="<?php if($active == "pengajuan_baru" || $active == "pengajuan_tmb_jml"){echo "open";}?>">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-tag"></i><span class="sidebar-mini-hide">Pengajuan</span></a>
                        <ul>
                            <li>
                                <a class="<?php if ($active == "pengajuan_baru"){echo "active";} ?>" href="<?php echo base_url().'admin/pengajuan_baru'?>">BHP Baru</a>
                            </li>
                            <li>
                                <a class="<?php if ($active == "pengajuan_tmb_jml"){echo "active";} ?>" href="<?php echo base_url().'admin/pengajuan_tmb_jml'?>">Tambah Jumlah</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a class="<?php if ($active == "laboratorium"){echo "active";} ?>" href="<?php echo base_url().'admin/laboratorium'?>"><i class="si si-folder-alt"></i><span class="sidebar-mini-hide">Laboratorium</span></a>
                    </li>
                    <li>
                        <a class="<?php if ($active == "pengguna"){echo "active";} ?>" href="<?php echo base_url().'admin/pengguna'?>"><i class="si si-user"></i><span class="sidebar-mini-hide">Users</span></a>
                    </li>
                    
                </ul>
            </div>
            <!-- END Side Navigation -->
            
        </div>
        <!-- Sidebar Content -->
    </div>
    <!-- END Sidebar Scroll Container -->
</nav>
<!-- END Sidebar -->