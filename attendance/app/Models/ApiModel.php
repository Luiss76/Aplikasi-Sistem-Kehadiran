<?php
namespace App\Models;
use CodeIgniter\Model;
class ApiModel extends Model
{
	protected $table= 'absensi';
	
	public function __construct()
    {
        parent::__construct();
		$this->year =date('Y');
    }
	
	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	function master($master)
	{
		$q = $this->db->query("select * from $master");
		return $q;
	}
	
	function simpanRecord($tabel, $data)
	{
		$this->db->table($tabel)->insert($data);
		return ($this->db->affectedRows() != 1) ? false : true;
	}

	function editRecord($tabel, $seleksi)
	{
		return $this->db->query("select * from $tabel where $seleksi");
	}

	function updateRecord($tabel, $isi, $seleksi)
	{
		$this->db->table($tabel)->where($seleksi, $isi[$seleksi])->update($isi);
		return ($this->db->affectedRows() != 1) ? false : true;
	}
	
	function hapusRecord($id, $seleksi, $tabel)
	{
		$this->db->table($tabel)->where($seleksi,$id)->delete();
		return ($this->db->affectedRows() != 1) ? false : true;
	}
	
	function recordDetail($tabel, $seleksi)
	{
		return $this->db->query("select * from $tabel where $seleksi limit 1");
	}
	
	function cekData($tabel, $seleksi)
	{
		$mdata=$this->db->table($tabel)->where($seleksi)->get();
		return ($mdata->getNumRows() > 0) ? false : true;
	}
	
	function updateData($tabel, $seleksi,$isi)
	{
		$this->db->table($tabel)->where($seleksi)->update($isi);
		return ($this->db->affectedRows() != 1) ? false : true;
	}
	
	
	function TotalData($tables)
	{
		$query = $this->db->query("SELECT * FROM ".$tables."");
		return $query->getNumRows();
	}
	
	function login($username=null,$password=null)
	{
		$query = $this->db->query("SELECT a.*
									FROM pegawai a
									WHERE a.nik='".$username."'
									AND a.password='".$password."'");
		return $query;
	}
	
	function akun($id=null)
	{
		$query = $this->db->query("SELECT a.*,b.jabatan,c.departemen,d.jenjang,e.lokasi
									,TIMESTAMPDIFF( YEAR, a.tanggal_masuk, now() ) as year
									,TIMESTAMPDIFF( MONTH, a.tanggal_masuk, now() ) % 12 as month
									FROM pegawai a
									LEFT JOIN jabatan b on b.id_jabatan=a.id_jabatan
									LEFT JOIN departemen c on c.id_departemen=a.id_departemen
									LEFT JOIN pendidikan d on d.id_pendidikan=a.id_pendidikan
									LEFT JOIN lokasi e on e.id_lokasi=a.id_lokasi
									WHERE a.id_pegawai='".$id."'
									LIMIT 1");
		return $query;
	}
	
	function absensi($id=null)
	{
		$query = $this->db->query("SELECT a.*,b.nik,b.nama,c.lokasi
									FROM absensi a
									LEFT JOIN pegawai b on b.id_pegawai=a.id_pegawai
									LEFT JOIN lokasi c on c.id_lokasi=a.id_pegawai
									WHERE a.id_pegawai='".$id."'
									ORDER BY a.tanggal ASC");
		return $query;
	}
	
	
	function map($id)
	{
		$query = $this->db->query("SELECT a.*
									FROM lokasi a
									LEFT JOIN pegawai b ON b.id_lokasi=a.id_lokasi
									WHERE b.id_pegawai='".$id."'");
		return $query;
	}
	
	function absensiCek($param=null)
	{
		if($param!=null){
			$query = $this->db->query("SELECT a.*
										FROM absensi a
										WHERE a.id_pegawai='".$param['id_pegawai']."' 
										AND a.tanggal='".$param['tanggal']."'");
		
			
			if($query->getNumRows()>0){
				return $query->getRow()->id_absensi;
			}
		}
		return false;
	}
	
}