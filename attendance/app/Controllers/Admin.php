<?php
namespace App\Controllers;
use \Config\App;
use Config\Services;
use App\Models\AppModel;
class Admin extends BaseController {
	
	private $appModel;
	
	function __construct(){
		parent::__construct();
		$this->auth->authenticate();
		$this->appModel=new AppModel();
	}
	
	function index()
	{
		$data["title"] 	= "Admin";
		$data['page'] 	= 'admin_list';
		$data['mdata'] 	= $this->appModel->master("admin");
		return view('index',$data);		
	}
	
	function create()
	{
		if($this->request->getPost()){
			$in["roles"] 		= $this->request->getPost('roles');
			$in["nama"] 		= $this->request->getPost('nama');
			$in["email"] 		= $this->request->getPost('email');
			$in["username"] 	= $this->request->getPost('username');
			$in["password"] 	= $this->request->getPost('password');
			if($this->appModel->cekAdminname($in["username"])){
				$this->appModel->simpanRecord("admin",$in);
				$this->session->setFlashdata('info', 'Data berhasil disimpan !');
				return redirect()->to('admin');
			}else{
				$this->session->setFlashdata('info', 'USername sudah terdaftar !');
				return redirect()->to('admin/create');
			}
		}else{
			$data = array();
			$data["title"]		= "Create Admin";
			$data['mroles']		= array('Admin','User');
			return view('admin_create', $data);
		}
	}
	
	function edit($id=null)
	{
		if($this->request->getPost()){
			$in["id_admin"]		= $this->request->getPost('id_admin');
			$in["roles"] 		= $this->request->getPost('roles');
			$in["nama"] 		= $this->request->getPost('nama');
			$in["email"] 		= $this->request->getPost('email');
			$in["username"] 	= $this->request->getPost('username');
			$newpassword		= $this->request->getPost('newpassword');
			if($newpassword!=''){
				$in["password"] = $newpassword;
			}
			$this->appModel->updateRecord("admin",$in,"id_admin");
			$this->session->setFlashdata('info', 'Data berhasil disimpan !');
			return redirect()->to('admin');
		}else{
			$id = base64_decode($id);
			$data = array();
			$data["title"]		= "Edit Admin";
			$data['mroles']		= array('Admin','User');
			$data["mdata"] 		= $this->appModel->editRecord("admin","id_admin='" . $id . "'")->getRow();
			return view('admin_edit', $data);
		}
	}
	
	function remove($id=null)
	{
		if($id!=null){
			$id = base64_decode($id);
			$this->appModel->hapusRecord($id, "id_admin", "admin");
			$this->session->setFlashdata('info', 'Data berhasil dihapus');
			return redirect()->to('admin');
		}
	}
	
	function activate($id=null)
	{
		if($id!=null){
			$id = base64_decode($id);
			$this->appModel->manualQuery("update admin set status='1' where id_admin='".$id."'");
			$this->session->setFlashdata('info', 'Update status data berhasil !');
			return redirect()->to('admin');
		}
	}
	
	function inactive($id=null)
	{
		if($id!=null){
			$id = base64_decode($id);
			$this->appModel->manualQuery("update admin set status='0' where id_admin='".$id."'");
			$this->session->setFlashdata('info', 'Update status data berhasil !');
			return redirect()->to('admin');
		}
	}
}
