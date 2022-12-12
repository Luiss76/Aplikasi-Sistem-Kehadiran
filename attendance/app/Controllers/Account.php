<?php
namespace App\Controllers;
use \Config\App;
use App\Models\AppModel;
class Account extends BaseController
{
	private $appModel;
	
	public function __construct() {
		parent::__construct();	
		$this->auth->authenticate();
		$this->appModel=new AppModel();
	}

	function index()
	{
		$data=array();
		$data["title"] 	= "User Account";
		$data['page'] 	= 'account';
		$data['mdata'] 	= $this->appModel->myaccount($this->auth->userid);
		return view('index',$data);		
	}
	
	
	public function update()
	{
		if($this->request->getPost()){
			$in["id_admin"]  = $this->auth->userid;
			$in["username"] = $this->request->getPost('username');
			$newpassword	= $this->request->getPost('newpassword');
			if($newpassword!=''){
				$in["password"] = password_hash($newpassword, PASSWORD_DEFAULT);
			}
			$this->appModel->updateRecord("admin",$in,"id_admin");
			$this->session->setFlashdata('info', 'Update data akun berhasil !');
			return redirect()->to('account');
		}
	}
	
	public function upload()
	{		
		 if(!empty($_FILES['avatar']['name'])){
			$xfile = $this->request->getFile('avatar');
			$imagex= \Config\Services::image();
			$imagex->withFile($xfile);
			$imagex->resize(100, 100, true, 'height');
			$filename=$this->auth->userid.'-'.$xfile->getRandomName();
			$filepath=ROOTPATH.'public/uploads/admin/';
			$imagex->save($filepath.$filename);
			$in['id']=$this->auth->userid;
			$in['foto']	 =$filename;
			$this->appModel->updateRecord("admin",$in,"id_admin");
			$this->session->set('foto',$filename);
			$this->session->setFlashdata('info','Update foto berhasil !');
			return redirect()->to('account');
		} 
	}
}
