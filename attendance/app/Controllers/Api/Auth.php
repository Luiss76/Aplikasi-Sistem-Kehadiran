<?php
namespace App\Controllers\Api;
use \Config\App;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ApiModel;
class Auth extends ResourceController
{
	use ResponseTrait;
	
	public function index()
    {
		$response = array();
		$response['status']='gagal';
		$username=$this->request->getPost('username');
		$password=$this->request->getPost('password');
		$this->apiModel=new ApiModel();
		$mdata=$this->apiModel->login($username,$password);
		if ($mdata->getNumRows()>0){
			$row=$mdata->getRow();
			if($row->status == 'Aktif'){
				$response['userid'] 	=$row->id_pegawai;
				$response['username']	=$row->nik;
				$response['nama']		=$row->nama;
				$response['telepon']	=$row->telepon;
				$response['email']		=$row->email;
				$response['foto']		=base_url('public/uploads/pegawai/'.$row->foto.'');
				$response['status']	='sukses';
			}else{
				$response['status']	='suspend';
			}
		}
        return $this->respond($response);
    }
}
