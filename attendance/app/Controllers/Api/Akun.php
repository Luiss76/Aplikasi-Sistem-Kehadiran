<?php
namespace App\Controllers\Api;
use \Config\App;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ApiModel;
class Akun extends ResourceController
{
	use ResponseTrait;
	
	public function index()
    {
		$response = array();
		$response['status']='gagal';
		$userid=$this->request->getPost('userid');
		$this->apiModel=new ApiModel();
		$mdata=$this->apiModel->akun($userid);
		if ($mdata->getNumRows()>0){
			$row=$mdata->getRow();
			$response['userid'] 	=$row->id_pegawai;
			$response['username']	=$row->nik;
			$response['nama']		=$row->nama;
			$response['telepon']	=$row->telepon;
			$response['email']		=$row->email;
			$response['jabatan']	=$row->jabatan;
			$response['departemen']	=$row->departemen;
			$response['lokasi']		=$row->lokasi;
			$response['foto']		=base_url('public/uploads/pegawai/'.$row->foto.'');
		}
		 return $this->respond($response);
        
    }
	
	function submit()
	{
		$response=array();
		$response['status']= 'gagal';
		#if($this->request->getPost()){
			$timestamp	=date('YmdHis');
			$userid		=$this->request->getPost('userid');
			$newpassword=$this->request->getPost('password');
			$foto		=$this->request->getPost('foto');		
			if($foto!=''){
				$filename=$userid.'-'.md5($timestamp).'.JPG';
				$path=ROOTPATH.'/public/uploads/pegawai/'.$filename.'';
				file_put_contents($path,base64_decode($foto));
				$in['foto']=$filename;
			}		
			if($newpassword!=''){
				$in['password']= $newpassword;
			}
			$in['id_pegawai'] 	= $userid;
			$in['telepon'] 		= $this->request->getPost('telepon');
			$in['email'] 		= $this->request->getPost('email');
			$this->apiModel		= new ApiModel();
			$this->apiModel->updateRecord("pegawai",$in,"id_pegawai");
			$response['status']= 'sukses';
		#}
		return $this->respond($response);
	}
}