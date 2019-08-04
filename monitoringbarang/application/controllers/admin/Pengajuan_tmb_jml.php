<?php
class Pengajuan_tmb_jml extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url('login');
            redirect($url);
		};
		$this->load->model('M_laboratorium','m_laboratorium');
		$this->load->model('M_pengajuan_tmb_jml','m_pengajuan_tmb_jml');
		$this->load->model('M_barang','m_barang');
		$this->load->model('M_pemakaian','m_pemakaian');
		$this->load->model('M_pengguna','m_pengguna');
	}

	function index(){
		$x['labplp']=$this->m_laboratorium->get_lab_byplp($this->session->userdata('pengguna_npak'));
		$x['data2']=$this->m_pengajuan_tmb_jml->get_all_pengajuan_tmb_jml();
		$this->load->view('admin/v_pengajuan_tmb_jml', $x);
	}

	function simpan_pengajuan_tmb_jml(){
		$laboratorium_id=htmlspecialchars($this->input->post('xlab'),ENT_QUOTES);
		$pengajuan_tmb_nama=$this->session->userdata('pengguna_nama');
		$barang_jumlah=htmlspecialchars($this->input->post('xjmlbrg'),ENT_QUOTES);
		$barang_id=htmlspecialchars($this->input->post('xidbarang'),ENT_QUOTES);
		$konfirmasi_kalab="waiting";
		$konfirmasi_kajur="waiting";

		$this->m_pengajuan_tmb_jml->simpan_pengajuan_tmb_jml($pengajuan_tmb_nama,$laboratorium_id,$barang_id,$barang_jumlah,$konfirmasi_kalab,$konfirmasi_kajur);
		echo $this->session->set_flashdata('msg','success');
		redirect('admin/pengajuan_tmb_jml');
		
	}

	function update_pengajuan_tmb_jml(){
		$kode=htmlspecialchars($this->input->post('kode'),ENT_QUOTES);
        $barang_id=htmlspecialchars($this->input->post('xidbarang'),ENT_QUOTES);
		$barang_jumlah=htmlspecialchars($this->input->post('xjmlbrg'),ENT_QUOTES);
		$this->m_pengajuan_tmb_jml->update_pengajuan_tmb_jml($kode,$barang_id,$barang_jumlah);
		echo $this->session->set_flashdata('msg','info');
		redirect('admin/pengajuan_tmb_jml');
	}

	function hapus_pengajuan_tmb_jml(){
		$kode=$this->input->post('kode');
		$this->m_pengajuan_tmb_jml->hapus_pengajuan_tmb_jml($kode);
		echo $this->session->set_flashdata('msg','success-hapus');
		redirect('admin/pengajuan_tmb_jml');
	}

	function konfirmasi_kalab(){
		$kode=$this->input->post('kode');
		$konfirmasi=htmlspecialchars($this->input->post('xkonfirm'),ENT_QUOTES);
		$this->m_pengajuan_tmb_jml->konfirmasi_kalab($kode,$konfirmasi);
		
		$query=$this->db->query("SELECT * FROM pengajuan_tmb_jml_bhp WHERE pengajuan_tmb_id = $kode;");
		$dtb = $query->row_array();
		$barang_id=$dtb["barang_id"];
		$laboratorium_id=$dtb["laboratorium_id"];

		if($dtb["konfirmasi_kalab"] == "diterima" && $dtb["konfirmasi_kajur"] == "diterima"){
			$query=$this->db->query("SELECT a.barang_id, a.barang_nama, a.barang_satuan, sum(b.barang_jumlah) AS sisa FROM barang_habis_pakai a, jml_bhp b WHERE a.barang_id = b.barang_id and b.laboratorium_id = '$laboratorium_id' and a.barang_id = '$barang_id' GROUP BY a.barang_id, b.laboratorium_id;");
			$sisa = $query->row_array()["sisa"];
			$jml = $sisa + $dtb["barang_jumlah"];
			$this->m_barang->update_jml_barang($barang_id,$laboratorium_id, $jml);
		}

		if ($konfirmasi=="diterima"){
			echo $this->session->set_flashdata('msg','success-konfirm');
		}else{
			echo $this->session->set_flashdata('msg','success-tolak');
		}
		redirect('admin/pengajuan_tmb_jml');
	}

	function konfirmasi_kajur(){
		$kode=$this->input->post('kode');
		$konfirmasi=htmlspecialchars($this->input->post('xkonfirm'),ENT_QUOTES);
		$this->m_pengajuan_tmb_jml->konfirmasi_kajur($kode,$konfirmasi);

		$query=$this->db->query("SELECT * FROM pengajuan_tmb_jml_bhp WHERE pengajuan_tmb_id = $kode;");
		$dtb = $query->row_array();
		$barang_id=$dtb["barang_id"];
		$laboratorium_id=$dtb["laboratorium_id"];

		if($dtb["konfirmasi_kalab"] == "diterima" && $dtb["konfirmasi_kajur"] == "diterima"){
			$query=$this->db->query("SELECT a.barang_id, a.barang_nama, a.barang_satuan, sum(b.barang_jumlah) AS sisa FROM barang_habis_pakai a, jml_bhp b WHERE a.barang_id = b.barang_id and b.laboratorium_id = '$laboratorium_id' and a.barang_id = '$barang_id' GROUP BY a.barang_id, b.laboratorium_id;");
			$sisa = $query->row_array()["sisa"];
			$jml = $sisa + $dtb["barang_jumlah"];
			$this->m_barang->update_jml_barang($barang_id,$laboratorium_id, $jml);
		}

		if ($konfirmasi=="diterima"){
			echo $this->session->set_flashdata('msg','success-konfirm');
		}else{
			echo $this->session->set_flashdata('msg','success-tolak');
		}
		redirect('admin/pengajuan_tmb_jml');
	}
}
