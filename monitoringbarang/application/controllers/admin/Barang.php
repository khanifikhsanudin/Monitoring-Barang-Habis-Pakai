<?php
class Barang extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('login');
            redirect($url);
		};
		$this->load->model('M_laboratorium','m_laboratorium');
		$this->load->model('M_barang','m_barang');
		$this->load->model('M_pengguna','m_pengguna');
	}

	function index(){
		$x['labplp']=$this->m_laboratorium->get_lab_byplp($this->session->userdata('pengguna_npak'));
		$x['data2']=$this->m_barang->get_all_barang();
		$x['data3']=$this->m_barang->get_all_barang_detail();
		$this->load->view('admin/v_barang', $x);
	}

	function set_limit(){
		$bid=htmlspecialchars($this->input->post('xbid'),ENT_QUOTES);
		$laboratorium_id=htmlspecialchars($this->input->post('xlab'),ENT_QUOTES);
		$limit=htmlspecialchars($this->input->post('xlimit'),ENT_QUOTES);
		$this->m_barang->set_limit($bid, $laboratorium_id, $limit);	
		echo $this->session->set_flashdata('msg','set-success');
		redirect('admin/barang');
	}
}
