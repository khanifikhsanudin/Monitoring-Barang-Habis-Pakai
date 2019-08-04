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
            
            <?php $x["active"]="pemakaian"; $this->load->view('admin/sidebar.php', $x);?>
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
                                    <h3 class="block-title">Pemakaian BHP</h3>
                                    <div class="block-options">
                                    <?php if($level=='plp' && $labdata["laboratorium_nama"] <> ""):?>
                                        <button class="btn btn-primary" id="btn-add-new"><span class="fa fa-plus"></span> Tambah Pemakaian</button>
                                    <?php endif;?>
                                    </div>
                                </div>
                                <div class="block-content block-content-full">
                                    <table id="mytable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Nama Barang</th>
                                                <th>Nama Laboratorium</th>
                                                <th>Tgl Pemakaian</th>
                                                <th>Jumlah Pemakaian</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data2->result_array() as $i) :
                                            $pemakaian_id=$i['pemakaian_id'];
                                            $barang_nama=$i['barang_nama'];
                                            $laboratorium_nama=$i['laboratorium_nama'];
                                            $pemakaian_tgl=$i['pemakaian_tgl'];
                                            $pemakaian_jumlah=$i['pemakaian_jumlah'];
                                            $pemakaian_ket=$i['pemakaian_ket'];
                                        ?>
                                            <tr>
                                                <td style="vertical-align: middle;"><?php echo $pemakaian_id;?></td>
                                                <td style="vertical-align: middle;"><?php echo $barang_nama;?></td>
                                                <td style="vertical-align: middle;"><?php echo $laboratorium_nama;?></td>
                                                <td style="vertical-align: middle;"><?php echo $pemakaian_tgl;?></td>
                                                <td style="vertical-align: middle;"><?php echo $pemakaian_jumlah;?></td>
                                                <td style="vertical-align: middle;"><?php echo $pemakaian_ket;?></td>
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


        <!-- Modal Add New -->
        <form action="<?php echo base_url().'admin/pemakaian/simpan_pemakaian'?>" method="post" enctype="multipart/form-data">
        <div class="modal" id="ModalAddNew" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Tambah Pemakaian BHP</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <a class="text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="#">Untuk Lab <?php echo $labdata["laboratorium_nama"];?></a>
                            </div>
                            
                            <div class="form-group">
                                <select name="xbarang" class="form-control" required>
                                    <option value="">--pilih barang--</option>
                                    <?php
                                        $labid = $labdata['laboratorium_id'];
                                        $query=$this->db->query("SELECT a.barang_id, a.barang_nama, a.barang_satuan, sum(b.barang_jumlah) AS sisa FROM barang_habis_pakai a, jml_bhp b WHERE a.barang_id = b.barang_id and b.laboratorium_id = '$labid' GROUP BY a.barang_id, b.laboratorium_id;");
                                        foreach ($query->result_array() as $brg) :
                                            $barang_id=$brg['barang_id'];
                                            $barang_nama=$brg['barang_nama'];
                                            $barang_satuan=$brg['barang_satuan'];
                                            $barang_sisa=$brg['sisa'];
                                    ?>
                                    <option value="<?php echo $barang_id;?>"><?php echo 'Sisa '.$barang_nama.' '.$barang_sisa.' '.$barang_satuan;?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <input type="hidden" name="xlab" value="<?php echo $labdata["laboratorium_id"];?>" required>

                            <div class="form-group">
                                <input type="number" name="xjmlbrg" class="form-control" placeholder="Jumlah Barang di Ambil" required>
                            </div>
                            <div class="form-group">
                                <textarea name="xket" class="form-control" placeholder="Keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-square">Save</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- END Normal Modal -->

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

                $('.dropify').dropify({ //overate input type file
                    messages: {
                        default: 'Photo',
                        replace: 'Ganti',
                        remove:  'Hapus',
                        error:   'error'
                    }
                });

                //Show Modal Add New
                $('#btn-add-new').on('click',function(){ 
                    $('#ModalAddNew').modal('show');
                });

                //Show Modal Update Kategori
                $('.btn-edit').on('click',function(){
                    var kategori_id=$(this).data('id');
                    var kategori_nama=$(this).data('kategori');
                    $('#ModalUpdate').modal('show');
                    $('[name="xkode"]').val(kategori_id);
                    $('[name="xkategori2"]').val(kategori_nama);
                });

                //Show Konfirmasi modal hapus record
                $('.btn-hapus').on('click',function(){
                    var kategori_id=$(this).data('id');
                    $('#Modalhapus').modal('show');
                    $('[name="kode"]').val(kategori_id);
                });  

            });
        </script>

        <?php if($this->session->flashdata('msg')=='error-num'):?>
            <script type="text/javascript">
                    $.toast({
                        heading: 'Error',
                        text: "Jumlah Barang Tidak Boleh 0 dan Melebihi Batas",
                        showHideTransition: 'slide',
                        icon: 'error',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#FF4859'
                    });
            </script>
        <?php elseif($this->session->flashdata('msg')=='warning'):?>
            <script type="text/javascript">
                    $.toast({
                        heading: 'Warning',
                        text: "Gambar yang Anda masukan terlalu besar.",
                        showHideTransition: 'slide',
                        icon: 'warning',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#FFC017'
                    });
            </script>
        <?php elseif($this->session->flashdata('msg')=='success'):?>
            <script type="text/javascript">
                    $.toast({
                        heading: 'Success',
                        text: "Pemakaian Berhasil disimpan ke database.",
                        showHideTransition: 'slide',
                        icon: 'success',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#7EC857'
                    });
            </script>
        <?php elseif($this->session->flashdata('msg')=='info'):?>
            <script type="text/javascript">
                    $.toast({
                        heading: 'Info',
                        text: "Pemakaian berhasil di update",
                        showHideTransition: 'slide',
                        icon: 'info',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#00C9E6'
                    });
            </script>
        <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
            <script type="text/javascript">
                    $.toast({
                        heading: 'Success',
                        text: "Pemakaian Berhasil dihapus.",
                        showHideTransition: 'slide',
                        icon: 'success',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#7EC857'
                    });
            </script>
        <?php elseif($this->session->flashdata('msg')=='show-modal'):?>
            <script type="text/javascript">
                    $('#ModalResetPassword').modal('show');
            </script>
        <?php else:?>

        <?php endif;?>

    </body>
</html>