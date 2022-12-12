<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Libraries\Auth;
class AuthModel extends Model
{
	protected $session;
	function __construct()
	{
		parent::__construct();
		$this->session = \Config\Services::session();
	}

	function manualQuery($q)
	{
		return $this->db->query($q);
	}

	function login($username=null)
	{
		$query = $this->db->query("SELECT a.*
									FROM admin a
									WHERE a.username=?",$username);
		return $query->getRow();
	}
}