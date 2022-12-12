<?php
namespace App\Controllers\Api;
use \Config\App;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ApiModel;
class Absensi extends ResourceController
{
	use ResponseTrait;
	public function index()
    {
		$data = array();
		$response = array();
		$userid=$this->request->getPost('userid');
		$this->apiModel=new ApiModel();
		$mdata=$this->apiModel->absensi($userid);
		if ($mdata->getNumRows()>0){
			foreach($mdata->getResult() as $row){
				$data				=[];
				$data['id'] 		=$row->id_absensi;
				$data['tanggal']	=$row->tanggal;
				$data['lokasi']		=$row->lokasi;
				$data['absen_in']	=$row->absen_in;
				$data['absen_out']	=$row->absen_out;
				array_push($response,$data);
			}
		}
		return $this->respond($response);
    }
	
	public function map()
    {
		$data = array();
		$response = array();
		$userid=$this->request->getPost('userid');
		$this->apiModel=new ApiModel();
		$mdata=$this->apiModel->map($userid=1);
		if ($mdata->getNumRows()>0){
			foreach($mdata->getResult() as $row){
				$data				=[];
				$data['id'] 		=$row->id_lokasi;
				$data['id_pegawai'] =$userid;
				$data['lokasi']		=$row->lokasi;
				$data['alamat']		=$row->alamat;
				$data['latitude']	=$row->latitude;
				$data['longitude']	=$row->longitude;
				$data['tanggal']	=date('Y-m-d');
				$data['isabsen']	=$this->apiModel->absensiCek($data);
				array_push($response,$data);
			}
		}
		return $this->respond($response);
    }
	
	public function absenIn()
	{
		$response = array();
		if($this->request->getPost()){
			$in["tanggal"]  	= date('Y-m-d');
			$in["id_pegawai"]  	= $this->request->getPost('userid');
			$in["id_lokasi"]  	= $this->request->getPost('lokasi');
			$in["absen_in"] 	= date('Y-m-d H:i:s');
			$this->apiModel=new ApiModel();
			$aCek=$this->apiModel->absensiCek($in);
			if(!$aCek){
				$this->apiModel->simpanRecord("absensi",$in);
				$response['status']	=true;
				$response['message']='Absen In berhasil !';
			}else{
				$response['status']	=false;
				$response['message']='Anda sudah Absen In !';
			}
		}
		return $this->respond($response);
	}
	
	public function absenOut()
	{
		$response = array();
		if($this->request->getPost()){
			$in["tanggal"]  	= date('Y-m-d');
			$in["id_pegawai"]  	= $this->request->getPost('userid');
			$in["id_lokasi"]  	= $this->request->getPost('lokasi');
			$in["absen_out"] 	= date('Y-m-d H:i:s');
			$this->apiModel=new ApiModel();
			$aCek=$this->apiModel->absensiCek($in);
			if(!$aCek){
				$response['status']	=false;
				$response['message']='Anda belum Absen In';
			}else{
				$in["id_absensi"]  	= $aCek;
				$this->apiModel->updateRecord("absensi",$in,"id_absensi");
				$response['status']	=true;
				$response['message']='Absen Out berhasil !';
			}
			return $this->respond($response);
		}		
	}
}