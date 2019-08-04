<!doctype html>
<html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <title>Monitoring Barang Habis Pakai</title>

        <meta name="description" content="">
        <meta name="robots" content="noindex, nofollow">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo base_url().'assets/images/favicon.png'?>">

        <!-- END Icons -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/js/plugins/datatables/dataTables.bootstrap4.min.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/dropify.min.css'?>">
        <link rel="stylesheet" id="css-main" href="<?php echo base_url().'assets/css/codebase.min.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>

    </head>
    <body>
        <!-- Page Container -->
       
        <div id="page-container" class="sidebar-o side-scroll main-content-boxed side-trans-enabled page-header-fixed">
            
            <?php $x["active"]="barang"; $this->load->view('admin/sidebar.php', $x);?>
            <?php echo $this->load->view('admin/header.php');?>
            <?php $level = $this->session->userdata('pengguna_level');?>
            <?php $labdata = $labplp->row_array();?>

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Total Semua Laboratorium</h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <table id="mytable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Nama Barang</th>
                                                <th>Satuan</th>
                                                <th>Sisa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data2->result_array() as $i) :
                                            $barang_id=$i['barang_id'];
                                            $barang_nama=$i['barang_nama'];
                                            $barang_satuan=$i['barang_satuan'];
                                            $sisa=$i['jumlah_total_sisa'];
                                        ?>
                                            <tr>
                                                <td style="vertical-align: middle;"><?php echo $barang_id;?></td>
                                                <td style="vertical-align: middle;"><?php echo $barang_nama;?></td>
                                                <td style="vertical-align: middle;"><?php echo $barang_satuan;?></td>
                                                <td style="vertical-align: middle;"><?php echo $sisa;?></td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Detail Semua Laboratorium</h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <table id="mytable2" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Laboratorium</th>
                                                <?php if($level=='plp'):?>
                                                    <th style="text-align:center;width: 130px;">Set Limit</th>
                                                <?php endif;?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data3->result_array() as $i) :
                                            $barang_id=$i['barang_id'];
                                            $barang_nama=$i['barang_nama'];
                                            $jumlah=$i['jumlah_barang'];
                                            $laboratorium_nama=$i['laboratorium_nama'];
                                            $laboratorium_id=$i['laboratorium_id'];
                                            $barang_limit=$i['barang_limit'];
                                        ?>
                                            <tr>
                                                <td style="vertical-align: middle;"><?php echo $barang_id;?></td>
                                                <td style="vertical-align: middle;">
                                                    <?php
                                                        if($jumlah < $barang_limit + 1){
                                                            echo "<strong style='color:#FF4859;'>$barang_nama</strong>";
                                                        }else{
                                                            echo $barang_nama;
                                                        }
                                                        
                                                    ?>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <?php
                                                        if($jumlah < $barang_limit + 1){
                                                            echo "<strong style='color:#FF4859;'>$jumlah</strong>";
                                                        }else{
                                                            echo $jumlah;
                                                        }
                                                        
                                                    ?>
                                                </td>
                                                <td style="vertical-align: middle;"><?php echo $laboratorium_nama;?></td>
                                                <?php if($level=='plp'):?>
                                                    <td style="text-align:center;vertical-align: middle;">
                                                        <?php if($laboratorium_nama=$i['laboratorium_nama'] == $labdata["laboratorium_nama"]):?>
                                                            <a class="btn btn-sm btn-secondary btn-circle" data-toggle="modal" data-target="#ModalSetLimit<?php echo $barang_id.$laboratorium_id;?>"><span class="fa fa-pencil"></span></a>
                                                        <?php endif;?>
                                                    </td>
                                                <?php endif;?>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
            
            <?php echo $this->load->view('admin/footer.php');?>
            
        </div>
        <!-- END Page Container -->

        <?php foreach ($data3->result() as $row) :?>
        <!-- Modal Set -->
        <form action="<?php echo base_url().'admin/barang/set_limit'?>" method="post" enctype="multipart/form-data">
        <div class="modal" id="ModalSetLimit<?php echo $row->barang_id.$row->laboratorium_id;?>" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Setting limit jumlah BHP</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                        <label>Limit jumlah <?php echo $row->barang_nama.' adalah '.$row->barang_limit;?></label>
                            <div class="form-group">
                                <input type="number" name="xlimit" class="form-control" placeholder="Set jumlah limit" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="xbid" value="<?php echo $row->barang_id;?>" required>
                        <input type="hidden" name="xlab" value="<?php echo $row->laboratorium_id;?>" required>
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-square">SET</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- END Normal Modal -->
        <?php endforeach;?>



        
        <!-- Codebase Core JS -->
        <script src="<?php echo base_url().'assets/js/core/jquery.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/popper.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/bootstrap.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/jquery.slimscroll.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/jquery.scrollLock.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/jquery.appear.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/jquery.countTo.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/core/js.cookie.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/codebase.js'?>"></script>
        <script src="<?php echo base_url().'assets/ckeditor/ckeditor.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/plugins/datatables/jquery.dataTables.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/plugins/datatables/dataTables.bootstrap4.min.js'?>"></script>
        <script src="<?php echo base_url().'assets/js/dropify.min.js'?>"></script>
        <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>

        
        <!-- Page JS Code -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#mytable').DataTable();
                $('#mytable2').DataTable();

                $('.dropify').dropify({ //overate input type file
                    messages: {
                        default: 'Photo',
                        replace: 'Ganti',
                        remove:  'Hapus',
                        error:   'error'
                    }
                });
            });
        </script>

        <?php if($this->session->flashdata('msg')=='set-success'):?>
            <script type="text/javascript">
                    $.toast({
                        heading: 'Success',
                        text: "Limit Set Updated.",
                        showHideTransition: 'slide',
                        icon: 'success',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#7EC857'
                    });
            </script>
        <?php endif;?>
    </body>
</html>