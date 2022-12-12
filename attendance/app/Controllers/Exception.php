<?php
namespace App\Controllers;
use \Config\App;
use App\Models\AppModel;
class Exception extends BaseController
{
	protected $appModel;
	public function __construct() {
		parent::__construct();	
		$this->auth->authenticate();
		$this->appModel=new AppModel();
	}
	
	public function notfound()
	{
		$data = array();
		$data["title"] 	= "ERROR 404";
		$data['page']	= 'errors/custom/notfound';
		return view('index',$data);
	}
	
	public function forbidden()
	{
		$data = array();
		$data["title"] = "ERROR 404";
		$data['page']  = 'errors/custom/forbidden';
		return view('index',$data);
	}

}
