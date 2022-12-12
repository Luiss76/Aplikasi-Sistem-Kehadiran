<?php
namespace App\Controllers;
use \Config\App;
use Config\Services;
use App\Models\AppModel;
class Lokasi extends BaseController {
	
	private $appModel;
	
	function __construct(){
		parent::__construct();
		$this->auth->authenticate();
		$this->appModel=new AppModel();
	}
	
	function index()
	{
		$data["title"] 	= "Lokasi";
		$data['mdata']	= $this->appModel->master("lokasi");
		$data['page'] 	= 'lokasi_list';
		return view('index',$data);		
	}
	
	function create()
	{
		if($this->request->getPost()){
			$in["lokasi"] 		= $this->request->getPost('lokasi');
			$in["alamat"] 		= $this->request->getPost('alamat');
			$in["latitude"] 	= $this->request->getPost('latitude');
			$in["longitude"] 	= $this->request->getPost('longitude');
			$this->appModel->simpanRecord("lokasi",$in);
			$this->session->setFlashdata('info', 'Data berhasil disimpan !');
			return redirect()->to('lokasi');
		}else{
			$data = array();
			$data["title"]	= "Input Lokasi";
			return view('lokasi_create', $data);
		}
	}
	
	function edit($id=null)
	{
		if($this->request->getPost()){
			$in["id_lokasi"]	= $this->request->getPost('id_lokasi');
			$in["lokasi"] 		= $this->request->getPost('lokasi');
			$in["alamat"] 		= $this->request->getPost('alamat');
			$in["latitude"] 	= $this->request->getPost('latitude');
			$in["longitude"] 	= $this->request->getPost('longitude');
			$this->appModel->updateRecord("lokasi",$in,"id_lokasi");
			$this->session->setFlashdata('info', 'Data berhasil diupdate !');
			return redirect()->to('lokasi');
		}else{
			$id = base64_decode($id);
			$data = array();
			$data["title"]	= "Edit Lokasi";
			$data["mdata"] 	= $this->appModel->editRecord("lokasi","id_lokasi='" . $id . "'")->getRow();
			return view('lokasi_edit', $data);
		}
	}
	
	function remove($id=null)
	{
		if($id!=null){
			$id = base64_decode($id);
			$this->appModel->hapusRecord($id, "id_lokasi", "lokasi");
			$this->session->setFlashdata('info', 'Data berhasil dihapus');
			return redirect()->to('lokasi');
		}
	}
}
