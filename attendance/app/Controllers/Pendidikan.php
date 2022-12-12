<?php
namespace App\Controllers;
use \Config\App;
use Config\Services;
use App\Models\AppModel;
class Pendidikan extends BaseController {
	
	private $appModel;
	
	function __construct(){
		parent::__construct();
		$this->auth->authenticate();
		$this->appModel=new AppModel();
	}
	
	function index()
	{
		$data["title"] 	= "Pendidikan";
		$data['mdata']	= $this->appModel->master("pendidikan");
		$data['page'] 	= 'pendidikan_list';
		return view('index',$data);		
	}
	
	function create()
	{
		if($this->request->getPost()){
			$in["jenjang"] 		= $this->request->getPost('jenjang');
			$in["keterangan"] 	= $this->request->getPost('keterangan');
			$this->appModel->simpanRecord("pendidikan",$in);
			$this->session->setFlashdata('info', 'Data berhasil disimpan !');
			return redirect()->to('pendidikan');
		}else{
			$data = array();
			$data["title"]	= "Input Pendidikan";
			return view('pendidikan_create', $data);
		}
	}
	
	function edit($id=null)
	{
		if($this->request->getPost()){
			$in["id_pendidikan"]= $this->request->getPost('id_pendidikan');
			$in["jenjang"] 		= $this->request->getPost('jenjang');
			$in["keterangan"] 	= $this->request->getPost('keterangan');
			$this->appModel->updateRecord("pendidikan",$in,"id_pendidikan");
			$this->session->setFlashdata('info', 'Data berhasil diupdate !');
			return redirect()->to('pendidikan');
		}else{
			$id = base64_decode($id);
			$data = array();
			$data["title"]	= "Edit Pendidikan";
			$data["mdata"] 	= $this->appModel->editRecord("pendidikan","id_pendidikan='" . $id . "'")->getRow();
			return view('pendidikan_edit', $data);
		}
	}
	
	function remove($id=null)
	{
		if($id!=null){
			$id = base64_decode($id);
			$this->appModel->hapusRecord($id, "id_pendidikan", "pendidikan");
			$this->session->setFlashdata('info', 'Data berhasil dihapus');
			return redirect()->to('pendidikan');
		}
	}
}
