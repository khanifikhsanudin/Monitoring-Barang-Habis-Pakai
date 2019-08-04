<?php
class M_barang extends CI_Model{

  	function get_all_barang(){
		$hsl=$this->db->query("SELECT a.barang_id, a.barang_nama, a.barang_satuan, sum(b.barang_jumlah) AS jumlah_total_sisa FROM barang_habis_pakai a, jml_bhp b WHERE a.barang_id = b.barang_id GROUP BY a.barang_id;");
		return $hsl;
	}
	function get_all_barang_detail(){
		$hsl=$this->db->query("SELECT a.barang_id, a.barang_nama, CONCAT(b.barang_jumlah,' ',a.barang_satuan) AS jumlah_barang, c.laboratorium_nama, c.laboratorium_id, b.barang_limit from barang_habis_pakai a, jml_bhp b, laboratorium c WHERE a.barang_id = b.barang_id AND b.laboratorium_id = c.laboratorium_id ORDER BY c.laboratorium_nama ASC;");
		return $hsl;
	}
	function get_all_barang_lab($laboratorium_id){
		$hsl=$this->db->query("SELECT a.barang_id, a.barang_nama, a.barang_satuan, sum(b.barang_jumlah) AS sisa FROM barang_habis_pakai a, jml_bhp b WHERE a.barang_id = b.barang_id and b.laboratorium_id = '$laboratorium_id' GROUP BY a.barang_id, b.laboratorium_id;");
		return $hsl;
	}
	function simpan_barang($barang_nama,$barang_satuan){
		$hsl=$this->db->query("insert into barang_habis_pakai(barang_nama,barang_satuan) values('$barang_nama','$barang_satuan')");
		return $hsl;
	}
	function simpan_jml_bhp($barang_id,$laboratorium_id,$barang_jumlah){
		$hsl=$this->db->query("insert into jml_bhp(barang_id,laboratorium_id,barang_jumlah) values('$barang_id','$laboratorium_id','$barang_jumlah')");
		return $hsl;
	}
	function update_barang($kode,$barang_nama,$pengguna_npak){
		$hsl=$this->db->query("update barang set barang_nama='$barang_nama',pengguna_npak='$pengguna_npak' where barang_id='$kode'");
		return $hsl;
	}
	function update_jml_barang($kode,$laboratorium_id, $jml){
		$hsl=$this->db->query("update jml_bhp set barang_jumlah='$jml' where barang_id='$kode' and laboratorium_id='$laboratorium_id'");
		return $hsl;
	}
	function hapus_barang($kode){
		$hsl=$this->db->query("delete from barang where barang_id='$kode'");
		return $hsl;
	}

	function get_barang_byid($kode){
		$hsl=$this->db->query("select * from barang where barang_id='$kode'");
		return $hsl;
	}

	function set_limit($bid, $laboratorium_id, $jml){
		$hsl=$this->db->query("update jml_bhp set barang_limit='$jml' where barang_id='$bid' and laboratorium_id='$laboratorium_id'");
		return $hsl;
	}

}