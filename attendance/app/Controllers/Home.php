<?php
namespace App\Controllers;
use \Config\App;
use App\Models\AppModel;
class Home extends BaseController
{
	private $appModel;
	
	public function __construct() {
		parent::__construct();	
		$this->auth->authenticate();
		$this->appModel=new AppModel();
	}
	
	function index()
	{
		$data["title"]		="Home";
		$data['page']		='dashboard';
		$data['tpegawai']	=$this->appModel->totalData('pegawai');
		$data['tlokasi'] 	=$this->appModel->totalData('lokasi');
		$data['tdept'] 		=$this->appModel->totalData('departemen');
		$data['markers'] 	=$this->appModel->LokasiMap();
		return view('index',$data);		
	}
	
	function GetPieChart()
	{		
		$datasets=$this->appModel->pieChart();
		echo "{\"chart\":".json_encode($datasets)."}";
	}
}
