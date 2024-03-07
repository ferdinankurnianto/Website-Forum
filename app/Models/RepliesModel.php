<?php
namespace App\Models;
use CodeIgniter\Model;

class RepliesModel extends Model {
	protected $table = 'replies';
	protected $primaryKey = 'id';
	
    protected $returnType = 'object';
	
	protected $allowedFields = ['thread_id', 'reply_id', 'user_id','content','timestamp'];

	public function replyOfReply(){
		$result = $this->select('replies.id, u.username, replies.content')
		->join('users as u', 'u.id=replies.user_id')
		->join('replies as r2', 'replies.id = r2.reply_id','left')
		->where('r2.reply_id != 0')
		->findAll();
		
		return $result;
	}
}
?>