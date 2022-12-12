<?php
namespace App\Controllers;
use \Config\App;
use Config\Services;
use App\Models\AppModel;
class Pegawai extends BaseController {
	
	private $appModel;
	
	function __construct(){
		parent::__construct();
		$this->auth->authenticate();
		$this->appModel=new AppModel();
	}
	
	function index()
	{
		$data["title"] 	= "Pegawai";
		$data['page'] 	= 'pegawai_list';
		$data['mdata'] 	= $this->appModel->pegawai_list();
		return view('index',$data);		
	}
	
	function create()
	{
		if($this->request->getPost()){
			$in["id_jabatan"] 			= $this->request->getPost('id_jabatan');
			$in["id_departemen"] 		= $this->request->getPost('id_departemen');
			$in["id_pendidikan"] 		= $this->request->getPost('id_pendidikan');
			$in["id_lokasi"] 			= $this->request->getPost('id_lokasi');
			$in["nama"] 				= $this->request->getPost('nama');
			$in["nik"] 					= $this->request->getPost('nik');
			$in["nama"] 				= $this->request->getPost('nama');
			$in["tempat_lahir"] 		= $this->request->getPost('tempat_lahir');
			$in["tanggal_lahir"] 		= $this->request->getPost('tanggal_lahir');
			$in["jenis_kelamin"] 		= $this->request->getPost('jenis_kelamin');
			$in["status_pernikahan"] 	= $this->request->getPost('status_pernikahan');
			$in["tanggal_masuk"] 		= $this->request->getPost('tanggal_masuk');
			$in["alamat"] 				= $this->request->getPost('alamat');
			$in["telepon"] 				= $this->request->getPost('telepon');
			$in["email"] 				= $this->request->getPost('email');
			$in["password"] 			= $this->request->getPost('password');
			$in["status"] 				= $this->request->getPost('status');
			if(!empty($_FILES['foto']['name'])){
				$xfile = $this->request->getFile('foto');
				$filename=date('ymdhis').'-'.$xfile->getRandomName();
				$filepath=ROOTPATH.'public/uploads/pegawai/';
				$xfile->move($filepath, $filename);
				$in["foto"]=$filename;
			}
			$this->appModel->simpanRecord("pegawai",$in);
			$this->session->setFlashdata('info', 'Data berhasil disimpan !');
			return redirect()->to('pegawai');
			
		}else{
			$data = array();
			$data["title"]		= "Create Pegawai";
			$data['mjabatan']	= $this->appModel->master("jabatan");
			$data['mdepartemen']= $this->appModel->master("departemen");
			$data['mpendidikan']= $this->appModel->master("pendidikan");
			$data['mlokasi']	= $this->appModel->master("lokasi");
			$data['mgender']	= array('Pria','Wanita');
			$data['mpernikahan']= array('Single','Menikah','Janda','Duda');
			$data['mstatus']	= array('Aktif','Non Aktif');
			return view('pegawai_create', $data);
		}
	}
	
	function edit($id=null)
	{
		if($this->request->getPost()){
			$in["id_pegawai"]			= $this->request->getPost('id_pegawai');
			$in["id_jabatan"] 			= $this->request->getPost('id_jabatan');
			$in["id_departemen"] 		= $this->request->getPost('id_departemen');
			$in["id_pendidikan"] 		= $this->request->getPost('id_pendidikan');
			$in["id_lokasi"] 			= $this->request->getPost('id_lokasi');
			$in["nama"] 				= $this->request->getPost('nama');
			$in["nik"] 					= $this->request->getPost('nik');
			$in["nama"] 				= $this->request->getPost('nama');
			$in["tempat_lahir"] 		= $this->request->getPost('tempat_lahir');
			$in["tanggal_lahir"] 		= $this->request->getPost('tanggal_lahir');
			$in["jenis_kelamin"] 		= $this->request->getPost('jenis_kelamin');
			$in["status_pernikahan"] 	= $this->request->getPost('status_pernikahan');
			$in["tanggal_masuk"] 		= $this->request->getPost('tanggal_masuk');
			$in["alamat"] 				= $this->request->getPost('alamat');
			$in["telepon"] 				= $this->request->getPost('telepon');
			$in["email"] 				= $this->request->getPost('email');
			$in["status"] 				= $this->request->getPost('sttaus');
			$newpassword				= $this->request->getPost('newpassword');
			if($newpassword!=''){
				$in["status"]=$newpasword;
			}
			if(!empty($_FILES['foto']['name'])){
				$xfile = $this->request->getFile('foto');
				$filename=date('ymdhis').'-'.$xfile->getRandomName();
				$filepath=ROOTPATH.'public/uploads/pegawai/';
				$xfile->move($filepath, $filename);
				$in["foto"]=$filename;
			}
			$this->appModel->updateRecord("pegawai",$in,"id_pegawai");
			$this->session->setFlashdata('info', 'Data berhasil disimpan !');
			return redirect()->to('pegawai');
		}else{
			$id = base64_decode($id);
			$data = array();
			$data["title"]		= "Edit Pegawai";
			$data['mjabatan']	= $this->appModel->master("jabatan");
			$data['mdepartemen']= $this->appModel->master("departemen");
			$data['mpendidikan']= $this->appModel->master("pendidikan");
			$data['mlokasi']	= $this->appModel->master("lokasi");
			$data['mgender']	= array('Pria','Wanita');
			$data['mpernikahan']= array('Single','Menikah','Janda','Duda');
			$data['mstatus']	= array('Aktif','Non Aktif');
			$data["mdata"] 		= $this->appModel->editRecord("pegawai","id_pegawai='" . $id . "'")->getRow();
			return view('pegawai_edit', $data);
		}
	}
	
	function detail($id=null)
	{
		$data=array();
		$id = base64_decode($id);
		$data['title'] 		= "Detail Pegawai";
		$data['page'] 		= 'pegawai_detail';
		$data['mdata']		= $this->appModel->pegawai_detail($id)->getRow();
		$data['mabsensi']	= $this->appModel->pegawai_absensi($id);
		return view('index', $data);
	}
	
	function remove($id=null)
	{
		if($id!=null){
			$id = base64_decode($id);
			$this->appModel->hapusRecord($id, "id_pegawai", "pegawai");
			$this->session->setFlashdata('info', 'Data berhasil dihapus');
			return redirect()->to('pegawai');
		}
	}
}
