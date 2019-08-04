<?php
class Login extends CI_Controller{
    function __construct(){
        parent:: __construct();
        $this->load->model('M_login','m_login');

    }

    function index(){
        if($this->session->userdata('masuk')==true){
            redirect('login/berhasillogin');
        }else{
            $this->load->view('admin/v_login');
        }
    }

    function auth(){
        $username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
        $u=$username;
        $p=$password;
        $cadmin=$this->m_login->cekpengguna($u,$p);
        if($cadmin->num_rows() > 0){
         $this->session->set_userdata('masuk',true);
         $this->session->set_userdata('user',$u);
         $xcadmin=$cadmin->row_array();

            if($xcadmin['pengguna_level']=='plp'){
                $this->session->set_userdata('pengguna_level','plp');
                $idadmin=$xcadmin['pengguna_npak'];
                $user_nama=$xcadmin['pengguna_nama'];
                $this->session->set_userdata('pengguna_npak',$idadmin);
                $this->session->set_userdata('pengguna_nama',$user_nama);
            }
            else if($xcadmin['pengguna_level']=='spi'){
                $this->session->set_userdata('pengguna_level','spi');
                $idadmin=$xcadmin['pengguna_npak'];
                $user_nama=$xcadmin['pengguna_nama'];
                $this->session->set_userdata('pengguna_npak',$idadmin);
                $this->session->set_userdata('pengguna_nama',$user_nama);
            }
            else if($xcadmin['pengguna_level']=='kalab'){
                $this->session->set_userdata('pengguna_level','kalab');
                $idadmin=$xcadmin['pengguna_npak'];
                $user_nama=$xcadmin['pengguna_nama'];
                $this->session->set_userdata('pengguna_npak',$idadmin);
                $this->session->set_userdata('pengguna_nama',$user_nama);
            }
            else if($xcadmin['pengguna_level']=='kajur'){
                $this->session->set_userdata('pengguna_level','kajur');
                $idadmin=$xcadmin['pengguna_npak'];
                $user_nama=$xcadmin['pengguna_nama'];
                $this->session->set_userdata('pengguna_npak',$idadmin);
                $this->session->set_userdata('pengguna_nama',$user_nama);
            }
        
            if($this->session->userdata('masuk')==true){
                redirect('login/berhasillogin');
            }

        }else{
            redirect('login/gagallogin');
        }
    }

    function berhasillogin(){
        redirect('admin/dashboard');
    }
    function gagallogin(){
        $url=base_url('login');
        echo $this->session->set_flashdata('msg','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button> Username Atau Password Salah</div>');
        redirect($url);
    }
    function logout(){
        $this->session->sess_destroy();
        $url=base_url('login');
        redirect($url);
    }
}