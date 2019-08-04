<?php
class Pengajuan_baru extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('login');
            redirect($url);
		};
		$this->load->model('M_laboratorium','m_laboratorium');
		$this->load->model('M_pengajuan_baru','m_pengajuan_baru');
		$this->load->model('M_barang','m_barang');
		$this->load->model('M_pemakaian','m_pemakaian');
		$this->load->model('M_pengguna','m_pengguna');
	}

	function index(){
		$x['labplp']=$this->m_laboratorium->get_lab_byplp($this->session->userdata('pengguna_npak'));
		$x['data2']=$this->m_pengajuan_baru->get_all_pengajuan_baru();
		$this->load->view('admin/v_pengajuan_baru', $x);
	}

	function simpan_pengajuan_baru(){
		$laboratorium_id=htmlspecialchars($this->input->post('xlab'),ENT_QUOTES);
		$pengajuan_nama=$this->session->userdata('pengguna_nama');
        $barang_nama_baru=htmlspecialchars($this->input->post('xnamabarang'),ENT_QUOTES);
		$barang_satuan_baru=htmlspecialchars($this->input->post('xsatuan'),ENT_QUOTES);
		$barang_jumlah_baru=htmlspecialchars($this->input->post('xjmlbrg'),ENT_QUOTES);
		$konfirmasi_kalab="waiting";
		$konfirmasi_kajur="waiting";
		
		$valid = true;
        $query=$this->db->query("SELECT b.barang_nama FROM jml_bhp a, barang_habis_pakai b WHERE a.barang_id = b.barang_id AND a.laboratorium_id =".$laboratorium_id);
		foreach ($query->result_array() as $nama){
			if (strtoupper($nama['barang_nama']) == strtoupper($barang_nama_baru)){
				$valid = false;
			}
		}

		if ($valid){
			$this->m_pengajuan_baru->simpan_pengajuan_baru($laboratorium_id,$pengajuan_nama,$barang_nama_baru,$barang_satuan_baru,$barang_jumlah_baru,$konfirmasi_kalab,$konfirmasi_kajur);
			echo $this->session->set_flashdata('msg','success');
			redirect('admin/pengajuan_baru');
		}else{
			echo $this->session->set_flashdata('msg','error-duplicate');
			redirect('admin/pengajuan_baru');
		}
		
	}

	function update_pengajuan_baru(){
		$kode=htmlspecialchars($this->input->post('kode'),ENT_QUOTES);
        $barang_nama_baru=htmlspecialchars($this->input->post('xnamabarang'),ENT_QUOTES);
		$barang_satuan_baru=htmlspecialchars($this->input->post('xsatuan'),ENT_QUOTES);
		$barang_jumlah_baru=htmlspecialchars($this->input->post('xjmlbrg'),ENT_QUOTES);
		$this->m_pengajuan_baru->update_pengajuan_baru($kode,$barang_nama_baru,$barang_satuan_baru,$barang_jumlah_baru);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/pengajuan_baru');
	}

	function hapus_pengajuan_baru(){
		$kode=$this->input->post('kode');
		$this->m_pengajuan_baru->hapus_pengajuan_baru($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/pengajuan_baru');
	}

	function konfirmasi_kalab(){
		$kode=$this->input->post('kode');
		$konfirmasi=htmlspecialchars($this->input->post('xkonfirm'),ENT_QUOTES);
		$this->m_pengajuan_baru->konfirmasi_kalab($kode,$konfirmasi);
		
		$query=$this->db->query("SELECT * FROM pengajuan_bhp_baru WHERE pengajuan_id = $kode;");
		$dtb = $query->row_array();
		$laboratorium_id=$dtb["laboratorium_id"];

		if($dtb["konfirmasi_kalab"] == "diterima" && $dtb["konfirmasi_kajur"] == "diterima"){
			
			$vd = true;
			$kue=$this->db->query("SELECT a.barang_id as bid, a.barang_nama as bnm FROM barang_habis_pakai a;");
			foreach($kue->result_array() as $i){
				if (strtoupper($i['bnm']) == strtoupper($dtb['barang_nama_baru'])){
					$vd = false;
				}
			}

			if($vd){
				$this->m_barang->simpan_barang($dtb["barang_nama_baru"],$dtb["barang_satuan_baru"]);
			}
			
			$query2 =$this->db->query("SELECT barang_id FROM barang_habis_pakai WHERE barang_nama ='".$dtb['barang_nama_baru']."';");
			$barang_id = $query2->row_array()["barang_id"];
			$this->m_barang->simpan_jml_bhp($barang_id, $laboratorium_id, $dtb["barang_jumlah_baru"]);
		}

		if ($konfirmasi=="diterima"){
			echo $this->session->set_flashdata('msg','success-konfirm');
		}else{
			echo $this->session->set_flashdata('msg','success-tolak');
		}
		redirect('admin/pengajuan_baru');
	}

	function konfirmasi_kajur(){
		$kode=$this->input->post('kode');
		$konfirmasi=htmlspecialchars($this->input->post('xkonfirm'),ENT_QUOTES);
		$this->m_pengajuan_baru->konfirmasi_kajur($kode,$konfirmasi);

		$query=$this->db->query("SELECT * FROM pengajuan_bhp_baru WHERE pengajuan_id = $kode;");
		$dtb = $query->row_array();
		$laboratorium_id=$dtb["laboratorium_id"];

		if($dtb["konfirmasi_kalab"] == "diterima" && $dtb["konfirmasi_kajur"] == "diterima"){
			
			$vd = true;
			$kue=$this->db->query("SELECT a.barang_id as bid, a.barang_nama as bnm FROM barang_habis_pakai a;");
			foreach($kue->result_array() as $i){
				if (strtoupper($i['bnm']) == strtoupper($dtb['barang_nama_baru'])){
					$vd = false;
				}
			}

			if($vd){
				$this->m_barang->simpan_barang($dtb["barang_nama_baru"],$dtb["barang_satuan_baru"]);
			}
			
			$query2 =$this->db->query("SELECT barang_id FROM barang_habis_pakai WHERE barang_nama ='".$dtb['barang_nama_baru']."';");
			$barang_id = $query2->row_array()["barang_id"];
			$this->m_barang->simpan_jml_bhp($barang_id, $laboratorium_id, $dtb["barang_jumlah_baru"]);
		}

		if ($konfirmasi=="diterima"){
			echo $this->session->set_flashdata('msg','success-konfirm');
		}else{
			echo $this->session->set_flashdata('msg','success-tolak');
		}
		redirect('admin/pengajuan_baru');
	}
}
