<?php
class M_pengajuan_tmb_jml extends CI_Model{

    function get_all_pengajuan_tmb_jml(){
		$hsl=$this->db->query("SELECT a.pengajuan_tmb_id, a.pengajuan_tmb_nama, a.pengajuan_tmb_tgl, b.laboratorium_nama, c.barang_nama, a.barang_jumlah, c.barang_satuan, a.konfirmasi_kalab, a.tgl_konfirmasi_kalab, a.konfirmasi_kajur, a.tgl_konfirmasi_kajur FROM pengajuan_tmb_jml_bhp a, laboratorium b, barang_habis_pakai c where a.laboratorium_id = b.laboratorium_id and a.barang_id = c.barang_id;");
		return $hsl;
	}
	function simpan_pengajuan_tmb_jml($pengajuan_tmb_nama,$laboratorium_id,$barang_id,$barang_jumlah,$konfirmasi_kalab,$konfirmasi_kajur){
		$hsl=$this->db->query("insert into pengajuan_tmb_jml_bhp(pengajuan_tmb_nama,pengajuan_tmb_tgl,laboratorium_id,barang_id,barang_jumlah,konfirmasi_kalab,konfirmasi_kajur) values('$pengajuan_tmb_nama', CURDATE(),'$laboratorium_id','$barang_id','$barang_jumlah','$konfirmasi_kalab','$konfirmasi_kajur')");
		return $hsl;
    }
    
    //untuk plp
	function update_pengajuan_tmb_jml($kode,$barang_id,$barang_jumlah){
		$hsl=$this->db->query("update pengajuan_tmb_jml_bhp set barang_id='$barang_id',barang_jumlah='$barang_jumlah',pengajuan_tmb_tgl=CURDATE() where pengajuan_tmb_id='$kode'");
		return $hsl;
    }

  function konfirmasi_kalab($kode,$konfirmasi_kalab){
			$hsl=$this->db->query("update pengajuan_tmb_jml_bhp set konfirmasi_kalab='$konfirmasi_kalab',tgl_konfirmasi_kalab=CURDATE() where pengajuan_tmb_id='$kode'");
			return $hsl;
	}

	function konfirmasi_kajur($kode,$konfirmasi_kajur){
		$hsl=$this->db->query("update pengajuan_tmb_jml_bhp set konfirmasi_kajur='$konfirmasi_kajur',tgl_konfirmasi_kajur=CURDATE() where pengajuan_tmb_id='$kode'");
		return $hsl;
	}
    
	function hapus_pengajuan_tmb_jml($kode){
		$hsl=$this->db->query("delete from pengajuan_tmb_jml_bhp where pengajuan_tmb_id='$kode'");
		return $hsl;
	}

	function get_pengajuan_tmb_jml_byid($kode){
		$hsl=$this->db->query("select * from pengajuan_tmb_jml_bhp where pengajuan_tmb_id='$kode'");
		return $hsl;
	}

}