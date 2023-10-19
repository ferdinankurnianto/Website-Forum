<?php
namespace App\Models;
use CodeIgniter\Model;

class UserLogModel extends Model {
	protected $table = 'user_log';
	protected $primaryKey = 'id';
	
	protected $allowedFields = ['email','timestamp','status'];
}
?>