<?php
namespace App\Controllers;
use \Config\App;
use Config\Services;
use App\Models\AppModel;
class Jabatan extends BaseController {
	
	private $appModel;
	
	function __construct(){
		parent::__construct();
		$this->auth->authenticate();
		$this->appModel=new AppModel();
	}
	
	function index()
	{
		$data["title"] 	= "Jabatan";
		$data['mdata']	= $this->appModel->master("jabatan");
		$data['page'] 	= 'jabatan_list';
		return view('index',$data);		
	}
	
	function create()
	{
		if($this->request->getPost()){
			$in["jabatan"] 		= $this->request->getPost('jabatan');
			$in["keterangan"] 	= $this->request->getPost('keterangan');
			$this->appModel->simpanRecord("jabatan",$in);
			$this->session->setFlashdata('info', 'Data berhasil disimpan !');
			return redirect()->to('jabatan');
		}else{
			$data = array();
			$data["title"]	= "Input Jabatan";
			return view('jabatan_create', $data);
		}
	}
	
	function edit($id=null)
	{
		if($this->request->getPost()){
			$in["id_jabatan"]	= $this->request->getPost('id_jabatan');
			$in["jabatan"] 		= $this->request->getPost('jabatan');
			$in["keterangan"] 	= $this->request->getPost('keterangan');
			$this->appModel->updateRecord("jabatan",$in,"id_jabatan");
			$this->session->setFlashdata('info', 'Data berhasil diupdate !');
			return redirect()->to('jabatan');
		}else{
			$id = base64_decode($id);
			$data = array();
			$data["title"]	= "Edit Jabatan";
			$data["mdata"] 	= $this->appModel->editRecord("jabatan","id_jabatan='" . $id . "'")->getRow();
			return view('jabatan_edit', $data);
		}
	}
	
	function remove($id=null)
	{
		if($id!=null){
			$id = base64_decode($id);
			$this->appModel->hapusRecord($id, "id_jabatan", "jabatan");
			$this->session->setFlashdata('info', 'Data berhasil dihapus');
			return redirect()->to('jabatan');
		}
	}
}
