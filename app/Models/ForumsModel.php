<?php
namespace App\Models;
use CodeIgniter\Model;

class ForumsModel extends Model {
	protected $table = 'forums';
	protected $primaryKey = 'id';
	
    protected $returnType = 'object';
	
	protected $allowedFields = ['forum_title','subtitle'];

	public function latestPost()
    {
		$result = $this->select('t.title, t.timestamp, t.id')
		->join('threads as t', 'forums.id=t.forum_id')
		->join('threads as t2', 'forums.id=t2.forum_id AND (t.timestamp < t2.timestamp OR (t.timestamp = t2.timestamp AND t.id < t2.id))'
		, 'left outer')
		->where('t2.id IS NULL')
		->findAll();
  
	 	return $result;
    }
}
?>