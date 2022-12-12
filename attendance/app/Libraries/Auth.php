<?php
namespace App\Libraries;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\AuthModel;
class Auth
{
    protected $CI;
	protected $validation;
	protected $session;
	protected $model;
	protected $uri;
	
    public $user 	 	= null;
    public $userid 		= null;
    public $emplid 		= null;
    public $username 	= null;
	public $password 	= null;
	public $roles 	 	= null;
    public $nama 	 	= null;
    public $email 	 	= null;
    public $foto	 	= null;
	public $sessionid	= null;
    public $loginStatus = false;
	
    public function __construct()
    {
		$this->session 		= \Config\Services::session();
		$this->validation 	= \Config\Services::validation();
		$this->request 		= \Config\Services::request();
		$this->model 		= new AuthModel();
		$this->init();
    }

    protected function init()
    {
        if ($this->session->has('userid') && $this->session->loginStatus) {
            $this->userid 		= $this->session->userid;
            $this->username 	= $this->session->username;
			$this->roles 		= $this->session->roles;
            $this->nama 		= $this->session->nama;
            $this->email 		= $this->session->email;
            $this->foto 		= $this->session->foto;
            $this->sessionid 	= $this->session->sessionid;
            $this->loginStatus 	= true;
        }
        return;
    }

    public function showLoginForm()
    {
        return view('login');
    }
	
	
    public function login($username,$password)
    {
        if ($this->validate($username,$password)) {
            $this->user=$this->credentials($username);
            if ($this->user) {
				if ($password==$this->user->password) {
					if($this->user->status){
						return $this->setUser();
					}else{
						return $this->failedLogin('Status akun anda si suspend');
					}
				}else{
					return $this->failedLogin('Password salah');
				}
            } else {
                return $this->failedLogin('Username atau password salah');
            }
        }
        return false;
    }
	
	
    protected function validate($username,$password)
    {
		$input=$this->validation->setRules([
        'username' => 'required|is_unique[users.username]',
		'password' => 'required|min_length[6]'],[
				'username' => [
					'required' => 'All accounts must have usernames provided',
				],
				'password' => [
					'min_length' => 'Your password is too short. You want to get hacked?',
				],
			]
		);
        if ($input) {
            $this->username = $username;
            $this->password = $password;
            return true;
        }
        return false;
    }
	
	
	protected function credentials($username)
    {
        $user = $this->model->login($username);
		if($user){
            return $user;
        }
        return false;
    }
	
    protected function credentialsReset($username)
    {
        $user = $this->model->resetPass($username);
		if($user){
            return $user;
        }
        return false;
    }

    protected function setUser()
    {
        $userid=$this->user->id_admin;
        $sessionid=session_id();
        $this->session->set(array(
            "userid" => $this->user->id_admin,
            "username" => $this->user->username,
			"roles" => $this->user->roles,
            "nama" => $this->user->nama,
            "email" => $this->user->email,
            "foto" => $this->user->foto,
            "sessionid" => $sessionid,
            "loginStatus" => true
        ));
		header('location: ' . base_url() . '/home');exit;
    }
	
	protected function failedLogin($msg)
    {
        $this->session->setFlashdata('error_login', $msg);
    }
	
	
    public function loginStatus()
    {
        return $this->loginStatus;
    }

    public function authenticate()
    {
        if($this->loginStatus()) {
			return true; 
        }
		header('location: ' . base_url() . '/Login');exit;
    }
	
	
	public function userid()
    {
        return $this->userid;
    }
	
    public function username()
    {
        return $this->username;
    }
	
	public function roles()
    {
        return $this->roles;
    }
	
	public function nama()
    {
        return $this->nama;
    }
	
	public function email()
    {
        return $this->email;
    }
	
	public function foto()
    {
        return $this->foto;
    }
    
	public function sessionid()
    {
        return $this->sessionid;
    }
	
    public function logout()
    {
        $this->session->destroy();
        return true;
    }
}