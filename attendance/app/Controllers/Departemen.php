<?php
namespace App\Controllers;
use \Config\App;
use Config\Services;
use App\Models\AppModel;
class Departemen extends BaseController {
	
	private $appModel;
	
	function __construct(){
		parent::__construct();
		$this->auth->authenticate();
		$this->appModel=new AppModel();
	}
	
	function index()
	{
		$data["title"] 	= "Departemen";
		$data['mdata']	= $this->appModel->master("departemen");
		$data['page'] 	= 'departemen_list';
		return view('index',$data);		
	}
	
	function create()
	{
		if($this->request->getPost()){
			$in["departemen"] 	= $this->request->getPost('departemen');
			$in["keterangan"] 	= $this->request->getPost('keterangan');
			$this->appModel->simpanRecord("departemen",$in);
			$this->session->setFlashdata('info', 'Data berhasil disimpan !');
			return redirect()->to('departemen');
		}else{
			$data = array();
			$data["title"]	= "Input Departemen";
			return view('departemen_create', $data);
		}
	}
	
	function edit($id=null)
	{
		if($this->request->getPost()){
			$in["id_departemen"]= $this->request->getPost('id_departemen');
			$in["departemen"] 	= $this->request->getPost('departemen');
			$in["keterangan"] 	= $this->request->getPost('keterangan');
			$this->appModel->updateRecord("departemen",$in,"id_departemen");
			$this->session->setFlashdata('info', 'Data berhasil diupdate !');
			return redirect()->to('departemen');
		}else{
			$id = base64_decode($id);
			$data = array();
			$data["title"]	= "Edit Departemen";
			$data["mdata"] 	= $this->appModel->editRecord("departemen","id_departemen='" . $id . "'")->getRow();
			return view('departemen_edit', $data);
		}
	}
	
	function remove($id=null)
	{
		if($id!=null){
			$id = base64_decode($id);
			$this->appModel->hapusRecord($id, "id_departemen", "departemen");
			$this->session->setFlashdata('info', 'Data berhasil dihapus');
			return redirect()->to('departemen');
		}
	}
}
