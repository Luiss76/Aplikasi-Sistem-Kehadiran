<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Auth;
class AppModel extends Model
{
	var $auth;
	var $year;
	protected $table= 'absensi';
	
	public function __construct()
    {
        parent::__construct();
		$this->auth =new Auth();
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
	
	function cekUsername($username=null)
	{
		$query = $this->db->query("SELECT a.id_admin FROM admin a WHERE a.username='".$username."'");
		$status=($query->getNumRows()>0) ? false : true;
		return $status;
	}

	function myaccount()
	{
		$query = $this->db->query("SELECT a.*
									FROM admin a
									WHERE a.id_admin='".$this->auth->userid."'
									LIMIT 1");
		return $query->getRow();
	}
	
	function absensi_list()
	{
		$query = $this->db->query("SELECT a.*,b.nik,b.nama,c.lokasi
									FROM absensi a
									LEFT JOIN pegawai b on b.id_pegawai=a.id_pegawai
									LEFT JOIN lokasi c on c.id_lokasi=a.id_pegawai
									ORDER BY a.tanggal ASC");
		return $query;
	}
	
	function pegawai_list()
	{
		$query = $this->db->query("SELECT a.*,b.jabatan,c.departemen,d.jenjang,e.lokasi
									,TIMESTAMPDIFF( YEAR, a.tanggal_masuk, now() ) as year
									,TIMESTAMPDIFF( MONTH, a.tanggal_masuk, now() ) % 12 as month
									FROM pegawai a
									LEFT JOIN jabatan b on b.id_jabatan=a.id_jabatan
									LEFT JOIN departemen c on c.id_departemen=a.id_departemen
									LEFT JOIN pendidikan d on d.id_pendidikan=a.id_pendidikan
									LEFT JOIN lokasi e on e.id_lokasi=a.id_lokasi
									ORDER BY a.nik ASC");
		return $query;
	}
	
	function pegawai_detail($id=null)
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
	
	function pegawai_absensi($id=null)
	{
		$query = $this->db->query("SELECT a.*,b.nik,b.nama,c.lokasi
									FROM absensi a
									LEFT JOIN pegawai b on b.id_pegawai=a.id_pegawai
									LEFT JOIN lokasi c on c.id_lokasi=a.id_pegawai
									WHERE a.id_pegawai='".$id."'
									ORDER BY a.tanggal ASC");
		return $query;
	}
	
	
	function LokasiMap()
	{
		$dataset=[];
		$query = $this->db->query("SELECT a.* FROM lokasi a ORDER BY a.id_lokasi ASC");
		if($query->getNumRows()>0){
			foreach($query->getResult() as $row){
				$data = array(
					'latitude' => $row->latitude,
					'longitude' => $row->longitude,
					'nama' => $row->lokasi, 
					'alamat' => $row->alamat,
				);
				array_push($dataset, $data);
			}
		}
		return $dataset;
	}
}