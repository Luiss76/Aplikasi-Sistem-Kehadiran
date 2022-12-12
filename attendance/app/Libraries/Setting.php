<?php
namespace App\Libraries;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\AppModel;
class Setting
{
	protected $model;
	
    public $backroundBody 	= 'bg1';
    public $backroundLogo 	= 'blue2';
    public $backroundTopbar 	= 'blue2';
    public $backroundSidebar 	= 'default';
	
    public function __construct()
    {
		$this->model =new AppModel();
		$this->request = \Config\Services::request();
		$this->init();
    }

    protected function init()
    {
		$this->backroundBody = 'bg1';
		$this->backroundLogo = 'blue2';
		$this->backroundTopbar = 'blue2';
		$this->backroundSidebar = 'default';
        return;
    }

	public function backroundBody()
    {
        return $this->backroundBody;
    }
	
	public function backroundLogo()
    {
        return $this->backroundLogo;
    }
	
	public function backroundTopbar()
    {
        return $this->backroundTopbar;
    }
	
	public function backroundSidebar()
    {
        return $this->backroundSidebar;
    }
}