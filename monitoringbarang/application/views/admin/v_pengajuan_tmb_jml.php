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
            
            <?php $x["active"]="pengajuan_tmb_jml"; $this->load->view('admin/sidebar.php', $x);?>
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
                                    <h3 class="block-title">Pengajuan Tambah Jumlah BHP</h3>
                                    <div class="block-options">
                                        <?php if($level=='plp' && $labdata["laboratorium_nama"] <> ""):?>
                                            <button class="btn btn-primary" id="btn-add-new"><span class="fa fa-plus"></span> Ajukan Tambah Jumlah</button>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="block-content block-content-full">
                                    <table id="mytable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Nama Lab</th>
                                                <th>Nama PLP</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Tgl Mengajukan</th>
                                                <?php if($level=='kajur' || $level=='kalab'):?>
                                                    <th>Konfirmasi</th>
                                                <?php endif;?>
                                                <?php if($level=='plp' || $level=='spi'):?>
                                                    <th>Status Kalab</th>
                                                    <th>Status Kajur</th>
                                                <?php endif;?>
                                                <?php if($level=='plp'):?>
                                                    <th style="text-align:center;width: 130px;">Aksi</th>
                                                <?php endif;?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data2->result_array() as $i) :
                                            $pengajuan_tmb_id=$i['pengajuan_tmb_id'];
                                            $laboratorium_nama=$i['laboratorium_nama'];
                                            $pengajuan_tmb_nama=$i['pengajuan_tmb_nama'];
                                            $barang_nama=$i['barang_nama'];
                                            $jml_barang=$i['barang_jumlah'].' '.$i['barang_satuan'];
                                            $pengajuan_tmb_tgl=$i['pengajuan_tmb_tgl'];
                                            $konfirmasi_kalab=$i['konfirmasi_kalab'];
                                            $konfirmasi_kajur=$i['konfirmasi_kajur'];
                                            $tgl_konfirmasi_kajur=$i['tgl_konfirmasi_kajur'];
                                            $tgl_konfirmasi_kalab=$i['tgl_konfirmasi_kalab'];
                                        ?>
                                            <tr>
                                                <td style="vertical-align: middle;"><?php echo $pengajuan_tmb_id;?></td>
                                                <td style="vertical-align: middle;"><?php echo $laboratorium_nama;?></td>
                                                <td style="vertical-align: middle;"><?php echo $pengajuan_tmb_nama;?></td>
                                                <td style="vertical-align: middle;"><?php echo $barang_nama;?></td>
                                                <td style="vertical-align: middle;"><?php echo $jml_barang;?></td>
                                                <td style="vertical-align: middle;"><?php echo $pengajuan_tmb_tgl;?></td>
                                                <?php if($level=='kalab'):?>
                                                    <td style="vertical-align: middle;">
                                                        <?php if ($konfirmasi_kalab == 'waiting'):?>
                                                            <button class="btn btn-secondary" data-toggle="modal" data-target="#ModalKonfirmasiKalab<?php echo $pengajuan_tmb_id;?>">Konfirmasi</button>
                                                        <?php elseif ($konfirmasi_kalab == 'diterima'):?>
                                                            <span class="badge badge-info">Diterima</span>                                                            
                                                        <?php elseif ($konfirmasi_kalab == 'ditolak'):?>
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        <?php endif;?>
                                                    </td>
                                                <?php elseif($level=='kajur'):?>
                                                    <td style="vertical-align: middle;">
                                                        <?php if ($konfirmasi_kajur == 'waiting'):?>
                                                            <button class="btn btn-secondary" data-toggle="modal" data-target="#ModalKonfirmasiKajur<?php echo $pengajuan_tmb_id;?>">Konfirmasi</button>
                                                        <?php elseif ($konfirmasi_kajur == 'diterima'):?>
                                                            <span class="badge badge-info">Diterima</span>                                                            
                                                        <?php elseif ($konfirmasi_kajur == 'ditolak'):?>
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        <?php endif;?>
                                                    </td>
                                                <?php endif;?>
                                                <?php if($level=='plp' || $level=='spi'):?>
                                                    <td style="vertical-align: middle;">
                                                        <?php
                                                            if ($konfirmasi_kalab == 'waiting'){
                                                                echo '<span class="badge badge-info">Menunggu</span>';
                                                            }
                                                            elseif ($konfirmasi_kalab == 'diterima'){
                                                                echo 'Diterima<br>'.$tgl_konfirmasi_kalab;
                                                            }
                                                            elseif ($konfirmasi_kalab == 'ditolak'){
                                                                echo '<span class="badge badge-danger">Ditolak</span>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <?php
                                                            if ($konfirmasi_kajur == 'waiting'){
                                                                echo '<span class="badge badge-info">Menunggu</span>';
                                                            }
                                                            elseif ($konfirmasi_kajur == 'diterima'){
                                                                echo 'Diterima<br>'.$tgl_konfirmasi_kajur;
                                                            }
                                                            elseif ($konfirmasi_kajur == 'ditolak'){
                                                                echo '<span class="badge badge-danger">Ditolak</span>';
                                                            }
                                                        ?>
                                                    </td>
                                                <?php endif;?>

                                                
                                                <?php if($level=='plp'):?>
                                                    <td style="text-align:center;vertical-align: middle;">
                                                        <?php if($laboratorium_nama=$i['laboratorium_nama'] == $labdata["laboratorium_nama"]):?>
                                                            <?php if($konfirmasi_kalab == 'waiting' && $konfirmasi_kajur == 'waiting'):?>
                                                                <a class="btn btn-sm btn-secondary btn-circle" data-toggle="modal" data-target="#ModalEdit<?php echo $laboratorium_id;?>"><span class="fa fa-pencil"></span></a>
                                                                <a class="btn btn-sm btn-secondary btn-circle" data-toggle="modal" data-target="#ModalHapus<?php echo $pengajuan_tmb_id;?>"><span class="fa fa-trash"></span></a>
                                                            <?php endif;?>
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

        
        <!-- Modal Add New -->
        <form action="<?php echo base_url().'admin/pengajuan_tmb_jml/simpan_pengajuan_tmb_jml'?>" method="post" enctype="multipart/form-data">
        <div class="modal" id="ModalAddNew" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Ajukan Tambah Jumlah BHP</h3>
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
                            <input type="hidden" name="xlab" value="<?php echo $labdata["laboratorium_id"];?>" required>
                            <div class="form-group">
                                <select name="xidbarang" class="form-control" required>
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
                                    <option value="<?php echo $barang_id;?>"><?php echo $barang_nama;?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" name="xjmlbrg" class="form-control" placeholder="Jumlah Barang" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-square">Ajukan</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- END Normal Modal -->

        <?php foreach ($data2->result() as $row) :?>
        <!-- Modal Add New -->
        <form action="<?php echo base_url().'admin/pengajuan_tmb_jml/update_pengajuan_tmb_jml'?>" method="post" enctype="multipart/form-data">
        <div class="modal" id="ModalEdit<?php echo $row->laboratorium_id;?>" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Edit Tambah Jumlah</h3>
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
                            <input type="hidden" name="xlab" value="<?php echo $labdata["laboratorium_id"];?>" required>
                            <div class="form-group">
                                <select name="xidbarang" class="form-control" required>
                                    <?php
                                        $labid = $labdata['laboratorium_id'];
                                        $query=$this->db->query("SELECT a.barang_id, a.barang_nama, a.barang_satuan, sum(b.barang_jumlah) AS sisa FROM barang_habis_pakai a, jml_bhp b WHERE a.barang_id = b.barang_id and b.laboratorium_id = '$labid' GROUP BY a.barang_id, b.laboratorium_id;");
                                        foreach ($query->result_array() as $brg) :
                                            $barang_id=$brg['barang_id'];
                                            $barang_nama=$brg['barang_nama'];
                                            $barang_satuan=$brg['barang_satuan'];
                                            $barang_sisa=$brg['sisa'];
                                    ?>
                                    <option value="<?php echo $barang_id;?>" <?php if($barang_nama == $row->barang_nama){echo 'selected';}?>><?php echo $barang_nama;?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="number" name="xjmlbrg" value="<?php echo $row->barang_jumlah;?>" class="form-control" placeholder="Jumlah Barang" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode" value="<?php echo $row->pengajuan_tmb_id;?>" required>
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-square">Update</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- END Normal Modal -->
        <?php endforeach;?>


        <?php foreach ($data2->result() as $row) :?>
        <!-- Modal Hapus -->
        <form action="<?php echo base_url().'admin/pengajuan_tmb_jml/hapus_pengajuan_tmb_jml'?>" method="post">
        <div class="modal" id="ModalHapus<?php echo $row->pengajuan_tmb_id;?>" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Batal Pengajuan</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>Anda yakin mau membatalkan pengajuan <?php echo $row->barang_jumlah.' '.$row->barang_satuan.' '.$row->barang_nama;?>?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode" value="<?php echo $row->pengajuan_tmb_id;?>" required>
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-square">Ya</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- END Normal Modal -->
        <?php endforeach;?>


        <?php foreach ($data2->result() as $row) :?>
        <!-- Modal Konfirmasi -->
        <form action="<?php echo base_url().'admin/pengajuan_tmb_jml/konfirmasi_kalab'?>" method="post">
        <div class="modal" id="ModalKonfirmasiKalab<?php echo $row->pengajuan_tmb_id;?>" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Konfirmasi</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <label>Konfirmasi pengajuan <?php echo $row->barang_jumlah.' '.$row->barang_satuan.' '.$row->barang_nama.' dari '.$row->pengajuan_tmb_nama;?></label>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="diterima" name="xkonfirm" checked>&nbsp&nbsp&nbspTerima
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="ditolak" name="xkonfirm">&nbsp&nbsp&nbspTolak
                                </label>
                            </div>
                            <input type="hidden" name="xlab" value="<?php echo $labdata["laboratorium_id"];?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode" value="<?php echo $row->pengajuan_tmb_id;?>" required>
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-square">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- END Normal Modal -->
        <?php endforeach;?>


        <?php foreach ($data2->result() as $row) :?>
        <!-- Modal Konfirmasi -->
        <form action="<?php echo base_url().'admin/pengajuan_tmb_jml/konfirmasi_kajur'?>" method="post">
        <div class="modal" id="ModalKonfirmasiKajur<?php echo $row->pengajuan_tmb_id;?>" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Konfirmasi</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <label>Konfirmasi pengajuan <?php echo $row->barang_jumlah.' '.$row->barang_satuan.' '.$row->barang_nama.' oleh '.$row->pengajuan_tmb_nama;?></label>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="diterima" name="xkonfirm" checked>&nbsp&nbsp&nbspTerima
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" value="ditolak" name="xkonfirm">&nbsp&nbsp&nbspTolak
                                </label>
                            </div>
                            <input type="hidden" name="xlab" value="<?php echo $labdata["laboratorium_id"];?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode" value="<?php echo $row->pengajuan_tmb_id;?>" required>
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-square">Konfirmasi</button>
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

            });
        </script>

        <?php if($this->session->flashdata('msg')=='error'):?>
            <script type="text/javascript">
                    $.toast({
                        heading: 'Error',
                        text: "Password dan Confirm Password yang Anda masukan tidak sama.",
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
                        text: "Pengajuan Penambahan Jumlah Barang Telah Dikirim."",
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
                        text: "Barang Pengajuan berhasil di update",
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
                        text: "Pengajuan Berhasil dibatalkan.",
                        showHideTransition: 'slide',
                        icon: 'success',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#7EC857'
                    });
            </script>
        <?php elseif($this->session->flashdata('msg')=='success-konfirm'):?>
            <script type="text/javascript">
                    $.toast({
                        heading: 'Success',
                        text: "Pengajuan diterima.",
                        showHideTransition: 'slide',
                        icon: 'success',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#7EC857'
                    });
            </script>
        <?php elseif($this->session->flashdata('msg')=='success-tolak'):?>
            <script type="text/javascript">
                    $.toast({
                        heading: 'Success',
                        text: "Pengajuan ditolak.",
                        showHideTransition: 'slide',
                        icon: 'success',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#FF4859'
                    });
            </script>
        <?php endif;?>

    </body>
</html>