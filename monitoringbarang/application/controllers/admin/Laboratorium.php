<?php
class Laboratorium extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('login');
            redirect($url);
		};
		$this->load->model('M_laboratorium','m_laboratorium');
		$this->load->model('M_pengguna','m_pengguna');
	}

	function index(){
		$x['plp']=$this->m_pengguna->get_all_plp_new();
		$x['data2']=$this->m_laboratorium->get_all_laboratorium();
		$this->load->view('admin/v_laboratorium', $x);
	}

	function simpan_laboratorium(){
        $laboratorium_nama=htmlspecialchars($this->input->post('xnamalab'),ENT_QUOTES);
        $pengguna_npak=htmlspecialchars($this->input->post('xplp'),ENT_QUOTES);
		$this->m_laboratorium->simpan_laboratorium($laboratorium_nama,$pengguna_npak);	
		echo $this->session->set_flashdata('msg','success');
		redirect('admin/laboratorium');
	}

	function update_laboratorium(){
		$kode=htmlspecialchars($this->input->post('kode'),ENT_QUOTES);
		$laboratorium_nama=htmlspecialchars($this->input->post('xnamalab'),ENT_QUOTES);
        $pengguna_npak=htmlspecialchars($this->input->post('xplp'),ENT_QUOTES);
		$this->m_laboratorium->update_laboratorium($kode,$laboratorium_nama,$pengguna_npak);	
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/laboratorium');
	}

	function hapus_laboratorium(){
		$kode=$this->input->post('kode');
		$this->m_laboratorium->hapus_laboratorium($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/laboratorium');
	}

}
