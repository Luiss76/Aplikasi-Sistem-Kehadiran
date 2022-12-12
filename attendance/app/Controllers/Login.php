<?php
use \Config\App;
use \Libraries\Auth;
namespace App\Controllers;
class Login extends BaseController
{
	public function __construct() {
		parent::__construct();
		helper(['form', 'url']);
	}

	public function index()
    {
        if($this->auth->loginStatus() && $this->auth->validSession()){
			header('location: ' . base_url(). '/home');exit;
		}else{
			$data = array();
			if($this->request->getPost()){
				$username=$this->request->getPost('username');
				$password=$this->request->getPost('password');
				$data=$this->auth->login($username,$password);
			}
			return $this->auth->showLoginForm($data);
		}
    }
	
	public function logout()
    {
        $this->auth->logout();
		$this->session->setFlashdata('error_login', 'You are logout !');
		header('location: ' .base_url(). '/Login');exit;
    }
}
