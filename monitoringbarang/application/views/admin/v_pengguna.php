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
            
            <?php $x["active"]="pengguna"; $this->load->view('admin/sidebar.php', $x);?>
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
                                    <h3 class="block-title">Users</h3>
                                    <div class="block-options">
                                        <?php if($level=='kalab'):?>
                                            <button class="btn btn-primary" id="btn-add-new"><span class="fa fa-plus"></span> Tambah Pengguna</button>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="block-content block-content-full">
                                    <table id="mytable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Npak</th>
                                                <th>Username</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <?php if($level=='kalab'):?>
                                                    <th>Password</th>
                                                <?php endif;?>
                                                <th>Level</th>
                                                <?php if($level=='kalab'):?>
                                                    <th style="text-align:center;width: 130px;">Aksi</th>
                                                <?php endif?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data2->result_array() as $i) :
                                            $pengguna_npak=$i['pengguna_npak'];
                                            $pengguna_nama=$i['pengguna_nama'];
                                            $pengguna_jenkel=$i['pengguna_jenkel'];
                                            $pengguna_username=$i['pengguna_username'];
                                            $pengguna_password=$i['pengguna_password'];
                                            $pengguna_level=$i['pengguna_level'];
                                            $pengguna_foto=$i['pengguna_foto'];
                                        ?>
                                            <tr>
                                                <td><img width="40" height="40" class="img-avatar" src="<?php echo base_url().'assets/images/'.$pengguna_foto;?>"></td>
                                                <td style="vertical-align: middle;"><?php echo $pengguna_npak;?></td>
                                                <td style="vertical-align: middle;"><?php echo $pengguna_username;?></td>
                                                <td style="vertical-align: middle;"><?php echo $pengguna_nama;?></td>
                                                <?php if($pengguna_jenkel=='L'):?>
                                                    <td style="vertical-align: middle;">Laki-Laki</td>
                                                <?php else:?>
                                                    <td style="vertical-align: middle;">Perempuan</td>
                                                <?php endif;?>
                                                <?php if($level=='kalab'):?>
                                                    <td style="vertical-align: middle;"><?php echo $pengguna_password;?></td>
                                                <?php endif;?>
                                                <td style="vertical-align: middle;"><?php echo $pengguna_level;?></td>
                                                <?php if($level=='kalab'):?>
                                                    <?php if ($i['pengguna_npak'] <> $this->session->userdata('pengguna_npak')):?>
                                                        <td style="text-align:center;vertical-align: middle;">
                                                            <a class="btn btn-sm btn-secondary btn-circle" data-toggle="modal" data-target="#ModalEdit<?php echo $pengguna_npak;?>"><span class="fa fa-pencil"></span></a>
                                                            <a class="btn btn-sm btn-secondary btn-circle btn-hapus" data-id="<?php echo $pengguna_npak;?>"><span class="fa fa-trash"></span></a>
                                                        </td>
                                                    <?php else:?>
                                                        <td style="text-align:center;vertical-align: middle;">
                                                            <a class="btn btn-sm btn-secondary btn-circle" data-toggle="modal" data-target="#ModalEdit<?php echo $pengguna_npak;?>"><span class="fa fa-pencil"></span></a>
                                                        </td>
                                                    <?php endif;?>
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
        <form action="<?php echo base_url().'admin/pengguna/simpan_pengguna'?>" method="post" enctype="multipart/form-data">
        <div class="modal" id="ModalAddNew" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Tambah Pengguna</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-5">
                                     <div class="form-group">
                                        <input type="file" name="filefoto" class="dropify" data-height="140">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="text" name="xnpak" class="form-control" placeholder="Npak" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="xnama" class="form-control" placeholder="Nama" required>
                                    </div>
                                    <div class="form-group">
                                        <select name="xjenkel" class="form-control" placeholder="Jenis Kelamin" required>
                                            <option value="">Jenis Kelamin</option>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="xlevel" class="form-control" placeholder="Level" required>
                                    <option value="">Level</option>
                                    <option value="plp">PLP</option>
                                    <option value="spi">SPI</option>
                                    <option value="kalab">Kepala Lab</option>
                                    <option value="kajur">Kepala Jurusan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="xusername" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="xpassword" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="xpassword2" class="form-control" placeholder="Confirm Password" required>
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
        <form action="<?php echo base_url().'admin/pengguna/update_pengguna'?>" method="post" enctype="multipart/form-data">
        <div class="modal" id="ModalEdit<?php echo $row->pengguna_npak;?>" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Edit Pengguna</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-5">
                                     <div class="form-group">
                                        <input type="file" name="filefoto" class="dropify" data-height="140" data-default-file="<?php echo base_url().'assets/images/'.$row->pengguna_foto;?>">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="text" name="xnpak" value="<?php echo $row->pengguna_npak;?>" class="form-control" placeholder="Nama" required disabled>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="xnama" value="<?php echo $row->pengguna_nama;?>" class="form-control" placeholder="Nama" required>
                                    </div>
                                    <div class="form-group">
                                        <select name="xjenkel" class="form-control" placeholder="Jenis Kelamin" required>
                                        <?php if($row->pengguna_jenkel=='L'):?>
                                            <option value="L" selected>Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        <?php else:?>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P" selected>Perempuan</option>
                                        <?php endif;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="xlevel" class="form-control" placeholder="Level" required <?php if ($row->pengguna_npak == $this->session->userdata('pengguna_npak')){echo "disabled";}?>>
                                    <option value="">Level</option>
                                    <option value="plp" <?php if($row->pengguna_level=='plp'){echo "selected";}?>>PLP</option>
                                    <option value="spi" <?php if($row->pengguna_level=='spi'){echo "selected";}?>>SPI</option>
                                    <option value="kalab" <?php if($row->pengguna_level=='kalab'){echo "selected";}?>>Kepala Lab</option>
                                    <option value="kajur" <?php if($row->pengguna_level=='kajur'){echo "selected";}?>>Kepala Jurusan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="xusername" value="<?php echo $row->pengguna_username;?>" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="xpassword" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="xpassword2" class="form-control" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kode" value="<?php echo $row->pengguna_npak;?>" required>
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-square">Update</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- END Normal Modal -->
        <?php endforeach;?>

        <!-- Modal Hapus -->
        <form action="<?php echo base_url().'admin/pengguna/hapus_pengguna'?>" method="post">
        <div class="modal" id="Modalhapus" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Info</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                            <p>Anda yakin mau menghapus admin ini?</p>
                            <input type="hidden" name="kode" id="kode" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary btn-square">Ya</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- END Normal Modal -->

        <!-- Modal Reset Password -->
        <div class="modal" id="ModalResetPassword" tabindex="-1" role="dialog" aria-labelledby="modal-normal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">Info</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
                             <table>
                                <tr>
                                    <th style="width:120px;">Username</th>
                                    <th>:</th>
                                    <th><?php echo $this->session->flashdata('uname');?></th>
                                </tr>
                                <tr>
                                    <th style="width:120px;">Password Baru</th>
                                    <th>:</th>
                                    <th><?php echo $this->session->flashdata('upass');?></th>
                                </tr>
                            </table>  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-square" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
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
                        text: "Pengguna Berhasil disimpan ke database.",
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
                        text: "Pengguna berhasil di update",
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
                        text: "Pengguna Berhasil dihapus.",
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