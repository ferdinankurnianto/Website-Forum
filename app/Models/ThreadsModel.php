<?php
namespace App\Models;
use CodeIgniter\Model;

class ThreadsModel extends Model {
	protected $table = 'threads';
	protected $primaryKey = 'id';
	
    protected $returnType = 'object';
	
	protected $allowedFields = ['forum_id','user_id','title',
	  'content', 'timestamp'];

	public function latestReply()
    {
		$result = $this->select('u.username, r.timestamp')
		->join('replies as r', 'threads.id=r.thread_id')
		->join('users as u', 'r.user_id = u.id')
		->join('replies as r2', 'threads.id=r2.thread_id AND (r.timestamp < r2.timestamp OR (r.timestamp = r2.timestamp AND r.id < r2.id))'
		, 'left outer')
		->where('r2.id IS NULL')
		->findAll();
  
	 	return $result;
    }
}
?>