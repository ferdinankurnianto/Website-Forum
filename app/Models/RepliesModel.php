<?php
namespace App\Models;
use CodeIgniter\Model;

class RepliesModel extends Model {
	protected $table = 'replies';
	protected $primaryKey = 'id';
	
    protected $returnType = 'object';
	
	protected $allowedFields = ['thread_id','user_id','content','timestamp'];
}
?>