<?php
class M_pengguna extends CI_Model{

	function get_all_pengguna(){
		$hsl=$this->db->query("SELECT pengguna.*,IF(pengguna_jenkel='L','Laki-Laki','Perempuan') AS jenkel FROM pengguna");
		return $hsl;	
	}

	function get_all_plp(){
		$hsl=$this->db->query("SELECT pengguna_npak,pengguna_nama FROM pengguna WHERE pengguna_level = 'plp'");
		return $hsl;
	}

	function get_all_plp_new(){
		$hsl=$this->db->query("SELECT a.pengguna_npak,a.pengguna_nama FROM (SELECT pengguna_npak,pengguna_nama FROM pengguna WHERE pengguna_level = 'plp') AS a LEFT JOIN laboratorium b ON a.pengguna_npak = b.pengguna_npak WHERE b.pengguna_npak IS NULL;");
		return $hsl;
	}

	function simpan_pengguna($npak,$nama,$jenkel,$username,$password,$gambar,$level){
		$hsl=$this->db->query("INSERT INTO pengguna (pengguna_npak,pengguna_nama,pengguna_jenkel,pengguna_username,pengguna_password,pengguna_foto,pengguna_level) VALUES ('$npak','$nama','$jenkel','$username',md5('$password'),'$gambar','$level')");
		return $hsl;
	}

	function simpan_pengguna_tanpa_gambar($npak,$nama,$jenkel,$username,$password,$level){
		$hsl=$this->db->query("INSERT INTO pengguna (pengguna_npak,pengguna_nama,pengguna_jenkel,pengguna_username,pengguna_password,pengguna_level) VALUES ('$npak','$nama','$jenkel','$username',md5('$password'),'$level')");
		return $hsl;
	}

	//UPDATE pengguna //
	function update_pengguna_tanpa_pass($kode,$nama,$jenkel,$username,$password,$gambar,$level){
		$hsl=$this->db->query("UPDATE pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_foto='$gambar',pengguna_level='$level' where pengguna_npak='$kode'");
		return $hsl;
	}
	function update_pengguna($kode,$nama,$jenkel,$username,$password,$gambar,$level){
		$hsl=$this->db->query("UPDATE pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_password=md5('$password'),pengguna_foto='$gambar',pengguna_level='$level' where pengguna_npak='$kode'");
		return $hsl;
	}

	function update_pengguna_tanpa_pass_dan_gambar($kode,$nama,$jenkel,$username,$password,$level){
		$hsl=$this->db->query("UPDATE pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_level='$level' where pengguna_npak='$kode'");
		return $hsl;
	}
	function update_pengguna_tanpa_gambar($kode,$nama,$jenkel,$username,$password,$level){
		$hsl=$this->db->query("UPDATE pengguna set pengguna_nama='$nama',pengguna_jenkel='$jenkel',pengguna_username='$username',pengguna_password=md5('$password'),pengguna_level='$level' where pengguna_npak='$kode'");
		return $hsl;
	}
	//END UPDATE pengguna//

	function hapus_pengguna($kode){
		$hsl=$this->db->query("DELETE FROM pengguna where pengguna_npak='$kode'");
		return $hsl;
	}
	function getusername($id){
		$hsl=$this->db->query("SELECT * FROM pengguna where pengguna_npak='$id'");
		return $hsl;
	}
	function reset_password($id,$pass){
		$hsl=$this->db->query("UPDATE pengguna set pengguna_password=md5('$pass') where pengguna_npak='$id'");
		return $hsl;
	}

	function get_pengguna_login($kode){
		$hsl=$this->db->query("SELECT * FROM pengguna where pengguna_npak='$kode'");
		return $hsl;
	}


}