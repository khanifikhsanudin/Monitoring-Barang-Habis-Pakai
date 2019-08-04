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
        <link rel="stylesheet" id="css-main" href="<?php echo base_url().'assets/css/codebase.min.css'?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>


    </head>
    <body>
        <!-- Page Container -->
       
        <div id="page-container" class="sidebar-o side-scroll main-content-boxed side-trans-enabled page-header-fixed">
            
            <?php $x["active"]="laboratorium"; $this->load->view('admin/sidebar.php', $x);?>
            <?php echo $this->load->view('admin/header.php');?>

            <?php $level = $this->session->userdata('pengguna_level');?>

            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="block">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Laboratorium</h3>
                                    <div class="block-options">
                                        <?php if($level=='kalab'):?>
                                            <button class="btn btn-primary" id="btn-add-new"><span class="fa fa-plus"></span> Tambah Laboratorium</button>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="block-content block-content-full">
                                    <table id="mytable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Nama Laboratorium</th>
                                                <th>Npak PLP</th>
                                                <th>Nama PLP</th>
                                                <?php if($level=='kalab'):?>
                                                    <th style="text-align:center;width: 130px;">Aksi</th>
                                                <?php endif;?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data2->result_array() as $i) :
                                            $laboratorium_id=$i['laboratorium_id'];
                                            $laboratorium_nama=$i['laboratorium_nama'];
                                            $pengguna_npak=$i['pengguna_npak'];
                                            $pengguna_nama=$i['pengguna_nama'];
                                        ?>
                                            <tr>
                                                <td style="vertical-align: middle;"><?php echo $laboratorium_id;?></td>
                                                <td style="vertical-align: middle;"><?php echo $laboratorium_nama;?></td>
                                                <td style="vertical-align: middle;"><?php echo $pengguna_npak;?></td>
                                                <td style="vertical-align: middle;"><?php echo $pengguna_nama;?></td>
                                                <?php if($level=='kalab'):?>
                                                    <td style="text-align:center;vertical-align: middle;">
                                                        <a class="btn btn-sm btn-secondary btn-circle" data-toggle="modal" data-target="#ModalEdit<?php echo $laboratorium_id;?>"><span class="fa fa-pencil"></span></a>
                                                        <a class="btn btn-sm btn-secondary btn-circle" data-toggle="modal" data-target="#ModalHapus<?php echo $laboratorium_id;?>"><span class="fa fa-trash"></span></a>
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
        <form action="<?php echo base_url().'admin/laboratorium/simpan_laboratorium'?>" method="post" enctype="multipart/form-data">
        <div class="modal" id="ModalAddNew" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Tambah Laboratorium</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <input type="text" name="xnamalab" class="form-control" placeholder="Nama Laboratorium" required>
                            </div>
                            <div class="form-group">
                                <select name="xplp" class="form-control" required>
                                    <option value="">--pilih plp yang belum menjabat--</option>
                                    <?php 
                                        foreach ($plp->result_array() as $p) :
                                            $pengguna_npak=$p['pengguna_npak'];
                                            $pengguna_nama=$p['pengguna_nama'];
                                    ?>
                                    <option value="<?php echo $pengguna_npak;?>"><?php echo $pengguna_nama;?></option>
                                    <?php endforeach; ?>
                                </select>
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

        <?php foreach ($data2->result() as $row) :?>
        <!-- Modal Add New -->
        <form action="<?php echo base_url().'admin/laboratorium/update_laboratorium'?>" method="post" enctype="multipart/form-data">
        <div class="modal" id="ModalEdit<?php echo $row->laboratorium_id;?>" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Edit Laboratorium</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <input type="text" name="xnamalab" value="<?php echo $row->laboratorium_nama;?>" class="form-control" placeholder="Nama Laboratorium" required>
                            </div>
                            <div class="form-group">
                                <select name="xplp" class="form-control" required>
                                    <option value="<?php echo $row->pengguna_npak;?>" selected><?php echo $row->pengguna_nama;?></option>
                                    <?php 
                                        foreach ($plp->result_array() as $p) :
                                            $pengguna_npak=$p['pengguna_npak'];
                                            $pengguna_nama=$p['pengguna_nama'];
                                    ?>
                                    
                                    <?php if($row->pengguna_npak==$pengguna_npak):?>
                                        <option value="<?php echo $pengguna_npak;?>" selected><?php echo $pengguna_nama;?></option>
                                    <?php else:?>
                                        <option value="<?php echo $pengguna_npak;?>"><?php echo $pengguna_nama;?></option>
                                    <?php endif;?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode" value="<?php echo $row->laboratorium_id;?>" required>
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
        <form action="<?php echo base_url().'admin/laboratorium/hapus_laboratorium'?>" method="post">
        <div class="modal" id="ModalHapus<?php echo $row->laboratorium_id;?>" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Hapus Laboratorium</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>Anda yakin mau menghapus laboratorium <?php echo $row->laboratorium_nama;?>?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode" value="<?php echo $row->laboratorium_id;?>" required>
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-square">Ya</button>
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
                        text: "Laboratorium Berhasil disimpan ke database.",
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
                        text: "Laboratorium Berhasil di update",
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
                        text: "Laboratorium Berhasil dihapus.",
                        showHideTransition: 'slide',
                        icon: 'success',
                        hideAfter: false,
                        position: 'bottom-right',
                        bgColor: '#7EC857'
                    });
            </script>
        <?php else:?>

        <?php endif;?>

    </body>
</html>