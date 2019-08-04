<?php
class M_pengajuan_baru extends CI_Model{

  function get_all_pengajuan_baru(){
		$hsl=$this->db->query("SELECT a.pengajuan_id, b.laboratorium_nama, a.pengajuan_nama, a.barang_nama_baru, a.barang_jumlah_baru, a.barang_satuan_baru, a.pengajuan_tgl, a.konfirmasi_kalab, a.konfirmasi_kajur, a.tgl_konfirmasi_kajur, a.tgl_konfirmasi_kalab FROM pengajuan_bhp_baru a, laboratorium b where a.laboratorium_id = b.laboratorium_id;");
		return $hsl;
	}
	function simpan_pengajuan_baru($laboratorium_id,$pengajuan_nama,$barang_nama_baru,$barang_satuan_baru,$barang_jumlah_baru,$konfirmasi_kalab,$konfirmasi_kajur){
		$hsl=$this->db->query("insert into pengajuan_bhp_baru(laboratorium_id,pengajuan_nama,barang_nama_baru,barang_satuan_baru,barang_jumlah_baru,pengajuan_tgl,konfirmasi_kalab,konfirmasi_kajur) values('$laboratorium_id','$pengajuan_nama','$barang_nama_baru','$barang_satuan_baru','$barang_jumlah_baru',CURDATE(),'$konfirmasi_kalab','$konfirmasi_kajur')");
		return $hsl;
    }
    
    //untuk plp
	function update_pengajuan_baru($kode,$barang_nama_baru,$barang_satuan_baru,$barang_jumlah_baru){
		$hsl=$this->db->query("update pengajuan_bhp_baru set barang_nama_baru='$barang_nama_baru',barang_satuan_baru='$barang_satuan_baru',barang_jumlah_baru='$barang_jumlah_baru',pengajuan_tgl=CURDATE() where pengajuan_id='$kode'");
		return $hsl;
    }

  function konfirmasi_kalab($kode,$konfirmasi_kalab){
			$hsl=$this->db->query("update pengajuan_bhp_baru set konfirmasi_kalab='$konfirmasi_kalab',tgl_konfirmasi_kalab=CURDATE() where pengajuan_id='$kode'");
			return $hsl;
	}

	function konfirmasi_kajur($kode,$konfirmasi_kajur){
		$hsl=$this->db->query("update pengajuan_bhp_baru set konfirmasi_kajur='$konfirmasi_kajur',tgl_konfirmasi_kajur=CURDATE() where pengajuan_id='$kode'");
		return $hsl;
	}
    
	function hapus_pengajuan_baru($kode){
		$hsl=$this->db->query("delete from pengajuan_bhp_baru where pengajuan_id='$kode'");
		return $hsl;
	}

	function get_pengajuan_baru_byid($kode){
		$hsl=$this->db->query("select * from pengajuan_bhp_baru where pengajuan_id='$kode'");
		return $hsl;
	}

}