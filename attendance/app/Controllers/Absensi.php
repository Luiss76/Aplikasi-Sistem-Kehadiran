<?php
namespace App\Controllers;
use \Config\App;
use App\Models\AppModel;
class Absensi extends BaseController
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
		$data["title"] 		= "Absensi";
		$data['page'] 		= 'absensi';
		$data['mdata'] 		= $this->appModel->absensi_list();
		return view('index',$data);		
	}
	
	function remove($id=null)
	{
		if($id!=null){
			$id = base64_decode($id);
			$this->appModel->hapusRecord($id, "id_absensi", "absensi");
			$this->session->setFlashdata('info', 'Data berhasil dihapus');
			return redirect()->to('absensi');
		}
	}
}
