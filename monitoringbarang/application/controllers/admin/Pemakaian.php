<?php
class Pemakaian extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('login');
			redirect($url);
		};
		$this->load->model('M_pemakaian','m_pemakaian');
		$this->load->model('M_laboratorium','m_laboratorium');
		$this->load->model('M_barang','m_barang');
		$this->load->model('M_pengguna','m_pengguna');
	}

	function index(){
		$x['labplp']=$this->m_laboratorium->get_lab_byplp($this->session->userdata('pengguna_npak'));
		$x['data2']=$this->m_pemakaian->get_all_pemakaian();
		$this->load->view('admin/v_pemakaian', $x);

	}

	function simpan_pemakaian(){
        $barang_id=htmlspecialchars($this->input->post('xbarang'),ENT_QUOTES);
		$laboratorium_id=htmlspecialchars($this->input->post('xlab'),ENT_QUOTES);
		$pemakaian_jumlah=htmlspecialchars($this->input->post('xjmlbrg'),ENT_QUOTES);
		//tgl curdate()
		$pemakaian_tgl=htmlspecialchars($this->input->post('xjmlbrg'),ENT_QUOTES);
		//pass
		$pemakaian_ket=htmlspecialchars($this->input->post('xket'),ENT_QUOTES);
        $query=$this->db->query("SELECT a.barang_id, a.barang_nama, a.barang_satuan, sum(b.barang_jumlah) AS sisa FROM barang_habis_pakai a, jml_bhp b WHERE a.barang_id = b.barang_id and b.laboratorium_id = '$laboratorium_id' and a.barang_id = '$barang_id' GROUP BY a.barang_id, b.laboratorium_id;");
		$sisa = $query->row_array()["sisa"];
		if ($pemakaian_jumlah < $sisa && $pemakaian_jumlah > 0){
			$jml = $sisa - $pemakaian_jumlah;
			$this->m_pemakaian->simpan_pemakaian($barang_id, $laboratorium_id, $pemakaian_tgl, $pemakaian_jumlah, $pemakaian_ket);	
			$this->m_barang->update_jml_barang($barang_id,$laboratorium_id, $jml);
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/pemakaian');
		}else{
			echo $this->session->set_flashdata('msg','error-num');
			redirect('admin/pemakaian');
		}
		
	}
}
