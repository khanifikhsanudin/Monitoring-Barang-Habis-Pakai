<?php
class M_pemakaian extends CI_Model{

  function get_all_pemakaian(){
		$hsl=$this->db->query("SELECT a.pemakaian_id, b.barang_nama, c.laboratorium_nama, a.pemakaian_tgl, CONCAT(a.pemakaian_jumlah,' ',b.barang_satuan) AS pemakaian_jumlah, a.pemakaian_ket FROM pemakaian_bhp a, barang_habis_pakai b, laboratorium c where a.barang_id = b.barang_id and a.laboratorium_id = c.laboratorium_id");
		return $hsl;
	}
	function simpan_pemakaian($barang_id, $laboratorium_id, $pemakaian_tgl, $pemakaian_jumlah, $pemakaian_ket){
		$hsl=$this->db->query("insert into pemakaian_bhp(barang_id, laboratorium_id, pemakaian_tgl, pemakaian_jumlah, pemakaian_ket) values('$barang_id','$laboratorium_id', CURDATE(),'$pemakaian_jumlah','$pemakaian_ket')");
		return $hsl;
	}
	function update_pemakaian($kode, $barang_id, $laboratorium_id, $pemakaian_tgl, $pemakaian_jumlah, $pemakaian_ket){
		$hsl=$this->db->query("UPDATE pemakaian_bhp set barang_id='$barang_id',laboratorium_id='$laboratorium_id',pemakaian_tgl='$pemakaian_tgl',pemakaian_jumlah='$pemakaian_jumlah',pemakaian_ket='$pemakaian_ket' where pemakaian_id='$kode'");
		return $hsl;
	}
	function hapus_pemakaian($kode){
		$hsl=$this->db->query("DELETE from pemakaian_bhp where pemakaian_id='$kode'");
		return $hsl;
	}

	function get_pemakaian_byid($kode){
		$hsl=$this->db->query("SELECT * from pemakaian_bhp where pemakaian_id='$kode'");
		return $hsl;
	}

}