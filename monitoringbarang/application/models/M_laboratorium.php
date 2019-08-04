<?php
class M_laboratorium extends CI_Model{

  	function get_all_laboratorium(){
		$hsl=$this->db->query("SELECT a.laboratorium_id as laboratorium_id, a.laboratorium_nama as laboratorium_nama, b.pengguna_npak as pengguna_npak, b.pengguna_nama as pengguna_nama FROM laboratorium a, pengguna b where a.pengguna_npak = b.pengguna_npak");
		return $hsl;
	}
	function get_lab_byplp($npak_plp){
		$hsl=$this->db->query("SELECT * from  laboratorium WHERE pengguna_npak = '$npak_plp'");
		return $hsl;
	}
	function simpan_laboratorium($laboratorium_nama,$pengguna_npak){
		$hsl=$this->db->query("insert into laboratorium(laboratorium_nama,pengguna_npak) values('$laboratorium_nama','$pengguna_npak')");
		return $hsl;
	}
	function update_laboratorium($kode,$laboratorium_nama,$pengguna_npak){
		$hsl=$this->db->query("update laboratorium set laboratorium_nama='$laboratorium_nama',pengguna_npak='$pengguna_npak' where laboratorium_id='$kode'");
		return $hsl;
	}
	function hapus_laboratorium($kode){
		$hsl=$this->db->query("delete from laboratorium where laboratorium_id='$kode'");
		return $hsl;
	}

	function get_laboratorium_byid($kode){
		$hsl=$this->db->query("select * from laboratorium where laboratorium_id='$kode'");
		return $hsl;
	}
}